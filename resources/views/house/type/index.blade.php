@extends('layouts/default')

@section('css')

    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/module.css') }}">


@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
                <!-- 表格列表 -->
        <div class="tb-unit posr">
            <div class="tb-unit-bar" style="overflow: hidden;">
                <a class="btn all-fold" href="javascript:;" style="float:left;">@lang('house_translate.All_folding')</a>
                <a class="btn all-open" href="javascript:;" style="float:left; margin-right:30px;">@lang('house_translate.All_open')</a>
                <a class="btn" href="{{ url('house/type/add') }}" style="float:left; margin-right:30px;">@lang('house_translate.Add_type')</a>


            </div>

            <div class="category">
                <div class="hd cf">
                    <div class="fold">@lang('house_translate.folding')</div>
                    <div class="order">ID</div>
                    <div class="order">@lang('house_translate.The_sorting')</div>
                    <div class="order" style="    width: 200px; text-align: left;">@lang('house_translate.name')</div>
                </div>
                @include('house.type.tree', ['tree' => $tree])
            </div>
        </div>

@stop



@section('js')
    <script type="text/javascript">
        $(function (){

            $('.all-open').click(function (){
                $('.category').find('.fold i.icon-fold').removeClass('icon-fold').addClass('icon-unfold');
                $('.category').find('dd').show();
            });
            $('.all-fold').click(function (){
                $('.category').find('.fold i.icon-unfold').removeClass('icon-unfold').addClass('icon-fold');
                $('.category').find('dd').hide();
            });
            /* 分类展开收起 */
            $(".category dd").prev().find(".fold i").addClass("icon-fold")
                    .click(function(){
                        var self = $(this);
                        if(self.hasClass("icon-unfold")){
                            self.closest("dt").next().slideUp("fast", function(){
                                self.removeClass("icon-unfold").addClass("icon-fold");
                            });
                        } else {
                            self.closest("dt").next().slideDown("fast", function(){
                                self.removeClass("icon-fold").addClass("icon-unfold");
                            });
                        }
                    });

            /* 三级分类删除新增按钮 */
            $(".category dd dd .add-sub").remove();



            /* 实时更新分类信息 */
            $(".category")
                    .on("submit", "form", function(){
                        var self = $(this);
                        $.post(
                                self.attr("action"),
                                self.serialize(),
                                function(data){
                                    /* 提示信息 */
                                    var name = data.status ? "success" : "error", msg;
                                    msg = self.find(".msg").addClass(name).text(data.info)
                                            .css("display", "inline-block");
                                    setTimeout(function(){
                                        msg.fadeOut(function(){
                                            msg.text("").removeClass(name);
                                        });
                                    }, 2000);
                                },
                                "json"
                        );
                        return false;
                    })
                    .on("focus","input",function(){
                        $(this).data('param',$(this).closest("form").serialize());

                    })
                    .on("blur", "input", function(){
                        if($(this).data('param')!=$(this).closest("form").serialize()){
                            $(this).closest("form").submit();
                        }
                    })
                    .on('click','.update_status',function (){
                        var self = $(this);
                        $.post(
                                self.attr("href"),
                                '',
                                function(data){
                                    if(data.status){
                                        if(data.data.status == 1){
                                            self.html('<i style="color:#ccc;">禁用</i>').attr('href',"/category/menu/updateStatus?status=0&id="+data.data.id);
                                        }else{
                                            self.html('启用').attr('href',"/category/menu/updateStatus?status=1&id="+data.data.id);
                                        }
                                    }
                                },
                                "json"
                        );
                        return false;
                    });
        });
    </script>
@stop