@extends('layouts.default')


@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="box">

        <!-- /.box-header -->
        <div class="box-body">

            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                <form action="{{ url('order/order') }}" method="post">
                    {{ csrf_field() }}
                    <h4 class="bg-info" style="padding:5px 10px; font-size:14px; overflow:hidden;">
                        <span style="line-height:34px;">订单列表</span>
                        <div style="float:right;">
                            <a href="{{ url('order/order/exportOrderData') }}" type="button" class="btn btn-default">导出EXCEL</a>
                        </div>
                    </h4>
                    <div class="row">
                        <div class="col-sm-2">
                            <label><b>订单状态：</b></label>
                            <select class="form-control" name="status" id="status">
                                <option value="">不限</option>
                                @foreach($status_all as $k=>$v)
                                    <option value="{{$k}}">{{$v}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <label><b>下单时间：</b> </label>
                            {{--<input type="text" name="begin_time"  class="form-control" id="begin_time" value="@if(isset($_REQUEST['begin_time'])) {{ $_REQUEST['begin_time'] }} @else 2014-09-19 00:00:00  @endif">--}}
                            <input type="text" name="stime" id="stime" class="form-control" value="@if(!empty($stime)){{$stime}}@endif" />
                            &nbsp;&nbsp;至&nbsp;&nbsp;
                            <input type="text" name="etime" id="etime" class="form-control" value="@if(!empty($etime)){{$etime}}@endif"/>
                            {{--<input type="text" name="end_time"  class="form-control" id="end_time" value="@if(isset($_REQUEST['end_time'])) {{ $_REQUEST['end_time'] }} @else {{ date('Y-m-d H:i:s') }}  @endif">--}}
                        </div>

                        <div class="col-sm-4">
                            <label><b>关键词搜索</b></label>
                            <select class="form-control" name="keyword_type">
                                <option value="tbuy_order.order_id" @if(isset($_REQUEST['keyword_type']) && $_REQUEST['keyword_type'] == 'order_id') selected @endif>订单ID</option>
                                <option value="tbuy_order.order_no" @if(isset($_REQUEST['keyword_type']) && $_REQUEST['keyword_type'] == 'order_no') selected @endif>订单编号</option>
                            </select>
                            <input type="text" class="form-control" name="keyword" value="{{ $_REQUEST['keyword'] or '' }}" placeholder="">

                        </div>
                        <div class="col-sm-2">
                            <input name="search" type="submit" class="btn btn-default" value="搜索">
                            <button type="reset" class="btn btn-default">重置</button>
                        </div>
                    </div>
                <div class="row" style="margin-bottom:10px;">
                </div>
                {{ $data->appends($_REQUEST)->links() }}
                <div class="row" style="height:600px;">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending"
                                    style="width: 50px;">订单号
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width: 223px;">
                                    下单人
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 322px;">
                                    电话
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    订单状态
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    备注信息
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    操作
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($data as $key => $value)

                                <tr role="row">
                                    <td class="sorting_1">{{ $value->order_no }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->tel }}</td>
                                    <td>{{ $orderStatus[$value->order_status] }}</td>
                                    <td>{{ $value->order_remark }}</td>
                                    {{--<td >--}}
                                        {{--@if($value->order_status == 1)--}}
                                            {{--<a href="{{ url('order/order/after_sale',[$value->order_id]) }}" target="dialog" width="600px" height="450px;">审核</a>--}}
                                        {{--@endif--}}
                                            {{--&nbsp;|&nbsp;--}}
                                        {{--<a href="{{ url('order/order/detail',['id'=>$value->order_id]) }}" target="">查看详情</a>--}}
                                    {{--</td>--}}
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
                    @if (!empty($data))
                        <div class="page_list">
                            {{$data->appends(Request::input())->links()}}
                            <div style="display:inline-block; margin-bottom:25px;">
                                <span class="r">共有数据：<strong>{{$total}}</strong> 条</span>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
        <!-- /.box-body -->
    </div>


@stop

@section('js')

    <script>

        //常规用法 日期
        laydate.render({
            elem: '#stime'
        });
        laydate.render({
            elem: '#etime'
        });

        //锁定搜索栏订单状态
        document.getElementById('status').value = "@if(isset($a_status)){{$a_status}}@endif"
    </script>
    @stop


