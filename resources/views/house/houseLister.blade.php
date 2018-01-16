@extends('layouts.default')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{asset('house/css/H-ui.min.css')}}" />
@stop

@section('content')

	<div class="box">
		<div class="box-body" style="height:750px">


			<div class="Hui-article">
				<article class="cl pd-20">
					<form action="{{url('house/houseLister')}}" method="get">
						<span class="select-box inline" style="width:100%;">
								{{ csrf_field() }}
							<input type="hidden" name="hidden" value="1">

							<select name="type" class="input-text" id="findType" style="width:8%;">
								<option value="%">@lang('house_translate.classification')</option>

								@foreach($typeObject as $value)
									<option value="{{$value->name}}">{{$value->name}}</option>
								@endforeach
							</select>

							&nbsp;&nbsp;
							<select name="search_k" class="input-text" id="search_k" style="width:10%;">
								<option value="%">@lang('house_translate.Please_choose')</option>
								<option value="serial_number">@lang('house_translate.Room_number')</option>
								<option value="house_structure">@lang('house_translate.Housing_structure')</option>
								<option value="house_price">@lang('house_translate.The_price')</option>
								<option value="house_location">@lang('house_translate.Housing_location')</option>
								<option value="house_keyword">@lang('house_translate.The_keyword')</option>
							</select>
							&nbsp;
							<input type="text" name="search_v" class="input-text" id="search_v" style="width:15%;"/>

							&nbsp;&nbsp;
							<input type="submit" class="btn btn-default" name="find" value="@lang('house_translate.Determine')">

							<input type="submit" class="btn btn-default" name="export" value="@lang('house_translate.Export_Excel')">

							<span class="r">
							@lang('house_translate.Common_data')：<strong>{{$houseCount}}</strong> @lang('house_translate.strip')
						</span>
                        </span>
					</form>
					{{--<div class="cl pd-5 bg-1 bk-gray mt-20">


					</div>--}}
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
								<th width="">@lang('house_translate.Home_state')</th>
								<th>@lang('house_translate.Audit_status')</th>
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
									<td class="text-l"><a href="{{url('house/houseLister/houseMap')}}"><u style="cursor:pointer" class="text-primary" title="查看">{{$val->house_location}}</u></a></td>
									<td>{{$val->house_rise}}<b style="font-size:15px;">~</b>{{$val->house_duration}}</td>
									<td width="">{{ $val->house_keyword }}</td>
									<td class="td-status"><span class="label label-success radius">{{$val->house_status}}</span></td>
									<td>
										@if($val->chk_sta == 1)
											未审核
										@elseif($val->chk_sta == 2)
											审核通过
										@elseif($val->chk_sta == 3)
											审核不通过
										@endif
									</td>
									<td class="f-14 td-manage">
										<a style="text-decoration:none" class="ml-5" href="{{url('house/houseLister/detail',['id'=>$val->msgid])}}" title="详细信息">@lang('house_translate.The_detailed_information')</a>
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
			document.getElementById('search_k').value='{{$search_k}}';
			document.getElementById('search_v').value='@if($search_v != "%"){{$search_v}}@endif';

			//常规用法 日期
			laydate.render({
				elem: '#rise'
			});
			laydate.render({
				elem: '#duration'
			});
		</script>
	@stop


