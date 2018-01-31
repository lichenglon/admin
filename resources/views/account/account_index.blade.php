@extends('layouts.default')


@section('content')

    <div class="box">

        <!-- /.box-header -->
        <div class="box-body">

            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                <form action="{{ url('account/user') }}" method="post">
                    {{ csrf_field() }}
                    <h4 class="bg-info" style="padding:10px; font-size:14px;">@lang('account.Account_search')</h4>
                    <div class="row">

                        <div class="col-sm-5">
                            <label><b>@lang('account.Keyword_search')</b></label>
                            <select class="form-control" name="keyword_type">
                                <option value="name" @if(Request::get('keyword_type') == 'name') {{ Request::get('keyword_type')  }} @endif>@lang('account.name')</option>
                            </select>
                            <input type="text" class="form-control" name="keyword" value="{{ Request::get('keyword') }}" placeholder="">
                            <input name="search" type="submit" class="btn btn-default" value="@lang('account.search')">
                        </div>


                    </div>

                </form>

                <h4 class="bg-info" style="padding:5px 10px; font-size:14px; overflow:hidden;">
                    <span style="line-height:34px;">@lang('account.List_of_business_people')</span>
                    <div style="float:right;">
                        <a href="/account/user/create" type="button" class="btn btn-default">@lang('account.New_account')</a>
                    </div>
                </h4>


                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th style="width:20px;"><input type="checkbox" name="" class="check-all" id=""></th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending" style="width: 223px;">
                                    @lang('account.name')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending" style="width: 205px;">
                                    @lang('account.account')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    @lang('account.User_roles')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    @lang('account.area')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    @lang('account.contact')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    @lang('account.enabled')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    @lang('account.Creation_time')
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                                    @lang('account.operation')
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($account_lists as $value)
                                @if($value->username != 'root')
                                <tr role="row">
                                    <td><input type="checkbox" name="" class="ids" id=""></td>
                                    {{--<td class="sorting_1">{{ $value->id }}</td>--}}
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->username }}</td>
                                    <td>{{ $value->parse_role_id }}</td>
                                    <td>{{ $value->area }}</td>
                                    <td>{{ $value->tel }}</td>
                                    <td>@if(!$value->status) @lang('account.disable') @else @lang('account.Enable') @endif</td>
                                    <td>{{ date('Y-m-d H:i:s',$value->create_time) }}</td>
                                    <td><span>
                                        <a href="{{ url('account/user/updateStatus',['id'=>$value->id,'status'=>$value->status]) }}" class="layer-get">
                                            @if($value->status) @lang('account.disable') @else @lang('account.Enable') @endif
                                        </a>&nbsp;
                                        <a href="{{ url('account/user/'.$value->id.'/edit') }}">@lang('account.The_editor')</a>&nbsp;
                                        <a href="{{ url('account/user',['id'=>$value->id]) }}" token="{{ csrf_token() }}" class="layer-delete">@lang('account.delete')</a>
                                    </span></td>
                                </tr>
                                @endif
                            @endforeach



                            </tbody>

                        </table>
                    </div>
                </div>

                {{ $account_lists->links() }}


            </div>
        </div>
    </div>

@stop



