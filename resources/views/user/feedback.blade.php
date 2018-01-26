@extends('layouts.default')


@section('content')



    <div class="box">
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <form action="{{ url('user/feedback') }}" method="post">
                    <span class="select-box inline" style="width:100%;">
                        {{ csrf_field() }}

                        {{--<h4 class="bg-info" style="padding-top:10px; padding-bottom:10px; font-size:14px; overflow:hidden;">
                            <span style="line-height:34px;">订单列表</span>
                            <div style="float:right;"><a href="{{ url('order/order/exportOrderData') }}" type="button" class="btn btn-default">导出EXCEL</a></div>
                        </h4>--}}

                        <div class="row" style="padding:20px;">

                            <label><b>关键词搜索</b></label>&nbsp;&nbsp;
                            <select class="form-control" name="kwd_k" id="kwd_k">.
                                <option value="">请选择</option>
                                <option value="yourname">姓名</option>
                                <option value="email">邮箱地址</option>
                                <option value="phonenumber">电话号码</option>
                                <option value="message">详细信息</option>
                            </select>
                            <input type="text" class="form-control" name="msg" value="@if($msg != '%'){{$msg}}@endif" placeholder="">&nbsp;&nbsp;&nbsp;&nbsp;
                            <label><b>提交日期：</b> </label>
                            <input type="text" name="stime" id="stime" class="form-control" value="@if($stime != '%'){{$stime}}@endif" />&nbsp;&nbsp;至&nbsp;&nbsp;
                            <input type="text" name="etime" id="etime" class="form-control" value="@if($etime != '%'){{$etime}}@endif"/>&nbsp;&nbsp;&nbsp;&nbsp;

                            <input name="search" type="submit" class="btn btn-default" id="seek" value="搜索">&nbsp;&nbsp;
                            <button type="reset" class="btn btn-default" onclick="reset()">重置</button>&nbsp;&nbsp;
                        </div>
                    </span>
                </form>
                {{--<div class="row" style="margin-bottom:10px;"></div>--}}


                <div class="row" style="height:600px;">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending"
                                    style="width:10%;">姓名
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width:10%;">
                                    邮箱地址
                                </th>

                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width:10%;">
                                     电话号码
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width:15%;">
                                    日期
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width:15%;">
                                    详细信息
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($arr as $value)
                                    <tr>
                                        <td>{{$value->yourname}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>{{$value->phonenumber}}</td>
                                        <td>{{$value->time}}</td>
                                        <td>{{$value->message}}</td>
                                    </tr>
                                    @endforeach
                            </tbody>

                        </table>
                        <div class="page_list">
                            @if(!empty($arr))
                            {{$arr->appends(Request::input())->links()}}
                            @endif
                            <div style="display:inline-block; margin-bottom:25px;">
                                <span style="float:left; margin-left:30px;">共有数据：<strong>{{$total}}</strong> 条</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@stop

@section('js')


    <script>
        document.getElementById('kwd_k').value="@if($kwd_k != '%'){{$kwd_k}}@endif"

       //时间选择器
        laydate.render({
            elem: '#stime'
            ,type: 'datetime'
        });
        laydate.render({
            elem: '#etime'
            ,type: 'datetime'
        });


    </script>
@stop


