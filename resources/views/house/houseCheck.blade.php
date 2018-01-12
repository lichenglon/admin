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

                        <span>国家地区：</span>
                            <select id="country" class="dept_select input-text" name="state" style="width:120px;">
                                <option value="">请选择</option>
                            @foreach($nationArr as $nation)
                                <option value="{{$nation->chinese_n_name}},{{$nation->english_n_name}},{{$nation->abbreviation}},{{$nation->n_ID}}">{{$nation->chinese_n_name}}</option>
                            @endforeach
                            </select>
                            <select id="province" class="dept_select input-text"  name="province" style="width:120px;"></select>
                            <select id="city" class="dept_select input-text" name="city" style="width:120px;"></select>
                        {{--<input type="text" class="input-text" value="@if($house_keyword != '%'){{$house_keyword}}@endif" placeholder="请输入关键字" name="house_keyword" style="width:250px;">--}}
                        <input type="submit" class="btn btn-default" name="search" value="搜索">

                    <div class="mt-20">
                        <table class="table table-border table-bordered table-bg table-hover table-sort">
                            <thead>
                            <tr class="text-c" id="theader">
                                <th>类型</th>
                                <th width="">ID</th>
                                <th width="">房源编号</th>
                                <th width="">房源结构</th>
                                <th width="">房源价格</th>
                                <th width="">房源大小</th>
                                {{--<th width="">房屋设备</th>--}}
                                <th width="">房源位置</th>
                                <th width="">租期时长</th>
                                {{--<th width="">房源状态</th>--}}
                                <th>审核状态</th>
                                <th width="">操作</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($result as $k=>$v)
                                @if($v->chk_sta == 1 || $v->chk_sta == 3)
                                <tr class="text-c">
                                    <td>{{ $v->house_type }}</td>
                                    <td>{{ $v->msgid }}</td>
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
                                            <label>审核通过 <input name="chk_sta" type="radio" value="2" onclick="javascript:if(window.confirm('确定要执行此操作吗？')){isCheck('2','{{$v->msgid}}')}" /></label>
                                            &nbsp;&nbsp;
                                            <label>审核不通过<input name="chk_sta" type="radio" value="3" onclick="javascript:if(window.confirm('确定要执行此操作吗？')){isCheck('3','{{$v->msgid}}')}" /></label>
                                        @elseif($v->chk_sta == 3)
                                            审核不通过
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('house/updateList/detail',['id'=>$v->msgid]) }}">修改房源</a>
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
                        <span class="r">共有数据：<strong>{{$total}}</strong> 条</span>
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
                url:"{{url('house/updateList/region')}}",
                data:'p_nation_ID='+p_nation_ID,
                type:'get',
                success:function (re) {
                    var country = '';
                    for(var i = 0;i < re.length; i++) {
                        var objContry = re[i]['chinese_p_name'];
                        var p_ID = re[i]['p_ID'];
                        var english_p_name = re[i]['english_p_name'];

                        country += '<option value="'+objContry+','+english_p_name+','+p_ID+'">'+objContry+'</option>';
                    }

                    $("#province").html(country);
                    document.getElementById('province').value = "@if(isset($province)){{$province}}@endif";
                    var val = $("#province").val();
                    var arr=val.split(",");
                    var c_province_ID = arr[2];
                    $.ajax({
                        url:"{{url('house/updateList/region')}}",
                        data:'c_province_ID='+c_province_ID,
                        type:'get',
                        success:function (re) {
                            var country = '';
                            for(var i = 0;i < re.length; i++) {
                                var objContry = re[i]['chinese_c_name'];
                                var english_c_name = re[i]['english_c_name'];
                                var number = re[i]['number'];
                                country += '<option value="'+objContry+','+english_c_name+','+number+'">'+objContry+'</option>';
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
                url:"{{url('house/updateList/region')}}",
                data:'p_nation_ID='+p_nation_ID,
                type:'get',
                success:function (re) {
                    var country = '';
                    for(var i = 0;i < re.length; i++) {
                        var objContry = re[i]['chinese_p_name'];
                        var p_ID = re[i]['p_ID'];
                        var english_p_name = re[i]['english_p_name'];

                        country += '<option value="'+objContry+','+english_p_name+','+p_ID+'">'+objContry+'</option>';
                    }

                    $("#province").html(country);
                    var val = $("#province").val();
                    var arr=val.split(",");
                    var c_province_ID = arr[2];
                    $.ajax({
                        url:"{{url('house/updateList/region')}}",
                        data:'c_province_ID='+c_province_ID,
                        type:'get',
                        success:function (re) {
                            var country = '';
                            for(var i = 0;i < re.length; i++) {
                                var objContry = re[i]['chinese_c_name'];
                                var english_c_name = re[i]['english_c_name'];
                                var number = re[i]['number'];
                                country += '<option value="'+objContry+','+english_c_name+','+number+'">'+objContry+'</option>';
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
                url:"{{url('house/updateList/region')}}",
                data:'p_nation_ID='+p_nation_ID,
                type:'get',
                success:function (re) {
                    var country = '';
                    for(var i = 0;i < re.length; i++) {
                        var objContry = re[i]['chinese_p_name'];
                        var p_ID = re[i]['p_ID'];
                        var english_p_name = re[i]['english_p_name'];
                        country += '<option value="'+objContry+','+english_p_name+','+p_ID+'">'+objContry+'</option>';
                    }
                    $("#province").html(country);
                    var val = $("#province").val();
                    var arr=val.split(",");
                    var c_province_ID = arr[2];
                    $.ajax({
                        url:"{{url('house/updateList/region')}}",
                        data:'c_province_ID='+c_province_ID,
                        type:'get',
                        success:function (re) {
                            var country = '';
                            for(var i = 0;i < re.length; i++) {
                                var objContry = re[i]['chinese_c_name'];
                                var english_c_name = re[i]['english_c_name'];
                                var number = re[i]['number'];
                                country += '<option value="'+objContry+','+english_c_name+','+number+'">'+objContry+'</option>';
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
                url:"{{url('house/updateList/region')}}",
                data:'c_province_ID='+c_province_ID,
                type:'get',
                success:function (re) {
                    var country = '';
                    for(var i = 0;i < re.length; i++) {
                        var objContry = re[i]['chinese_c_name'];
                        var english_c_name = re[i]['english_c_name'];
                        var number = re[i]['number'];
                        country += '<option value="'+objContry+','+english_c_name+','+number+'">'+objContry+'</option>';
                    }
                    $("#city").html(country);

                }
            })
        });

        document.getElementById('country').value = "@if(isset($state)){{$state}}@endif"


    </script>
@stop


