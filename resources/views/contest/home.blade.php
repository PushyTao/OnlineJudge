@extends('layouts.client')

@section('title',trans('main.Contest').$contest->id.' | '.config('oj.main.siteName'))

@section('content')

    <style type="text/css">
        select {
            text-align: center;
            text-align-last: center;
        }
    </style>


    <div class="container">

        <div class="col-12 col-sm-12">
            {{-- 菜单 --}}
            @include('contest.menu')
        </div>

        <div class="col-md-8 col-sm-12 col-12">
            <div class="my-container bg-white">

                <h3>{{$contest->id}}. {{$contest->title}}</h3>
                <hr class="mt-0">

                {{--                进度条与倒计时--}}
                <div class="progress">
                    <p id="length" class="d-none">{{$length=strtotime($contest->end_time)-strtotime($contest->start_time)}}</p>
                    <p id="remain" class="d-none">{{$remain=strtotime($contest->end_time)-time()}}</p>
                    <div id="progress" class="progress-bar bg-info" style="width: 0"></div>
                </div>
                <div id="time_show" class="text-right mb-2">
                    <i class="fa fa-clock-o pr-2 text-sky" aria-hidden="true"></i>
                    <font id="remain_area"></font>
                </div>
                <script>
                    var ended=false;
                    var timer_id=null;
                    var remain_time=function () {
                        var remain_t='';
                        var length=$('#length').text();
                        var remain=$('#remain').text();
                        $('#remain').html(Math.max(0,remain-1))

                        if(remain<0)//结束了
                        {
                            $('#remain_area').html('Ended')
                            ended=true;
                            clearInterval(timer_id);
                            return remain_time;
                        }
                        else if(remain-length>0) //尚未开始
                        {
                            $('#time_show').removeClass('text-right');
                            $('#time_show').addClass('text-left');
                            remain_t+='Waiting for ';
                            remain-=length;
                        }else{
                            //比赛中
                            $('#progress').css('width',(length-remain)/length*100+'%')
                        }


                        remain_t+=( (remain>3600*24*30) ? parseInt(remain/(3600*24*30))+' months &nbsp;' : '' ); remain%=3600*24*30
                        remain_t+=( (remain>3600*24) ? parseInt(remain/(3600*24))+' days &nbsp;' : '' ); remain%=3600*24
                        remain_t+=parseInt(remain/3600)+':'; remain%=3600
                        remain_t+=parseInt(remain/60)+':'; remain%=60
                        remain_t+=remain;
                        $('#remain_area').html(remain_t)
                        return remain_time;
                    }
                    remain_time();
                    if(!ended)
                        timer_id=setInterval(remain_time,1000);
                </script>



                @if($contest->description!=null)
                    <p class="alert-success p-3">{{$contest->description}}</p>
                @endif

                <table class="table table-sm table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{trans('main.Title')}}</th>
                        <th>{{trans('main.AC/Submit')}}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($problems as $item)
                        <tr>
                            <td>{{$item->index}}</td>
                            <td nowrap><a href="{{route('contest.problem',[$contest->id,$item->index])}}">{{$item->title}}</a></td>
                            <td>@if($item->submit>0){{$item->solved}}&nbsp;/&nbsp;{{$item->submit}}@else - @endif</td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="col-md-4 col-sm-12 col-12">

            {{--  竞赛信息 --}}
            @include('contest.information')

        </div>
    </div>

@endsection

