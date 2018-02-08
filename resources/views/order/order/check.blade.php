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
                </h4>
                <div class="row">
                    <div class="col-sm-12">
                        <form action="{{ url('order/order/saveChk') }}" method="post">
                            <input type="hidden" name="id" value="{{ $result->id }}">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 100px;">
                                    @lang('order.Order_number')
                                </th>
                                <td class="sorting_1">{{ $result->order_no }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 100px;">
                                    @lang('order.Date')
                                </th>
                                <td>{{ $result->creat_time }}</td>
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
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 150px;">
                                    @lang('order.Photo_of_ID_card')
                                </th>
                                <td class="sorting" tabindex="0" aria-controls="example1" aria-label="Browser: activate to sort column ascending">
                                    <img width="300" height="150"  src="{{HOUSE_SERVER_PATH}}uploads/{{$renter->renter_idcard1}}" alt="">
                                    <img width="300" height="150"  src="{{HOUSE_SERVER_PATH}}uploads/{{$renter->renter_idcard2}}" alt="">
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
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 100px;">
                                    @lang('order.Student_card_photo')
                                </th>
                                <td>
                                    <img width="300" height="150" src="{{HOUSE_SERVER_PATH}}uploads/{{$renter->stu_idcard}}" alt="" />
                                </td>
                            </tr>

                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 150px;">
                                    @lang('order.Room_number')
                                </th>
                                <td>{{ $result->serial_number }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 120px;">
                                    @lang('order.House_name')
                                </th>
                                <td>{{ $result->house_name }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 120px;">
                                    @lang('order.Housing_location')
                                </th>
                                <td>{{ $result->house_location }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 80px;">
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
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 120px;">
                                    @lang('order.Lease_term')
                                </th>
                                <td>{{ $result->rent_time }} @lang('order.week')</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 150px;">
                                    @lang('order.Signing_time')
                                </th>
                                <td>{{ date('Y-m-d H:i:s', $result->sign_time) }}</td>
                            </tr>
                            {{--<tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 150px;">
                                    @lang('order.contracting_place')
                                </th>
                                <td>{{ $result->sign_position }}</td>
                            </tr>--}}
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 100px;">
                                    @lang('order.Order_status')
                                </th>
                                <td>{{ $orderStatus[$result->order_status] }}</td>
                            </tr>
                            {{--<tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    @lang('order.contract')
                                </th>
                                <td>{{ $result->contract }}</td>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    @lang('order.evaluate')
                                </th>
                                <td>{{ $result->house_eva }}</td>
                            </tr>--}}
                            <tr role="row" aria-required="true">
                                <th><label>审核通过&nbsp;&nbsp;&nbsp;<input type="radio" name="order_status"  class="order_status" onclick="javascript:isRej('4');" value="4"/></label></th>
                                <th><label>审核不通过&nbsp;&nbsp;&nbsp;<input type="radio" name="order_status" class="order_status" onclick="javascript:isRej('5');" value="5"/></label></th>
                            </tr>
                             <tr role="row" id="rej" style="display:none;">
                                 <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                     请选择审核不通过原因
                                 </th>
                                 <td>
                                     <select name="reject_reason" id="">
                                         <option value="1">房源已出租</option>
                                         <option value="2">信息审核不通过 </option>
                                         <option value="3">租期不合要求</option>
                                     </select>
                                 </td>
                             </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    <button>提交审核</button>
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    <a href="{{ url('order/order') }}">@lang('order.Return_to_the_list_of_orders')</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        </form>
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

        function isRej(num)
        {
            if(num == '5'){
                $('#rej').css('display','');
            }
            if(num == '4'){
            $('#rej').css('display','none');
            }
        }
    </script>

@stop


