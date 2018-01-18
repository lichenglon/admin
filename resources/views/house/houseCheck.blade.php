@extends('layouts.default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('house/css/H-ui.min.css')}}" />
@stop

@section('content')

    <div class="box">
        <div class="box-body">


            <div class="Hui-article"  style="height:625px">
                <article class="cl pd-20">
                    <form action="{{url('house/houseCheck')}}" method="post">

                        <span>@lang('house_translate.National_city')：</span>
                            <select id="country" class="dept_select input-text" name="state" style="width:10%;">
                                <option value="">请选择</option>
                            @foreach($nationArr as $nation)
                                <option value="{{$nation->chinese_n_name}},{{$nation->english_n_name}},{{$nation->abbreviation}},{{$nation->n_ID}}">@if(Session::get('lang') == 'en'){{ $nation->english_n_name }}@else{{$nation->chinese_n_name}}@endif</option>
                            @endforeach
                            </select>
                            <select id="province" class="dept_select input-text"  name="province" style="width:10%;"></select>
                            <select id="city" class="dept_select input-text" name="city" style="width:10%;"></select>
                        {{--<input type="text" class="input-text" value="@if($house_keyword != '%'){{$house_keyword}}@endif" placeholder="请输入关键字" name="house_keyword" style="width:250px;">--}}
                        <input type="submit" class="btn btn-default" name="search" value="@lang('house_translate.search')">

                    <div class="mt-20">
                        <table class="table table-border table-bordered table-bg table-hover table-sort">
                            <thead>
                            <tr class="text-c" id="theader">
                                <th>@lang('house_translate.type')</th>
                                <th width="">@lang('house_translate.Room_number')</th>
                                <th width="">@lang('house_translate.Housing_structure')</th>
                                <th width="">@lang('house_translate.Housing_prices')</th>
                                <th width="">@lang('house_translate.Housing_size')</th>
                                {{--<th width="">房屋设备</th>--}}
                                <th width="">@lang('house_translate.Housing_location')</th>
                                <th width="">@lang('house_translate.The_lease_time')</th>
                                {{--<th width="">房源状态</th>--}}
                                <th>@lang('house_translate.Audit_status')</th>
                                <th width="">@lang('house_translate.operation')</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($result as $k=>$v)
                                @if($v->chk_sta == 1 || $v->chk_sta == 3)
                                <tr class="text-c">
                                    <td>{{ $v->house_type }}</td>
                                    <td><a href="{{url('house/houseLister/detail',['id'=>$v->msgid])}}"><u style="cursor:pointer" class="text-primary" title="查看">{{$v->serial_number}}</u></a></td>
                                    <td>{{ $v->house_structure }}</td>
                                    <td>{{ $v->house_price }}</td>
                                    <td>{{ $v->house_size }} 平方</td>
                                    {{--<td>{{ $v->house_facility }}</td>--}}
                                    <td>{{ $v->house_location }}</td>
                                    <td>{{ $v->house_rise }}</td>
                                    {{--<td>{{ $v->house_status }}</td>--}}
                                    <td>
                                        @if($v->chk_sta == 1)
                                            <label>@lang('house_translate.adopt') <input name="chk_sta" type="radio" value="2" onclick="javascript:if(window.confirm('确定要执行此操作吗？')){isCheck('2','{{$v->msgid}}')}" /></label>
                                            &nbsp;&nbsp;
                                            <label>@lang('house_translate.Not_through')<input name="chk_sta" type="radio" value="3" onclick="javascript:if(window.confirm('确定要执行此操作吗？')){isCheck('3','{{$v->msgid}}')}" /></label>
                                        @elseif($v->chk_sta == 3)
                                            @lang('house_translate.Not_through')
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('house/houseLister/update',['id'=>$v->msgid]) }}">@lang('house_translate.Update_the_housing')</a>
                                        &nbsp;||&nbsp;
                                        <a href="{{ url('house/houseLister/detail',['id'=>$v->msgid]) }}">@lang('house_translate.The_detailed_information')</a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    </form>
                </article>
            </div>
            @if (!empty($result))
                <div class="page_list">
                    {{$result->appends(Request::input())->links()}}
                    <div style="display:inline-block; margin-bottom:25px;">
                        <span class="r">@lang('house_translate.Common_data')：<strong>{{$total}}</strong> @lang('house_translate.strip')</span>
                    </div>
                </div>
            @endif
        </div>


    </div>
        </div>
    </div>


@stop

