@extends('layouts.default')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{asset('house/css/H-ui.min.css')}}" />
@stop

@section('content')

	<div class="box">
		<div class="box-body">


			<div class="Hui-article">
				<article class="cl pd-20">

					<div class="cl pd-5 bg-1 bk-gray mt-20">

						<span class="select-box inline">
							<form action="{{url('house/findType')}}" method="post">
								<select name="type" class="select" id="findType">
									<option value="0">全部分类</option>
									@foreach($typeObject as $value)
									<option value="{{$value->name}}">{{$value->name}}</option>
									@endforeach
								</select>
							</form>
						</span>
						当前页面检索
						<input type="text" name="" id="searching" placeholder="Please enter the content you want to search" style="width:350px" class="input-text">
						日期范围：
						<input type="text" id="rise" class="input-text" style="width:120px;">
						-
						<input type="text" id="duration" class="input-text" style="width:120px;">

						<span class="r">共有数据：<strong>{{$houseCount}}</strong> 条</span>
					</div>
					<div class="mt-20">
						<table class="table table-border table-bordered table-bg table-hover table-sort">
							<thead>
							<tr class="text-c" id="theader">
								<th width="">ID</th>
								<th width="">房源编号</th>
								<th width="">房源结构</th>
								<th width="">房源价格</th>
								<th width="">房源大小</th>
								<th width="">房屋设备</th>
								<th width="">房源位置</th>
								<th width="">租期时长</th>
								<th width="">状态</th>
								<th width="">操作</th>
							</tr>
							</thead>
							<tbody>
							@foreach($houseObj as $key => $val)
								<tr class="text-c">
									<td>{{$val->msgid}}</td>
									<td class="text-l"><a href="{{url('house/houseLister/detail',['id'=>$val->msgid])}}"><u style="cursor:pointer" class="text-primary" title="查看">{{$val->serial_number}}</u></a></td>
									<td>{{$val->house_structure}}</td>
									<td>{{$val->house_price}}</td>
									<td><span>{{$val->house_size}}</span> /平方</td>
									<td><?php $equipment = explode(',',$val->house_facility); foreach ($equipment as $value){ echo $value.'&nbsp;&nbsp;&nbsp;'; }?></td>
									<td class="text-l"><u style="cursor:pointer" class="text-primary" title="查看">{{$val->house_location}}</u></td>
									<td>{{$val->house_rise}}<b style="font-size:15px;">~</b>{{$val->house_duration}}</td>
									<td class="td-status"><span class="label label-success radius">{{$val->house_status}}</span></td>
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
			//当前页面检索
			$(function(){
				$("#searching").keyup(function(){
					var txt=$("#searching").val();
					if($.trim(txt)!=""){
						$("table tr:not('#theader')").hide().filter(":contains('"+txt+"')").show();
					}else{
						$("table tr:not('#theader')").show();
					}
				});
			})
			//分类搜索表单提交
			$("select#findType").change(function(){
				console.log('11');
			})
		</script>
		<script>
			//常规用法 日期
			laydate.render({
				elem: '#rise'
			});
			laydate.render({
				elem: '#duration'
			});
		</script>
	@stop


