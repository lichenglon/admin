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
                <h4 class="bg-info" style="padding:5px 10px; font-size:14px; overflow:hidden;">
                    <span style="line-height:34px;"><a href="{{ url('order/order') }}" >@lang('order.Order_list')</a> - @lang('order.Order_details')</span>
                    <div style="float:right;">
                        {{--<a href="{{ url('order/order/detail_excel',['id'=>$result->order_id]) }}" type="button" class="btn btn-default">导出EXCEL</a>--}}
                    </div>
                </h4>
                {{--{{ $data->appends($_REQUEST)->links() }}--}}

                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width: 100px;">
                                    @lang('order.Order_number')
                                </th>
                                <td class="sorting_1">{{ $result->order_no }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 100px;">
                                    @lang('order.Date')
                                </th>
                                <td>{{ $result->creat_time }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 120px;">
                                    @lang('order.Tenant_name')
                                </th>
                                <td>{{ $result->name }}</td>
                            </tr>
                            <tr role="row">
                                <th rowspan="1" colspan="1">
                                    @lang('order.Photo_of_ID_card')
                                </th>
                                <td>
                                    @if(!empty($result->renter_idcard1))
                                        <img src="{{HOUSE_SERVER_PATH}}uploads/{{$result->renter_idcard1}}" alt="" />
                                    @elseif(!empty($result->renter_idcard2))0.

                                    <img src="{{HOUSE_SERVER_PATH}}uploads/{{$result->renter_idcard2}}" alt="" />
                                    @endif
                                </td>
                            </tr>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending"
                                    style="width: 140px;">
                                    @lang('order.Passport_photo')
                                </th>
                                <td>
                                    @if(!empty($result->renter_passport))
                                        <img width="50px" height="50px" src="{{HOUSE_SERVER_PATH}}uploads/{{$result->renter_passport}}" alt="" />
                                    @else
                                    @endif
                                </td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width: 150px;">
                                    @lang('order.Student_card_photo')
                                </th>

                                <td>
                                    @if(!empty($result->stu_idcard))

                                        <img width="50" height="50" src="{{HOUSE_SERVER_PATH}}uploads/{{$result->stu_idcard}}" alt="" />
                                    @else
                                    @endif
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
                                <td>{{ $result->house_price }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width: 120px;">
                                    @lang('order.Lease_term')
                                </th>
                                <td>{{ $result->rent_time }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 150px;">
                                    @lang('order.Signing_time')
                                </th>
                                <td>{{ date('Y-m-d H:i:s', $result->sign_time) }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 150px;">
                                    @lang('order.contracting_place')
                                </th>
                                <td>{{ $result->sign_position }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 100px;">
                                    @lang('order.Order_status')
                                </th>
                                {{--<td>{{ $result->order_status }}</td>--}}
                                <td>{{ $orderStatus[$result->order_status] }}</td>
                            </tr>
                            <tr role="row">
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
                            </tr>
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


