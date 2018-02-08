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
                <h4 class="bg-info" style="padding:5px 10px; font-size:14px; overflow:hidden; width:50%" >
                    <span style="line-height:34px;"><a href="{{ url('order/order') }}" >@lang('order.Order_list')</a> - @lang('order.Order_details')</span>
                </h4>
                {{--{{ $data->appends($_REQUEST)->links() }}--}}

                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info"  style="width:50%">
                            <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width:10%;">
                                    @lang('order.Order_number')
                                </th>
                                <td class="sorting_1" style="width:30%;">{{ $result->order_no }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 100px;">
                                    @lang('order.Date')
                                </th>
                                <td>{{ date('Y-m-d',$result->creat_time) }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 120px;">
                                    @lang('order.Tenant_name')
                                </th>
                                <td>{{ $renter->r_name }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 120px;">
                                    @lang('order.fname')
                                </th>
                                <td>{{ $renter->fname }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 120px;">
                                    @lang('order.lname')
                                </th>
                                <td>{{ $renter->lname }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width: 150px;">
                                    @lang('order.Photo_of_ID_card')
                                </th>
                                <td class="sorting" tabindex="0" aria-controls="example1" aria-label="Browser: activate to sort column ascending">
                                    <div style="float:left;"><img width="300" height="150"  src="{{HOUSE_SERVER_PATH}}uploads/{{$renter->renter_idcard1}}" alt=""></div>
                                    <div style="float:left; margin-left:10px;"><img width="300" height="150"  src="{{HOUSE_SERVER_PATH}}uploads/{{$renter->renter_idcard2}}" alt=""></div>
                                </td>
                            </tr>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 140px;">
                                    @lang('order.Passport_photo')
                                </th>
                                <td>
                                    <img width="300" height="150" src="{{HOUSE_SERVER_PATH}}uploads/{{$renter->renter_passport}}" alt="" />
                                </td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width: 150px;">
                                    @lang('order.Student_card_photo')
                                </th>
                                <td>
                                    <img width="300" height="150" src="{{HOUSE_SERVER_PATH}}uploads/{{$renter->stu_idcard}}" alt="" />
                                </td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 322px;">
                                    @lang('order.Room_number')
                                </th>
                                <td>{{ $result->serial_number }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 120px;">
                                    @lang('order.House_name')
                                </th>
                                <td>{{ $result->house_name }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 120px;">
                                    @lang('order.Housing_location')
                                </th>
                                <td>{{ $result->house_location }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending"
                                    style="width: 80px;">
                                    @lang('order.Price')
                                </th>
                                <td>$ {{ $result->house_price }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending"
                                    style="width: 80px;">
                                    @lang('order.p_money')
                                </th>
                                <td>￥ {{ $result->payment_amount }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width: 120px;">
                                    @lang('order.Lease_term')
                                </th>
                                <td>{{ $result->rent_time }} @lang('order.week')</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 150px;">
                                    @lang('order.Signing_time')
                                </th>
                                <td>{{ date('Y-m-d', $result->sign_time) }}</td>
                            </tr>
                           {{-- <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 150px;">
                                    @lang('order.contracting_place')
                                </th>
                                <td>{{ $result->sign_position }}</td>
                            </tr>--}}
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 100px;">
                                    @lang('order.Order_status')
                                </th>
                                {{--<td>{{ $result->order_status }}</td>--}}
                                <td>{{ $orderStatus->get_order_status($result->order_status)}}</td>
                            </tr>
                            {{--<tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    @lang('order.contract')
                                </th>
                                <td>{{ $result->contract }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    @lang('order.evaluate')
                                </th>
                                <td>{{ $result->house_eva }}</td>
                            </tr>--}}
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    <a href="{{ url('order/order') }}">@lang('order.Return_to_the_list_of_orders')</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>




            </div>
        </div>
        <!-- /.box-body -->
    </div>


@stop

@section('js')

    <script>

        //时间插件初始化
        jeDate({
            dateCell:"#begin_time",
            format:"YYYY-MM-DD hh:mm:ss",
            isinitVal:true,
            isTime:true, //isClear:false,
            minDate:"2014-09-19 00:00:00",
        });
        jeDate({
            dateCell:"#end_time",
            format:"YYYY-MM-DD hh:mm:ss",
            isinitVal:true,
            isTime:true, //isClear:false,
            minDate:"2014-09-19 00:00:00",
        });
    </script>

@stop