@section('js')

    <script>
        //常规用法 日期
        laydate.render({
            elem: '#rise'
        });
        laydate.render({
            elem: '#duration'
        });

        //审核状态的更改
        function isCheck(number,msgid){
            $.ajax({
                url:"{{url('house/houseCheck/isCheck')}}",
                data: 'chk_sta='+number+'&msgid='+msgid,
                type: 'get',
                success: function(re){
                    if(re == '1'){
                        location.reload();
                    }else{
                        alert('审核失败');
                    }
                }
            })
        }

        @if(isset($province) && isset($city))
        {
            document.getElementById('country').value = "@if(isset($state)){{$state}}@endif";
            var val = $("#country").val();
            var arr=val.split(",");
            var p_nation_ID = arr[3];
            $.ajax({
                url:"{{url('house/houseLister/region')}}",
                data:'p_nation_ID='+p_nation_ID,
                type:'get',
                success:function (re) {
                    var country = '';
                    for(var i = 0;i < re.length; i++) {
                        var objContry = re[i]['chinese_p_name'];
                        var p_ID = re[i]['p_ID'];
                        var english_p_name = re[i]['english_p_name'];

                        country += '<option value="'+objContry+','+english_p_name+','+p_ID+'">'+@if(Session::get('lang') == 'en') english_p_name; @else objContry @endif;+'</option>';
                    }

                    $("#province").html(country);
                    document.getElementById('province').value = "@if(isset($province)){{$province}}@endif";

                    var val = $("#province").val();
                    var arr=val.split(",");
                    var c_province_ID = arr[2];
                    $.ajax({
                        url:"{{url('house/houseLister/region')}}",
                        data:'c_province_ID='+c_province_ID,
                        type:'get',
                        success:function (re) {
                            var country = '';
                            for(var i = 0;i < re.length; i++) {
                                var objContry = re[i]['chinese_c_name'];
                                var english_c_name = re[i]['english_c_name'];
                                var number = re[i]['number'];
                                country += '<option value="'+objContry+','+english_c_name+','+number+'">'+@if(Session::get('lang') == 'en') english_c_name; @else objContry @endif;+'</option>';
                            }
                            $("#city").html(country);
                            document.getElementById('city').value = "@if(isset($city)){{$city}}@endif";
                        }
                    });
                }
            })


        }
        @else

        window.onload=function(){
            var val = $("#country").val();
            var arr=val.split(",");
            var p_nation_ID = arr[3];
            $.ajax({
                url:"{{url('house/houseLister/region')}}",
                data:'p_nation_ID='+p_nation_ID,
                type:'get',
                success:function (re) {
                    var country = '';
                    for(var i = 0;i < re.length; i++) {
                        var objContry = re[i]['chinese_p_name'];
                        var p_ID = re[i]['p_ID'];
                        var english_p_name = re[i]['english_p_name'];

                        country += '<option value="'+objContry+','+english_p_name+','+p_ID+'">'+@if(Session::get('lang') == 'en') english_p_name; @else objContry @endif;+'</option>';
                    }

                    $("#province").html(country);
                    var val = $("#province").val();
                    var arr=val.split(",");
                    var c_province_ID = arr[2];
                    $.ajax({
                        url:"{{url('house/houseLister/region')}}",
                        data:'c_province_ID='+c_province_ID,
                        type:'get',
                        success:function (re) {
                            var country = '';
                            for(var i = 0;i < re.length; i++) {
                                var objContry = re[i]['chinese_c_name'];
                                var english_c_name = re[i]['english_c_name'];
                                var number = re[i]['number'];
                                country += '<option value="'+objContry+','+english_c_name+','+number+'">'+@if(Session::get('lang') == 'en') english_c_name; @else objContry @endif;+'</option>';
                                //country += '<option value="'+objContry+','+english_c_name+','+number+'">'+objContry+'&nbsp;&nbsp;&nbsp;'+english_c_name+'</option>';
                            }
                            $("#city").html(country);

                        }
                    });
                }
            })
        }
        @endif

        //
        $("select#country").change(function(){
            var val = $("#country").val();
            var arr=val.split(",");
            var p_nation_ID = arr[3];
            $.ajax({
                url:"{{url('house/houseLister/region')}}",
                data:'p_nation_ID='+p_nation_ID,
                type:'get',
                success:function (re) {
                    var country = '';
                    for(var i = 0;i < re.length; i++) {
                        var objContry = re[i]['chinese_p_name'];
                        var p_ID = re[i]['p_ID'];
                        var english_p_name = re[i]['english_p_name'];
                        country += '<option value="'+objContry+','+english_p_name+','+p_ID+'">'+@if(Session::get('lang') == 'en') english_p_name; @else objContry @endif;+'</option>';
                    }
                    $("#province").html(country);
                    var val = $("#province").val();
                    var arr=val.split(",");
                    var c_province_ID = arr[2];
                    $.ajax({
                        url:"{{url('house/houseLister/region')}}",
                        data:'c_province_ID='+c_province_ID,
                        type:'get',
                        success:function (re) {
                            var country = '';
                            for(var i = 0;i < re.length; i++) {
                                var objContry = re[i]['chinese_c_name'];
                                var english_c_name = re[i]['english_c_name'];
                                var number = re[i]['number'];
                                country += '<option value="'+objContry+','+english_c_name+','+number+'">'+@if(Session::get('lang') == 'en') english_c_name; @else objContry @endif;+'</option>';
                                //country += '<option value="'+objContry+','+english_c_name+','+number+'">'+objContry+'&nbsp;&nbsp;&nbsp;'+english_c_name+'</option>';
                            }
                            $("#city").html(country);

                        }
                    })
                }
            })
        });

        //
        $("select#province").change(function(){
            var val = $("#province").val();
            var arr=val.split(",");
            var c_province_ID = arr[2];
            $.ajax({
                url:"{{url('house/houseLister/region')}}",
                data:'c_province_ID='+c_province_ID,
                type:'get',
                success:function (re) {
                    var country = '';
                    for(var i = 0;i < re.length; i++) {
                        var objContry = re[i]['chinese_c_name'];
                        var english_c_name = re[i]['english_c_name'];
                        var number = re[i]['number'];
                        country += '<option value="'+objContry+','+english_c_name+','+number+'">'+@if(Session::get('lang') == 'en') english_c_name; @else objContry @endif;+'</option>';
                    }
                    $("#city").html(country);

                }
            })
        });

        document.getElementById('country').value = "@if(isset($state)){{$state}}@endif"


    </script>
@stop


