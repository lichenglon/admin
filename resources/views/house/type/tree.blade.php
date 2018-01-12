
@foreach($tree as $values)
<dl class="cate-item">
	<dt class="cf">
	<form action="{{url('house/type/update')}}" method="post">
		<div class="btn-toolbar opt-btn cf">
			<a class="layer-delete" href="{{ url('house/type/delete',['id'=>$values['id']]) }}">@lang('house_translate.delete')</a>
		</div>
		<div class="fold"><i></i></div>
		<div class="order">{{ $values['id'] }}</div>
		<div class="order"><input type="text" name="sort_number" class="text input-mini" value="{{$values['sort_number']}}"></div>

		<div class="name">
			<span class="tab-sign"></span>
			<input type="hidden" name="id" value="{{ $values['id'] }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="text" name="name" class="text" value="{{ $values['name'] }}">

			<span class="help-inline msg"></span>
		</div>
	</form>
	</dt>
	@if(!empty($values['children']))
	<dd style="display:none;">
		@include('house.type.tree', ['tree' => $values['children']])
	</dd>
	@endif
</dl>
@endforeach