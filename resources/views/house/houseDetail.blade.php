@extends('layouts.default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('house/css/H-ui.min.css')}}" />
@stop

@section('content')
    <div class="box">
        &nbsp;&nbsp;<a href="javascript:window.history.go(-1);"><button name="" id="" class="btn btn-success">@lang('house_translate.Return_to_the_upper_level')</button></a>
        <div class="box-body">
            <div class="row">

                <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                           aria-describedby="example1_info">
                        <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.Room_number')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="8"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->serial_number}}
                            </td>
                        </tr>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.National_city')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="8"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->state}}>{{$houseMsg->province}}>{{$houseMsg->city}}
                            </td>
                        </tr>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.surrounding_information')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->rim_message}} <span>&nbsp;&nbsp;单位/分钟</span>
                            </td>
                        </tr>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.Detailed_location')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->house_location}}
                            </td>

                        </tr>

                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.Housing_structure')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->house_structure}}
                            </td>

                        </tr>

                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.Housing_prices')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->house_price}}
                            </td>

                        </tr>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.Housing_size')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->house_size}} <span>/平方</span>
                            </td>

                        </tr>

                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.deposit')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->cash_pledge}} <span>/元</span>
                            </td>

                        </tr>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.Prepayment_ratio')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->payment_proportion}}
                            </td>

                        </tr>

                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.The_method_of_payment')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->knot_way}}
                            </td>

                        </tr>

                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.House_equipment')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->house_facility}}
                            </td>

                        </tr>

                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.The_keyword')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->house_keyword}}
                            </td>
                        </tr>

                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.Introduction_of_housing')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->house_brief}}
                            </td>
                        </tr>

                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.The_lease_period')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->house_rise}}
                            </td>
                        </tr>

                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.The_longest_leases')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->house_duration}}
                            </td>
                        </tr>

                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.Home_state')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->house_status}}
                            </td>
                        </tr>

                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.The_landlord_name')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->landlord_name}}
                            </td>
                        </tr>

                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.Landlord_id_number')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->landlord_identity}}
                            </td>
                        </tr>

                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.The_landlord_email')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->landlord_email}}
                            </td>
                        </tr>

                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.The_landlord_telephone')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->landlord_phone}}
                            </td>
                        </tr>

                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.The_landlord_gender')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->landlord_sex}}
                            </td>
                        </tr>

                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.Address_of_landlord')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->landlord_site}}
                            </td>
                        </tr>

                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="width: 18%; font-size:15px;">@lang('house_translate.The_landlord_note')
                            </th>
                            <td class="sorting" tabindex="0" aria-controls="example1"
                                aria-label="Browser: activate to sort column ascending" style="font-size:15px;">
                                {{$houseMsg->landlord_remark}}
                            </td>
                        </tr>

                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                aria-sort="ascending"
                                aria-label="Rendering engine: activate to sort column descending"
                                style="font-size:15px; text-align:center;line-height:300px;">@lang('house_translate.picture')
                            </th>


                            <td class="sorting" tabindex="0" aria-controls="example1" 
                                aria-label="Browser: activate to sort column ascending" >
                                @foreach($imgArr as $value)
                                <img style="width:250px; height:300px;" src="{{asset('./uploads')}}/{{$value->house_imagename}}" alt="">
                                @endforeach
                            </td>

                        </tr>

                        </thead>

                    </table>

                </div>
            </div>


        </div>
    </div>

@stop

@section('js')

@stop

