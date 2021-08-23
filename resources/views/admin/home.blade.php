@extends('layouts.admin')

@section('title','后台管理 | '.get_setting('siteName'))

@section('content')

    <div class="container">

        <div class="my-container bg-white">
            <h4>判题机</h4>
            <hr>
            @if(!empty(session('ret')))
                <div class="overflow-auto px-2">
                    {!! session('ret') !!}
                    <hr>
                </div>
            @endif
            <div class="overflow-auto px-2">
                当前进程：{{$info}}
                <div class="float-right">
                    <form action="{{route('admin.cmd_polling')}}" method="post" class="mb-0">
                        @csrf
                        <input id="oper" type="hidden" name="oper">
                        @if($run)
                            <button onclick="$('#oper').val('restart')" class="btn bg-info text-white">重启</button>
                            <button onclick="$('#oper').val('stop')" class="btn bg-warning text-white">停止</button>
                        @else
                            <button onclick="$('#oper').val('start')" class="btn bg-info text-white">启动</button>
                        @endif
                    </form>
                </div>
            </div>
            <hr>
        </div>

        <div class="my-container bg-white">
            <h4>服务器内存使用情况（单位：MB）</h4>
            <hr>
            <div class="overflow-auto px-2">
                <pre>@php(system('free -m'))</pre>
            </div>
            <hr>
        </div>

        <div class="my-container bg-white">
            <h4>服务器相关信息</h4>
            <hr>
            <div class="overflow-auto px-2">
                <div class="table-responsive">
                    <table id="table-overview" class="table">
                        <tbody>
                            <style type="text/css">
                                #table-overview td {
                                    border: 0;
                                    text-align: left
                                }
                            </style>
                            @foreach($systemInfo as $k=>$v)
                                <tr>
                                    <td nowrap>{{$k}}</td>
                                    <td nowrap>{{$v}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
        </div>

    </div>

@endsection
