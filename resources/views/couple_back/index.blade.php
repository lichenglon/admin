@extends('layouts.default')


@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="box">
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <form action="{{ url('order/order') }}" method="post">
                    <span class="select-box inline" style="width:100%;">
                        {{ csrf_field() }}

                        {{--<h4 class="bg-info" style="padding-top:10px; padding-bottom:10px; font-size:14px; overflow:hidden;">
                            <span style="line-height:34px;">订单列表</span>
                            <div style="float:right;"><a href="{{ url('order/order/exportOrderData') }}" type="button" class="btn btn-default">导出EXCEL</a></div>
                        </h4>--}}

                        <div class="row" style="padding:20px;">
                            <label><b>@lang('order.Order_status')：</b></label>
                            <select class="form-control" name="status" id="status">
                                <option value="">@lang('order.Unlimited')</option>
                                @foreach($status_all as $k=>$v)
                                    <option value="{{ $v->id }}">@if(Session::get('lang') == 'en') {{$v->en_order_status}} @else {{ $v->order_status }} @endif</option>
                                @endforeach
                            </select>&nbsp;&nbsp;&nbsp;&nbsp;
                            <label><b>@lang('order.Order_time')：</b> </label>
                            <input type="text" name="stime" id="stime" class="form-control" value="" />&nbsp;&nbsp;@lang('order.to')&nbsp;&nbsp;
                            <input type="text" name="etime" id="etime" class="form-control" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;
                            <label><b>@lang('order.Keyword_search')</b></label>&nbsp;&nbsp;
                            <select class="form-control" name="kwd_k" id="kwd_k">
                                <option value="">@lang('order.Please_choose')</option>
                                <option value="order_no">@lang('order.Order_number')</option>
                                {{--<option value="u_name">下单人</option>--}}
                                <option value="name">@lang('order.Tenant_name')</option>
                                <option value="tel">@lang('order.Tenant_phone')</option>
                            </select>
                            <input type="text" class="form-control" name="kwd_v" id="kwd_v" value="" placeholder="">&nbsp;&nbsp;&nbsp;&nbsp;
                            <input name="search" type="submit" class="btn btn-default" value="@lang('order.search')">&nbsp;&nbsp;
                            <button type="reset" class="btn btn-default">@lang('order.Reset')</button>&nbsp;&nbsp;
                            <input name="excel" type="submit" class="btn btn-default" value="@lang('order.export_excel')">
                            {{--<div style="float:right;"><a href="{{ url('order/order/order_excel') }}" class="btn btn-default">导出EXCEL</a></div>--}}
                        </div>
                    </span>
                </form>
                {{--<div class="row" style="margin-bottom:10px;"></div>--}}

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
                                    style="width:20%;">@lang('order.Order_number')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width:10%;">
                                    @lang('order.Single_person')
                                </th>

                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width:10%;">
                                    @lang('order.Tenant_phone')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width:15%;">
                                    @lang('order.Order_time')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width:10%;">
                                    @lang('order.Order_status')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width:15%;">
                                    @lang('order.Remark_information')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width:10%;">
                                    @lang('order.operation')
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($data as $key => $value)


                                @if($value->order_status == '2' || $value->order_status == '3' || $value->order_status == '4' || $value->order_status == '5' || $value->order_status == '6' || $value->order_status == '7' || $value->order_status == '8' || ($value->order_status == '9' && $value->qx_reason != '' ))




                                    <tr role="row">
                                        <td class="sorting_1"><a href="{{ url('order/order/detail',['id'=>$value->order_id]) }}" target="">{{ $value->order_no }}</a></td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->tel }}</td>
                                        <td>{{ date('Y-m-d H:i:s',$value->creat_time) }}</td>
                                        <td>
                                            @if($value->order_status == '1')
                                                @lang('order.Order_not_paid')
                                            @elseif($value->order_status == '2')
                                                @lang('order.Order_not_reviewed')
                                            @elseif($value->order_status == '3')
                                                @lang('order.Order_audit')
                                            @elseif($value->order_status == '4')
                                                @lang('order.approved')
                                            @elseif($value->order_status == '5')
                                                @lang('order.Order_is_rejected')
                                            @elseif($value->order_status == '6')
                                                @lang('order.Order_confirmed')
                                            @elseif($value->order_status == '7')
                                                @lang('order.The_contract_has_been_uploaded')
                                            @elseif($value->order_status == '8')
                                                @lang('order.Order_completed')
                                            @elseif($value->order_status == '9')
                                                @lang('order.Order_cancellation')
                                            @endif
                                        </td>
                                        <td>{{ $value->order_remark }}</td>
                                        <td >



                                            @if($value->order_status == 2 || $value->order_status == 3)
                                                <a href="{{ url('order/order/check',['id'=>$value->order_id]) }}" target="">去审核</a>
                                                {{-- <label>审核通过<input name="order_status" type="radio" value="8" onclick="javascript:if(window.confirm('确定要执行此操作吗？')){isCheck('4','{{$value->order_id}}')}" /></label>
                                                 &nbsp;&nbsp;
                                                 <label>审核不通过<input name="order_status" type="radio" value="3" onclick="javascript:if(window.confirm('确定要执行此操作吗？')){isCheck('5','{{$value->order_id}}')}" /></label>--}}
                                            @else
                                                <a href="{{ url('order/order/detail',['id'=>$value->order_id]) }}" target="">@lang('order.View_the_details')</a>

                                            @endif

                                        </td>
                                    </tr>
                                @endif
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
            </div>
        </div>
    </div>


@stop

@section('js')

    <script>
        //常规用法 日期
        laydate.render({elem: '#stime'});
        laydate.render({elem: '#etime'});
        //锁定搜索栏订单状态
        document.getElementById('status').value="@if(isset($a_status)){{$a_status}}@endif"
        document.getElementById('stime').value="@if(isset($stime)){{$stime}}@endif"
        document.getElementById('etime').value="@if(isset($etime)){{$etime}}@endif"
        document.getElementById('kwd_k').value="@if(isset($kwd_k)){{$kwd_k}}@endif"
        document.getElementById('kwd_v').value="@if(isset($kwd_v)){{$kwd_v}}@endif"


        //审核状态的更改
        function isCheck(number,order_id){
            $.ajax({
                url:"{{url('order/order/isCheck')}}",
                data: 'order_statuss='+number+'&order_id='+order_id,
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

    </script>
@stop


