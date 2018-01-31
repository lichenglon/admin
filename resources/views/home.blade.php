@extends('layouts.default')


@section('content')

    <![endif]-->
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?4155d5c32d834c8bb2c4b5fe64542f66";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>

    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">



        <div class="row">
            <div class="col-sm-12">
                <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                       aria-describedby="example1_info">
                    <thead>
                    <tr role="row">
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            aria-label="Browser: activate to sort column ascending" style="width: 105px;">
                            @lang('account.user_name')
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            aria-label="Platform(s): activate to sort column ascending" style="width: 105px;">
                            @lang('account.nickname')
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                            @lang('account.email')
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                            @lang('account.Mobile_phone')
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                            @lang('account.Registration_time')
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                            @lang('account.Last_landing_time')
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                            @lang('account.The_final_landing_IP')
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            aria-label="CSS grade: activate to sort column ascending" style="width: 111px;">
                            @lang('account.state')
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                            <tr role="row">
                                <td><?php $status = session("user_info"); echo $status['username']?></td>
                                <td><?php $status = session("user_info"); echo $status['name']?></td>
                                <td><?php $status = session("user_info"); ?></td>
                                <td><?php $status = session("user_info"); echo $status['tel']?></td>
                                <td><?php $status = session("user_info"); echo date('Y-m-d H:i:s',$status['create_time'])?></td>
                                <td>{{Session::get('Last_landing_time')}}</td>
                                <td>{{$_SERVER["REMOTE_ADDR"]}}</td>
                                <td>@lang('account.normal')</td>
                            </tr>

                    </tbody>

                </table>
            </div>
        </div>
    </div>

@stop

@section('js')



    @stop



