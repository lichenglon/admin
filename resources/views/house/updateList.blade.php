@extends('layouts.default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('house/css/H-ui.min.css')}}" />
@stop

@section('content')

    <div class="box">
        <div class="box-body">


            <div class="Hui-article">
                <article class="cl pd-20">
                    <div class="cl pd-5 bg-1 bk-gray mt-20">

						<span class="select-box inline">
							<form action="{{url('house/houseLister/findType')}}" method="post" id="typeSubmit">
                                {{ csrf_field() }}
                                <input type="hidden" name="hidden" value="1">
                                <select name="type" class="select" id="findType">
                                    <option value="0">分类</option>
                                    @foreach($typeObject as $value)
                                        <option value="{{$value->name}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </form>
						</span>
                        当前页面检索
                        <input type="text" name="" id="searching" placeholder="Please enter the content you want to search" style="width:350px" class="input-text">

                        <form action="{{url('house/houseLister/findDate')}}" method="post" id="dateSubmit" style="display:inline-block">
                            {{ csrf_field() }}
                            <input type="hidden" name="hidden" value="1">
                            日期范围：
                            <input type="text" id="rise" name="rise" value="" class="input-text" style="width:120px;"/>
                            -
                            <input type="text" id="duration" name="duration" value="" class="input-text" style="width:120px;">
                            <input type="button" value="确定" id="findDate">
                        </form>

                        <span class="r">共有数据：<strong>{{$houseCount}}</strong> 条</span>
                    </div>
                    <div class="mt-20">
                        <table class="table table-border table-bordered table-bg table-hover table-sort">
                            <thead>
                            <tr class="text-c" id="theader">
                                <th width="25"><input type="checkbox" name="" value=""></th>
                                <th width="">ID</th>
                                <th width="">房源编号</th>
                                <th width="">房源结构</th>
                                <th width="">房源价格</th>
                                <th width="">房源大小</th>
                                <th width="">房屋设备</th>
                                <th width="">房源位置</th>
                                <th width="">租期时长</th>
                                <th width="">状态</th>
                                <th width="">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                           @foreach($houseObj as $key => $val)
                                <tr class="text-c">
                                    <td><input type="checkbox" value="{{$val->msgid}}" name=""></td>
                                    <td>{{$val->msgid}}</td>
                                    <td class="text-l"><a href="{{url('house/houseLister/detail',['id'=>$val->msgid])}}"><u style="cursor:pointer" class="text-primary" title="查看">{{$val->serial_number}}</u></a></td>
                                    <td>{{$val->house_structure}}</td>
                                    <td>{{$val->house_price}}</td>
                                    <td><span>{{$val->house_size}}</span> /平方</td>
                                    <td><?php $equipment = explode(',',$val->house_facility); foreach ($equipment as $value){ echo $value.'&nbsp;&nbsp;&nbsp;'; }?></td>
                                    <td class="text-l"><u style="cursor:pointer" class="text-primary" title="查看">{{$val->house_location}}</u></td>
                                    <td>{{$val->house_rise}}<b style="font-size:15px;">~</b>{{$val->house_duration}}</td>
                                    <td class="td-status"><span class="label label-success radius">{{$val->house_status}}</span></td>
                                    <td class="f-14 td-manage">
                                        <a style="text-decoration:none" class="ml-5" href="{{url('house/updateList/detail',['id'=>$val->msgid])}}" title="更新房源">更新房源</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </article>
            </div>
            <!-- 分页 -->
            @if (!empty($houseObj))
                <div class="page_list">
                    {{$houseObj->appends(Request::input())->links()}}
                </div>
            @endif

        </div>
    </div>


@stop

@section('js')
    <script>
        //当前页面检索
        $(function(){
            $("#searching").keyup(function(){
                var txt=$("#searching").val();
                if($.trim(txt)!=""){
                    $("table tr:not('#theader')").hide().filter(":contains('"+txt+"')").show();
                }else{
                    $("table tr:not('#theader')").show();
                }
            });
        });
        //分类搜索表单提交
        $("select#findType").change(function(){
            $("#typeSubmit").submit();
        });
        //日期搜索
        $('#findDate').click(function(){
            var rise = $('#rise').val();
            var duration = $('#duration').val();
            if(rise != '' && duration != ''){
                $('#dateSubmit').submit();
            }
        });
    </script>

@stop


