{{-- 已经AC的用户进行标签标记 --}}
@if($tag_mark_enable)
    {{--                    模态框选择标签 --}}
    <div class="modal fade" id="modal_tag_pool">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- 模态框头部 -->
                <div class="modal-header">
                    <h4 class="modal-title">{{__('main.Tag Pool')}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- 模态框主体 -->
                <div class="modal-body ck-content">
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            &times;
                        </button>
                        {{__('sentence.tag_pool_select')}}
                    </div>
                    @foreach($tag_pool as $tag)
                        <div class="d-inline text-nowrap mr-1">
                            <i class="fa fa-tag" aria-hidden="true"></i>
                            <a href="javascript:"
                            onclick="add_tag_input($('#add_tag_btn'),'{{$tag->name}}');
                                // $('#modal_tag_pool').modal('hide')"
                            >{{$tag->name}}</a>
                        </div>
                    @endforeach
                </div>

                <!-- 模态框底部 -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                </div>

            </div>
        </div>
    </div>

    <div class="my-5">

        <div class="p-2" style="background-color: rgb(162, 212, 255)">
            <h4 class="m-0">{{trans('main.Tag Marking')}}</h4>
        </div>

        <form class="p-3" action="{{route('tag_mark')}}" method="post" onsubmit="return check_tag_count();">
            @csrf
            <input name="problem_id" value="{{$problem->id}}" hidden>

            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                </button>
                {{__('sentence.Congratulations')}}
            </div>
            <div class="form-inline mb-2">
                <span>{{__('main.Tag')}}：</span>
                {{--                                <div class="form-inline">--}}
                {{--                                    <input type="text" class="form-control mr-2" oninput="input_auto_width($(this))" required name="tag_names[]" style="width: 50px">--}}
                {{--                                </div>--}}
                <a id="add_tag_btn" class="btn btn-sm border mb-0" onclick="add_tag_input($(this))">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    {{__('main.Input').' '.__('main.Tag')}}
                </a>
                <a class="btn btn-sm border mb-0 ml-1" data-toggle="modal"
                data-target="#modal_tag_pool">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    {{__('main.Tag Pool')}}
                </a>
            </div>
            @if(count($tags)>0)
                <div class="form-group">
                    <span>{{__('main.Most Tagged')}}：</span>
                    @foreach($tags as $item)
                        <div class="d-inline text-nowrap">
                            <i class="fa fa-tag" aria-hidden="true"></i>
                            <a href="javascript:"
                            onclick="add_tag_input($('#add_tag_btn'),'{{$item->name}}')">{{$item->name}}</a>
                        </div>
                    @endforeach
                </div>
            @endif
            <button type="submit" class="btn bg-success text-white mt-1">{{trans('main.Submit')}}</button>
        </form>
    </div>

    {{-- 问题标签的操作 --}}
    <script type="text/javascript">
        @if(session('tag_marked'))
            $(function () {
                Notiflix.Notify.Success("{{__('sentence.tag_marked')}}");
            })
        @endif
        var tag_input_count = 0;
        
        function add_tag_input(that, defa = null) {
            if (tag_input_count >= 5) {
                Notiflix.Notify.Failure("{{__('sentence.tag_marked_exceed')}}")
                return;
            }
            var dom = "<div class=\"form-inline\">\n" +
                "    <input type=\"text\" class=\"form-control mr-2\" oninput=\"input_auto_width($(this))\" required name=\"tag_names[]\" style=\"width: 50px\">\n" +
                "    <a style=\"margin-left: -25px;cursor: pointer\" onclick=\"delete_tag_input($(this))\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a>\n" +
                "</div>";
            $(that).before(dom);
            var input = $(that).prev().children("input");
            // input.focus();
            if (defa != null) {
                input.val(defa);
                input_auto_width(input);
            }
            tag_input_count++;
        }

        //初始化, 至少一个输入框
        add_tag_input($("#add_tag_btn"))

        function delete_tag_input(that) {
            tag_input_count--;
            $(that).parent().remove();
        }

        function check_tag_count() {
            if (tag_input_count > 0)
                return true;
            Notiflix.Notify.Failure("{{__('sentence.tag_marked_zero')}}");
            return false;
        }

        //输入框根据字数自动调整宽度
        function input_auto_width(that) {
            $(that).val($(that).val().replace(/\s+/g, '')); //禁止输入空格
            var sensor = $('<font>' + $(that).val() + '</font>').css({display: 'none'});
            $('body').append(sensor);
            var width = sensor.width();
            sensor.remove();
            $(that).css('width', (width + 30) + 'px');
        }
    </script>
@endif
