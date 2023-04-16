<?php

namespace App\Jobs;

use App\Http\Helpers\ProblemHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class Judger implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 300; // 最长执行时间 秒
    public $tries = 1;    // 最多尝试次数

    private array $solution;
    private array $cachedIds;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $solution)
    {
        $this->onQueue('sending_solution');
        $this->solution = $solution;
        $this->cachedIds = [];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->judge();
        // 清除缓存
        $this->deleteCachedFiles();
    }

    private function judge()
    {
        // 更新solution结果为Queueing
        $this->update_db_solution(['result' => 1]); // 队列中

        // 获取题目的相关属性
        $problem = (array)(DB::table('problems')
            ->select(['id', 'time_limit', 'memory_limit', 'spj']) // MS,MB,int
            ->find($this->solution['problem_id']));

        // 获取编译运行指令
        $config = config('judge.language')[$this->solution['language']];
        if (!empty($config['compile'])) { // 需编译
            // 向JudgeServer发送请求 编译用户代码
            $res_compile = $this->compile($this->solution['code'], $config);
            if ($res_compile != null && $res_compile['status'] != 'Accepted') { // 编译失败
                $this->update_db_solution([
                    'result' => 11, // 编译错误 11
                    'error_info' => sprintf(
                        "[%s occurred during compilation]\n%s\n%s",
                        $res_compile['status'],
                        $res_compile['error'] ?? '',
                        $res_compile['files']['stderr']
                    )
                ]);
                return;
            }
        }

        // 向JudgeServer发送请求 编译spj（若有）
        if ($problem['spj']) {
            // 先看是否有缓存的编译好的spj
            if (!file_exists(testdata_path($problem['id'] . '/spj/spj.cpp'))) {
                $this->update_db_solution(['result' => 14, 'error_info' => 'spj.cpp is not exist']); // 系统错误 14 特判程序不存在
                return;
            }
            $res_compile_spj = $this->compile(file_get_contents(testdata_path($problem['id'] . '/spj/spj.cpp')), config('judge.language.6')); // C++20
            $spj_file_id = $res_compile_spj['fileIds']['Main'] ?? ''; // 记住spj id
            if ($res_compile_spj['status'] != 'Accepted') {
                $this->update_db_solution(['result' => 14, 'error_info' => "[Special judge compile error]\n" . $res_compile_spj['files']['stderr']]); // 系统错误 14
                return;
            }
        }

        // 向JudgeServer发送请求 运行代码（每组测试数据运行一次）
        if (empty($config['compile'])) {
            $this->run($problem, $config, [$config['filename'] => ['content' => $this->solution['code']]], $spj_file_id ?? '');
        } else {
            $this->run($problem, $config, ['Main' => ['fileId' => $res_compile['fileIds']['Main']]], $spj_file_id ?? '');
        }
        // 结束
    }

    // 编译
    private function compile(string $code, $config)
    {
        $this->update_db_solution(['result' => 2]); // 编译中
        // 要发送的数据
        $cmd = [
            [
                'args' => explode(' ', $config['compile']['command']),
                'env' => ['PATH=/usr/bin:/bin'],
                'files' => [   // 指定 标准输入、标准输出和标准错误的文件
                    ['content' => ''],
                    ['name' => 'stdout', 'max' => 10240],
                    ['name' => 'stderr', 'max' => 10240],
                ],
                'cpuLimit' => $config['compile']['cpuLimit'],
                'memoryLimit' => $config['compile']['memoryLimit'],
                'procLimit' => $config['compile']['procLimit'],
                'copyIn' => [
                    $config['filename'] => ['content' => $code],
                ],
                'copyOut' => ['stdout', 'stderr'],
                'copyOutCached' => ['Main'],
                // 'copyOutDir' => '1'
            ]
        ];

        $res = Http::post(config('app.JUDGE_SERVER') . '/run', ['cmd' => $cmd]);
        if ($res[0]['fileIds']['Main'] ?? false)
            $this->cachedIds[] = $res[0]['fileIds']['Main']; // 记录缓存的文件id，最后清除
        return $res->json()[0];
    }

    // 运行评测
    private function run($problem, $config, $copyIn, $spj_file_id = '')
    {
        $this->update_db_solution(['result' => 3]); // 运行中

        // 初始化所有测试点
        $tests = ProblemHelper::getTestDataFilenames($problem['id']);
        $judge0result = [];
        foreach ($tests as $k => $test)
            $judge0result[$k] = [
                'result' => 0, // 等待中
                'time' => 0,
                'memory' => 0,
            ];
        $this->update_db_solution(['judge0result' => $judge0result]); // 初始化测试点信息写入数据库，以供前台显示

        // 遍历测试点，运行用户程序，得到输出
        $ac = 0;
        $not_ac = 0;
        foreach ($tests as $k => $test) {
            // 构造请求
            $data = ['cmd' => [
                [
                    'args' => explode(' ', $config['run']['command']),
                    'env' => ['PATH=/usr/bin:/bin'],
                    'files' => [
                        ['src' => sprintf("/testdata/%d/test/%s", $problem['id'], $test['in'])],
                        ['name' => 'stdout', 'max' => $config['run']['stdoutMax']],
                        ['name' => 'stderr', 'max' => $config['run']['stderrMax']],
                    ],
                    'cpuLimit' => $problem['time_limit'] * 1000000, // ms ==> ns
                    'memoryLimit' => $problem['memory_limit'] << 20, // MB ==> B
                    'strictMemoryLimit' => true,
                    'procLimit' => $config['run']['procLimit'],
                    'copyIn' =>  $copyIn,
                    'copyOut' => ['stdout', 'stderr'],
                    'copyOutCached' => ($problem['spj'] ? ['stdout'] : []), //copyOutCached中stdout会覆盖copyOut中stdout，故非特判时别缓存导致拿不到stdout原文
                    'copyOutDir' => '1'
                ]
            ]];

            // 向判题服务发起请求
            $res = Http::post(config('app.JUDGE_SERVER') . '/run', $data);
            if ($res[0]['fileIds']['stdout'] ?? false)
                $this->cachedIds[] = $res[0]['fileIds']['stdout']; // 记录缓存的文件id，最后清除

            // 接收到运行结果，分析运行结果，即答案评判
            if ($res[0]['status'] == 'Accepted') { // 运行成功，对比文件
                if ($problem['spj']) {
                    $std_in_path = sprintf("/testdata/%d/test/%s", $problem['id'], $test['in']);
                    $std_out_path = sprintf("/testdata/%d/test/%s", $problem['id'], $test['out']);
                    $ret = $this->special_judge($spj_file_id, $std_in_path, $std_out_path, $res[0]['fileIds']['stdout']);
                    $result = $ret['result'];
                    $error_info = $ret['error_info'];
                } else {
                    $std_out_path = testdata_path(sprintf('%d/test/%s', $problem['id'], $test['out']));
                    $ret = $this->diff_judge($std_out_path, $res[0]['files']['stdout']);
                    $result = $ret['result'];
                    $error_info = $ret['error_info'];
                }
            } else { // 运行出错
                $result = array_search($res[0]['status'], config('judge.result'));
                $error_info = "";
                if ($result === false) {
                    $result = 10; // RE
                    $error_info = sprintf("[%s]\n%s", $res[0]['status'], $res[0]['files']['stderr']);
                }
            }

            // 实时更新运行结果
            $judge0result[$k] = [
                'result' => $result,
                'time' => intdiv($res[0]['time'], 1000000), // ns==>ms
                'memory' => $res[0]['memory'] >> 20, // B==>MB
                'error_info' => $error_info
            ];
            $this->update_db_solution(['judge0result' => $judge0result]); // 向数据库刷新测试点状态

            // 统计测试点对错情况
            if ($result == 4) {
                $ac++;
            } else {
                $not_ac++;
                if ($not_ac == 1) // 首次遇到的错误作为本solution的错误
                    $this->update_db_solution(['result' => $result, 'pass_rate' => $ac / count($tests), 'error_info' => $error_info]);
                // 如果是acm模式，遇到错误，直接终止
                if ($this->solution['judge_type'] == 'acm')
                    break;
            }
        }
        if ($not_ac == 0) // 该solution完全正确，要告诉数据库
            $this->update_db_solution(['result' => 4, 'pass_rate' => $ac / count($tests)]);
    }

    // 特判
    private function special_judge($spj_file_id, $std_in_path, $std_out_path, $user_out_file_id)
    {
        $data = ['cmd' => [[
            'args' => explode(" ", "spj std.in std.out user.out"),
            'env' => ['PATH=/usr/bin:/bin'],
            'files' => [
                ['content' => ''],
                ['name' => 'stdout', 'max' => 10240],
                ['name' => 'stderr', 'max' => 10240],
            ],
            'cpuLimit' => 60000000000, // 60s ==> ns
            'memoryLimit' => 1024 << 20, // 1024MB ==> B
            'procLimit' => 8,
            'copyIn' => [
                'spj' => ['fileId' => $spj_file_id],
                'std.in' => ['src' => $std_in_path],
                'std.out' => ['src' => $std_out_path],
                'user.out' => ['fileId' => $user_out_file_id]
            ],
            'copyOut' => ['stdout', 'stderr'],
            // 'copyOutDir' => '1'
        ]]];

        // 向判题服务发起请求
        $res = Http::post(config('app.JUDGE_SERVER') . '/run', $data);
        return [
            'result' => $res[0]['exitStatus'] == 0 ? 4 : 6,
            'error_info' => implode("\n", array_values($res[0]['files']))
        ];
    }

    // 文本对比
    private function diff_judge($std_out_path, $user_out)
    {
        $result = 4; // 默认AC，下面检查是否出错
        $msg = '';

        // 按行分割
        $std_out = file_get_contents($std_out_path);
        $std_out = explode("\n", trim($std_out));
        $user_out = explode("\n", trim($user_out));
        $count_lines = count($std_out);

        // 检查行数
        if ($count_lines != count($user_out)) {
            $result = 6; // WA 行数不一致，必错
            $msg = "Inconsistent number of rows";
        } else {
            // 逐行检查
            for ($i = 0; $i < $count_lines; $i++) {
                $user_line = trim($user_out[$i], "\r\n");
                $answer_line = trim($std_out[$i], "\r\n");
                if (strcmp($user_line, $answer_line) != 0) { // 内容不一致
                    if (strcmp(trim($user_line), trim($answer_line)) != 0) {
                        $result = 6; // WA 可见字符不一致
                        $msg = sprintf("The content of line %d is inconsistent.", $i + 1);
                    } else {
                        $result = 5; // PE 空白符不一致
                        $msg = sprintf("The content of line %d is inconsistent.", $i + 1);
                    }
                }
            }
        }
        return ['result' => $result, 'error_info' => $msg];
    }

    // 将判题结果写入数据库
    private function update_db_solution($values)
    {
        DB::table('solutions')->where('id', $this->solution['id'])->update($values);
    }

    // 清除所有judge server中的缓存文件
    private function deleteCachedFiles()
    {
        foreach ($this->cachedIds as $id) {
            Http::delete(config('app.JUDGE_SERVER') . '/file/' . $id,);
        }
    }
}
