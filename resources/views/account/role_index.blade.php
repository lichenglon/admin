@extends('layouts.default')



@section('content')

    <div class="box">


        <!-- /.box-header -->
        <div class="box-body">


            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                <h4 class="bg-info" style="padding:5px 10px; font-size:14px; overflow:hidden;">
                    <span style="line-height:34px;">@lang('account.The_role_list')</span>
                    <div style="float:right;">
                        <a href="/account/role/create" type="button" class="btn btn-default">@lang('account.New_role')</a>
                    </div>
                </h4>


                <div class="row" style="margin-bottom:10px;">
                    <div class="col-sm-9">

                        <label><b>@lang('account.Each_page_shows')：</b></label>
                        <select class="form-control">
                            <option selected="" value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>@lang('account.strip')
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                {{--<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending"
                                    style="width: 66px;">@lang('account.Serial_number')
                                </th>--}}
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width: 223px;">
                                    @lang('account.Character_name')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 205px;">
                                    @lang('account.A_status')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    @lang('account.Role_department')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    @lang('account.Upper_level')
                                </th>
                                {{--<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    @lang('account.Creation_time')
                                </th>--}}
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    @lang('account.operation')
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($role_lists as $value)

                                <tr role="row">
                                    {{--<td class="sorting_1">{{ $value->id }}</td>--}}
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->parse_status }}</td>
                                    <td>{{ $value->department_name }}</td>
                                    <td>{{ $value->parent_depart_name or '无' }}</td>
                                   {{-- <td>{{ $value->create_time }}</td>--}}
                                    <td><span>
                                        <a href="{{ url('account/role/updateStatus',['id'=>$value->id,'status'=>$value->status]) }}" class="layer-get">
                                            @if($value->status) @lang('account.disable') @else @lang('account.Enable') @endif
                                        </a>&nbsp;
                                        <a href="{{ url('account/role/'.$value->id.'/edit') }}">@lang('account.The_editor')</a>&nbsp;
                                        <a href="{{ url('account/role',['id'=>$value->id]) }}" token="{{ csrf_token() }}" class="layer-delete">@lang('account.delete')</a>
                                    </span></td>

                                </tr>

                            @endforeach



                            </tbody>

                        </table>
                    </div>
                </div>

                {{ $role_lists->links() }}


            </div>
        </div>
        <!-- /.box-body -->
    </div>

@stop



