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
							<select name="type" class="input-text" id="findType" style="width:80px;">
								<option value="%">分类</option>
								@foreach($typeObject as $value)
									<option value="{{$value->name}}">{{$value->name}}</option>
								@endforeach
							</select>
							&nbsp;&nbsp;
							<select name="search_k" class="input-text" id="search_k" style="width:150px;">
								<option value="%">请选择</option>
								<option value="serial_number">房源编号</option>
								<option value="house_structure">房源结构</option>
								<option value="house_price">价格</option>
								<option value="house_location">房源位置</option>
								<option value="house_keyword">关键字</option>
							</select>
							&nbsp;
							<input type="text" name="search_v" class="input-text" id="search_v" style="width:180px;"/>


							{{--<input type="text" class="input-text" value="@if($serial_number != '%'){{$serial_number}}@endif" placeholder="房源编号" maxlength="255" name="serial_number" style="width:150px;">--}}
							{{--<input type="text" class="input-text" value="@if($house_structure != '%'){{$house_structure}}@endif" placeholder="房源结构" maxlength="255" name="house_structure" style="width:150px;">--}}
							{{--<input type="number" class="input-text" value="@if($house_price != '%'){{$house_price}}@endif" placeholder="价格" maxlength="255" name="house_price" style="width:150px;">--}}
							{{--<input type="text" class="input-text" value="@if($house_location != '%'){{$house_location}}@endif" placeholder="房源位置" maxlength="255" name="house_location" style="width:250px;">--}}
                            {{--<input type="text" class="input-text" value="@if($house_keyword != '%'){{$house_keyword}}@endif" placeholder="关键字" maxlength="255" name="house_keyword" style="width:250px;">--}}
							&nbsp;&nbsp;
							<input type="submit" class="btn btn-default" name="find" value="确定">

							<input type="submit" class="btn btn-default" name="export" value="导出Excel">

							<span class="r">
							共有数据：<strong>{{$houseCount}}</strong> 条
						</span>
                        </span>
					</form>
					{{--<div class="cl pd-5 bg-1 bk-gray mt-20">


					</div>--}}
					<div class="mt-20">
						<table class="table table-border table-bordered table-bg table-hover table-sort">
							<thead>
							<tr class="text-c" id="theader">
								<th>类型</th>
								<th width="">ID</th>
								<th width="">房源编号</th>
								<th width="">房源结构</th>
								<th width="">房源价格</th>
								<th width="">房源大小</th>
								<th width="">房屋设备</th>
								<th width="">房源位置</th>
								<th width="">租期时长</th>
								<th width="">关键字</th>
								<th width="">房源状态</th>
								<th>审核状态</th>
								<th width="">操作</th>
							</tr>
							</thead>
							<tbody>
							@foreach($houseObj as $key => $val)
								<tr class="text-c">
									<td>{{$val->house_type}}</td>
									<td>{{$val->msgid}}</td>
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
										<a style="text-decoration:none" class="ml-5" href="{{url('house/houseLister/detail',['id'=>$val->msgid])}}" title="详细信息">详细信息</a>
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


