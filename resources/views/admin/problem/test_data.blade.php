@extends('layouts.admin')

@section('title','测试数据管理 | 后台')

@section('content')

    <div class="d-flex">
        <form class="p-3" action="" method="get">
            <div class="form-inline">
                <h2 class="mr-3">测试数据</h2>
                <label>题号：</label>
                <input type="number" step="1" name="pid" value="{{isset($_GET['pid'])?$_GET['pid']:''}}" required class="form-control ml-3">
                <button class="btn btn-light bg-success ml-1">转到</button>
            </div>
        </form>
        @if(isset($_GET['pid']))
            <form class="p-3" method="post" enctype="multipart/form-data" onsubmit="return do_upload()">
                @csrf
                <div class="form-inline">
                    <label>上传文件(按住Ctrl多选)：</label>
                    <input type="file" id="test_data" required multiple class="form-control">
                    <button class="btn btn-light bg-success ml-1">上传</button>
                </div>
            </form>
        @endif
    </div>

    <div>
        @if(isset($_GET['pid']))
            <div class="table-responsive px-4">
                <a href="javascript:$('td input[type=checkbox]').prop('checked',true)" class="btn border">全选</a>
                <a href="javascript:$('td input[type=checkbox]').prop('checked',false)" class="btn border">取消</a>

                <a href="javascript:delete_data()" class="ml-3">删除</a>
                <a href="javascript:" class="text-gray" onclick="whatisthis('选中的文件将被删除')">
                    <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                </a>

                <div class="row">
                    <div class="col-12 col-md-6 px-2">
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                            <tr>
                                <th></th>
                                <th>文件名</th>
                                <th>大小</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(array_slice($tests,0,(count($tests)+1)>>1) as $item)
                                <tr>
                                    <td onclick="var cb=$(this).find('input[type=checkbox]');cb.prop('checked',!cb.prop('checked'))">
                                        <input type="checkbox" value="{{$item['filename']}}" onclick="window.event.stopPropagation();" style="vertical-align:middle;zoom: 140%">
                                    </td>
                                    <td nowrap>
                                        <a href="javascript:" onclick="get_data('{{$item['filename']}}')" data-toggle="modal" data-target="#myModal">
                                            {{$item['filename']}}
                                        </a>
                                    </td>
                                    <td nowrap>{{$item['size']}}B</td>
                                    <td nowrap>
                                        <a href="javascript:delete_data('{{$item['filename']}}')" class="px-1">
                                            <i class="fa fa-trash" aria-hidden="true"> 删除</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 col-md-6 px-2">
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                            <tr>
                                <th></th>
                                <th>文件名</th>
                                <th>大小</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(array_slice($tests,(count($tests)+1)>>1) as $item)
                                <tr>
                                    <td onclick="var cb=$(this).find('input[type=checkbox]');cb.prop('checked',!cb.prop('checked'))">
                                        <input type="checkbox" value="{{$item['filename']}}" onclick="window.event.stopPropagation();" style="vertical-align:middle;zoom: 140%">
                                    </td>
                                    <td nowrap>
                                        <a href="javascript:" onclick="get_data('{{$item['filename']}}')" data-toggle="modal" data-target="#myModal">
                                            {{$item['filename']}}
                                        </a>
                                    </td>
                                    <td nowrap>{{$item['size']}}B</td>
                                    <td nowrap>
                                        <a href="javascript:delete_data('{{$item['filename']}}')" class="px-1">
                                            <i class="fa fa-trash" aria-hidden="true"> 删除</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        @else
            <div class="d-block text-center">{{__('sentence.No data')}}</div>
        @endif
    </div>


{{--    模态框显示数据--}}
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form action="{{route('admin.problem.update_data')}}" method="post">
                    @csrf
                    <input type="number" name="pid" value="{{isset($_GET['pid'])?$_GET['pid']:0}}" class="form-control" hidden>
                    <input type="text" name="filename" hidden>
                    <!-- 模态框头部 -->
                    <div class="modal-header">
                        <h5 id="file_name" class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- 模态框主体 -->
                    <div class="modal-body ck-content">
                        <div class="form-group">
                            <textarea name="content" id="content" class="form-control-plaintext border" rows="18"></textarea>
                        </div>
                    </div>

                    <!-- 模态框底部 -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">保存</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script src="{{asset('js/uploadBig.js')}}"></script>
    <script>
        function do_upload() {
            uploadBig({
                url:"{{route('admin.problem.upload_data')}}",
                _token:"{{csrf_token()}}",
                files:$("#test_data")[0].files,
                data:{
                    'pid':"{{isset($_GET['pid'])?$_GET['pid']:0}}"
                },
                before:function (file_count, total_size) {
                    Notiflix.Loading.Hourglass('开始上传'+file_count+'个文件!总大小：'+(total_size/1024).toFixed(1)+'MB');
                },
                uploading: function (file_count,index,up_size,fsize) {
                    Notiflix.Loading.Change('上传中'+index+'/'+file_count+' : '+
                        (up_size/1024).toFixed(2)+'MB/'+(fsize/1024).toFixed(2) +'MB ('+
                        Math.round(up_size*100/fsize)+'%)');
                },
                success:function (file_count,ret) {
                    Notiflix.Loading.Remove();
                    Notiflix.Report.Success('成功', '已导入'+file_count+'个文件','好的',function () {location.reload()});
                },
                error:function (xhr,status,err) {
                    Notiflix.Loading.Remove();
                    Notiflix.Report.Failure('文件导入失败','您上传的文件似乎已损坏：'+err,'好的');
                }
            });
            return false;
        }



        function get_data(filename) {
            $.post(
                '{{route('admin.problem.get_data')}}',
                {
                    '_token':'{{csrf_token()}}',
                    'pid':'{{isset($_GET['pid'])?$_GET['pid']:0}}',
                    'filename':filename,
                },
                function (ret) {
                    ret=JSON.parse(ret);
                    $("#file_name").html(filename);
                    $("input[name=filename]").val(filename);
                    $("#content").val(ret)
                }
            );
        }
        function delete_data(filename=-1) {
            Notiflix.Confirm.Show( '敏感操作', '确定删除文件？', '确认', '取消',function(){
                if(filename!==-1){  //指定删除一个
                    $('td input[type=checkbox]').prop('checked',false)
                    $('td input[value=\''+filename+'\']').prop('checked',true)
                }
                var fnames=[];
                $('td input[type=checkbox]:checked').each(function () { fnames.push($(this).val()); });
                $.post(
                    '{{route('admin.problem.delete_data')}}',
                    {
                        '_token':'{{csrf_token()}}',
                        'pid':'{{isset($_GET['pid'])?$_GET['pid']:0}}',
                        'fnames':fnames,
                    },
                    function (ret) {
                        location.reload();
                    }
                );
            });
        }
    </script>
@endsection
