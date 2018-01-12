@extends('layouts.default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('house/css/H-ui.min.css')}}" />
@stop

@section('content')

    <div class="box">
        <div class="box-body">


            <div class="Hui-article">
                <article class="cl pd-20">
                    <form action="{{url('house/updateList')}}" method="get">
						<span class="select-box inline" style="width:100%;">
								{{ csrf_field() }}
                            <input type="hidden" name="hidden" value="1">
							<select name="type" class="select" id="findType">
                                <option value="%">@lang('house_translate.classification')</option>
                                @foreach($typeObject as $value)
                                    <option value="{{$value->name}}">{{$value->name}}</option>
                                @endforeach
                            </select>
							<input type="text" class="input-text" value="@if($serial_number != '%'){{$serial_number}}@endif" placeholder="@lang('house_translate.Room_number')" maxlength="255" name="serial_number" style="width:150px;">
							<input type="text" class="input-text" value="@if($house_structure != '%'){{$house_structure}}@endif" placeholder="@lang('house_translate.Housing_structure')" maxlength="255" name="house_structure" style="width:150px;">
							<input type="number" class="input-text" value="@if($house_price != '%'){{$house_price}}@endif" placeholder="@lang('house_translate.Housing_prices')" maxlength="255" name="house_price" style="width:150px;">
							<input type="text" class="input-text" value="@if($house_location != '%'){{$house_location}}@endif" placeholder="@lang('house_translate.Housing_location')" maxlength="255" name="house_location" style="width:250px;">
                            <input type="text" class="input-text" value="@if($house_keyword != '%'){{$house_keyword}}@endif" placeholder="@lang('house_translate.The_keyword')" maxlength="255" name="house_keyword" style="width:250px;">

							<input type="submit" class="btn btn-default" name="find" value="@lang('house_translate.determine')">
							<input type="submit" class="btn btn-default" name="export" value="@lang('house_translate.Export_Excel')">

							<span class="r">
							@lang('house_translate.Common_data')：<strong>{{$houseCount}}</strong> @lang('house_translate.strip')
						</span>
                        </span>
                    </form>

                    <div class="mt-20">
                        <table class="table table-border table-bordered table-bg table-hover table-sort">
                            <thead>
                            <tr class="text-c" id="theader">
                                <th>@lang('house_translate.classification')</th>
                                <th width="">@lang('house_translate.Room_number')</th>
                                <th width="">@lang('house_translate.Housing_structure')</th>
                                <th width="">@lang('house_translate.Housing_prices')</th>
                                <th width="">@lang('house_translate.Housing_size')</th>
                                <th width="">@lang('house_translate.House_equipment')</th>
                                <th width="">@lang('house_translate.Housing_location')</th>
                                <th width="">@lang('house_translate.The_lease_time')</th>
                                <th width="">@lang('house_translate.The_keyword')</th>
                                <th width="">@lang('house_translate.state')</th>
                                <th width="">@lang('house_translate.operation')</th>
                            </tr>
                            </thead>
                            <tbody>
                           @foreach($houseObj as $key => $val)
                                <tr class="text-c">
                                    <td>{{$val->house_type}}</td>
                                    <td class="text-l"><a href="{{url('house/houseLister/detail',['id'=>$val->msgid])}}"><u style="cursor:pointer" class="text-primary" title="查看">{{$val->serial_number}}</u></a></td>
                                    <td>{{$val->house_structure}}</td>
                                    <td>{{$val->house_price}}</td>
                                    <td><span>{{$val->house_size}}</span> /平方</td>
                                    <td><?php $equipment = explode(',',$val->house_facility); foreach ($equipment as $value){ echo $value.'&nbsp;&nbsp;&nbsp;'; }?></td>
                                    <td class="text-l"><u style="cursor:pointer" class="text-primary" title="查看">{{$val->house_location}}</u></td>
                                    <td>{{$val->house_rise}}<b style="font-size:15px;">~</b>{{$val->house_duration}}</td>
                                    <td>{{$val->house_keyword}}</td>
                                    <td class="td-status"><span class="label label-success radius">{{$val->house_status}}</span></td>
                                    <td class="f-14 td-manage">
                                        <a style="text-decoration:none" class="ml-5" href="{{url('house/updateList/detail',['id'=>$val->msgid])}}" title="更新房源">@lang('house_translate.Update_the_housing')</a>
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
        document.getElementById('findType').value='{{$type}}';
    </script>

@stop


