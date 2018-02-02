
<!DOCTYPE html>
    <!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
    -->
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>管理平台</title>
        {{--<link rel="shortcut icon" href="favicon.ico">--}}
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        {{--    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">--}}

        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect. -->
        <link rel="stylesheet" href="{{ asset('dist/css/skins/skin-blue.min.css') }}">
        <link rel="stylesheet" href="{{ asset('static/layer/skin/layer.css') }}">


        <!-- Main Styles -->
        <link rel="stylesheet" href="{{ asset('home_style') }}/css/style.min.css">

        <!-- Waves Effect -->
        <link rel="stylesheet" href="{{ asset('home_style') }}/css/waves.min.css">

        <!-- Sweet Alert -->
        <link rel="stylesheet" href="{{ asset('home_style') }}/css/sweetalert.css">

        <!-- Percent Circle -->
        <link rel="stylesheet" href="{{ asset('home_style') }}/css/percircle.css">

        <!-- Chartist Chart -->
        <link rel="stylesheet" href="{{ asset('home_style') }}/css/chartist.min.css">

        <!-- FullCalendar -->
        <link rel="stylesheet" href="{{ asset('home_style') }}/css/fullcalendar.min.css">
        <link rel="stylesheet" href="{{ asset('home_style') }}/css/fullcalendar.print.css" media='print'>

        <!-- Color Picker -->
        <link rel="stylesheet" href="{{ asset('home_style') }}/css/color-switcher.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


        <!-- Google Font -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
            .main-sidebar { padding:0;}
        </style>
    </head>

    @include('layouts._header')

    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        @include('layouts._aside')

                <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @if(Session::get('lang') == 'en'){{ $__current_menu__->en_name or '' }}@else{{ $__current_menu__->name or '' }}@endif
                    <small>Huashi Hengtong</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>@if(Session::get('lang') == 'en'){{ $__parent_menu__->en_name or '' }}@else{{ $__parent_menu__->name or '' }}@endif</a></li>
                    <li class="active">@if(Session::get('lang') == 'en'){{ $__current_menu__->en_name or '' }}@else{{ $__current_menu__->name or '' }}@endif</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content container-fluid">

                <!--------------------------
                  | Your Page Content Here |
                  -------------------------->
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                                    <div class="row small-spacing">

                                        <!-- /.col-xs-12 -->
                                        <div class="col-lg-3 col-md-6 col-xs-12">
                                            <div class="box-content">
                                                <h4 class="box-title">@lang('home.Projects')</h4>
                                                <!-- /.box-title -->
                                                <div class="dropdown js__drop_down">
                                                    <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                                                    <ul class="sub-menu">
                                                        <li><a href="#">@lang('home.Action')</a></li>
                                                        <li><a href="#">@lang('home.Another_action')</a></li>
                                                        <li><a href="#">@lang('home.Something_else_there')</a></li>
                                                        <li class="split"></li>
                                                        <li><a href="#">@lang('home.Separated_link')</a></li>
                                                    </ul>
                                                    <!-- /.sub-menu -->
                                                </div>
                                                <!-- /.dropdown js__dropdown -->
                                                <div class="content widget-stat">
                                                    <div class="percent bg-warning"><i class="fa fa-line-chart"></i>53%</div>
                                                    <!-- /.percent -->
                                                    <div class="right-content">
                                                        <h2 class="counter">837</h2>
                                                        <!-- /.counter -->
                                                        <p class="text">@lang('home.Projects')</p>
                                                        <!-- /.text -->
                                                    </div>
                                                    <!-- /.right-content -->
                                                    <div class="clear"></div>
                                                    <!-- /.clear -->
                                                    <div class="process-bar">
                                                        <div class="bar-bg bg-warning"></div>
                                                        <div class="bar js__width bg-warning" data-width="70%"></div>
                                                        <!-- /.bar js__width bg-success -->
                                                    </div>
                                                    <!-- /.process-bar -->
                                                </div>
                                                <!-- /.content widget-stat -->
                                            </div>
                                            <!-- /.box-content -->
                                        </div>

                                        <!-- /.col-lg-3 col-md-6 col-xs-12 -->
                                        <div class="col-lg-3 col-md-6 col-xs-12">
                                            <div class="box-content">
                                                <h4 class="box-title">@lang('home.Memory_usage')</h4>
                                                <!-- /.box-title -->
                                                <div class="dropdown js__drop_down">
                                                    <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                                                    <ul class="sub-menu">
                                                        <li><a href="#">@lang('home.Action')</a></li>
                                                        <li><a href="#">@lang('home.Another_action')</a></li>
                                                        <li><a href="#">@lang('home.Something_else_there')</a></li>
                                                        <li class="split"></li>
                                                        <li><a href="#">@lang('home.Separated_link')</a></li>
                                                    </ul>
                                                    <!-- /.sub-menu -->
                                                </div>
                                                <!-- /.dropdown js__dropdown -->
                                                <div class="content widget-stat-chart">
                                                    <div class="c100 p76 small blue js__circle">
                                                        <span>76%</span>
                                                        <div class="slice">
                                                            <div class="bar"></div>
                                                            <div class="fill"></div>
                                                        </div>
                                                    </div>
                                                    <!-- /.c100 p58 -->
                                                    <div class="right-content">
                                                        <h2 class="counter">804</h2>
                                                        <!-- /.counter -->
                                                        <p class="text">@lang('home.Disk_usage')</p>
                                                        <!-- /.text -->
                                                    </div>
                                                    <!-- /.right-content -->
                                                </div>
                                                <!-- /.content -->
                                            </div>
                                            <!-- /.box-content -->
                                        </div>
                                        <!-- /.col-lg-3 col-md-6 col-xs-12 -->
                                        <div class="col-lg-3 col-md-6 col-xs-12">
                                            <div class="box-content">
                                                <h4 class="box-title">@lang('home.Visitor_Analytics')</h4>
                                                <!-- /.box-title -->
                                                <div class="dropdown js__drop_down">
                                                    <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                                                    <ul class="sub-menu">
                                                        <li><a href="#">@lang('home.Action')</a></li>
                                                        <li><a href="#">@lang('home.Another_action')</a></li>
                                                        <li><a href="#">@lang('home.Something_else_there')</a></li>
                                                        <li class="split"></li>
                                                        <li><a href="#">@lang('home.Separated_link')</a></li>
                                                    </ul>
                                                    <!-- /.sub-menu -->
                                                </div>
                                                <!-- /.dropdown js__dropdown -->
                                                <div class="content widget-stat">
                                                    <div class="percent bg-danger"><i class="fa fa-line-chart"></i>+40%</div>
                                                    <!-- /.percent -->
                                                    <div class="right-content">
                                                        <h2 class="counter">976</h2>
                                                        <!-- /.counter -->
                                                        <p class="text">@lang('home.Visitors_today')</p>
                                                        <!-- /.text -->
                                                    </div>
                                                    <!-- /.right-content -->
                                                    <div class="clear"></div>
                                                    <!-- /.clear -->
                                                    <div class="process-bar">
                                                        <div class="bar-bg bg-danger"></div>
                                                        <div class="bar js__width bg-danger" data-width="70%"></div>
                                                        <!-- /.bar js__width bg-success -->
                                                    </div>
                                                    <!-- /.process-bar -->
                                                </div>
                                                <!-- /.content widget-stat -->
                                            </div>
                                            <!-- /.box-content -->
                                        </div>
                                        <!-- /.col-lg-3 col-md-6 col-xs-12 -->
                                        <div class="col-lg-3 col-md-6 col-xs-12">
                                            <div class="box-content">
                                                <h4 class="box-title">@lang('home.Monthly_Sales')</h4>
                                                <!-- /.box-title -->
                                                <div class="dropdown js__drop_down">
                                                    <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                                                    <ul class="sub-menu">
                                                        <li><a href="#">@lang('home.Action')</a></li>
                                                        <li><a href="#">@lang('home.Another_action')</a></li>
                                                        <li><a href="#">@lang('home.Something_else_there')</a></li>
                                                        <li class="split"></li>
                                                        <li><a href="#">@lang('home.Separated_link')</a></li>
                                                    </ul>
                                                    <!-- /.sub-menu -->
                                                </div>
                                                <!-- /.dropdown js__dropdown -->
                                                <div class="content widget-stat-chart">
                                                    <div class="c100 p94 small green js__circle">
                                                        <span>94%</span>
                                                        <div class="slice">
                                                            <div class="bar"></div>
                                                            <div class="fill"></div>
                                                        </div>
                                                    </div>
                                                    <!-- /.c100 p58 -->
                                                    <div class="right-content">
                                                        <h2 class="counter">3922</h2>
                                                        <!-- /.counter -->
                                                        <p class="text">@lang('home.Sales')</p>
                                                        <!-- /.text -->
                                                    </div>
                                                    <!-- /.right-content -->
                                                </div>
                                                <!-- /.content -->
                                            </div>
                                            <!-- /.box-content -->
                                        </div>


                                        <div class="col-xs-12">
                                            <div class="box-content" style="width:100%;">
                                                <h4 class="box-title">@lang('home.Activity')</h4>
                                                <!-- /.box-title -->
                                                <div class="dropdown js__drop_down">
                                                    <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                                                    <ul class="sub-menu">
                                                        <li><a href="#">@lang('home.Action')</a></li>
                                                        <li><a href="#">@lang('home.Another_action')</a></li>
                                                        <li><a href="#">@lang('home.Something_else_there')</a></li>
                                                        <li class="split"></li>
                                                        <li><a href="#">@lang('home.Separated_link')</a></li>
                                                    </ul>
                                                    <!-- /.sub-menu -->
                                                </div>
                                                <!-- /.dropdown js__dropdown -->
                                                <div id="smil-animation-index-chartist-chart" class="chartist-chart" style="height: 320px"></div>
                                                <!-- /#smil-animation-chartist-chart.chartist-chart -->
                                            </div>
                                            <!-- /.box-content -->
                                        </div>
                                        <!-- /.col-lg-3 col-md-6 col-xs-12 -->

                                        <div class="col-lg-4 col-xs-12">
                                            <div class="box-content">
                                                <h4 class="box-title">@lang('home.Statistics')</h4>
                                                <!-- /.box-title -->
                                                <div class="dropdown js__drop_down">
                                                    <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                                                    <ul class="sub-menu">
                                                        <li><a href="#">@lang('home.Action')</a></li>
                                                        <li><a href="#">@lang('home.Another_action')</a></li>
                                                        <li><a href="#">@lang('home.Something_else_there')</a></li>
                                                        <li class="split"></li>
                                                        <li><a href="#">@lang('home.Separated_link')</a></li>
                                                    </ul>
                                                    <!-- /.sub-menu -->
                                                </div>
                                                <!-- /.dropdown js__dropdown -->
                                                <div class="content">
                                                    <div id="chart-2" class="js__chart" data-type="column" data-chart="'Year'/'Statistics' | '2010'/75 | '2011'/42 | '2012'/75 | '2013'/38 | '2014'/19 | '2015'/93 "></div>
                                                </div>
                                                <!-- /.content -->
                                            </div>
                                            <!-- /.box-content -->
                                        </div>
                                        <!-- /.col-lg-4 col-md-12 -->

                                        <div class="col-lg-4 col-xs-12">
                                            <div class="box-content">
                                                <h4 class="box-title">@lang('home.Total_Projects')</h4>
                                                <!-- /.box-title -->
                                                <div class="dropdown js__drop_down">
                                                    <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                                                    <ul class="sub-menu">
                                                        <li><a href="#">@lang('home.Action')</a></li>
                                                        <li><a href="#">@lang('home.Another_action')</a></li>
                                                        <li><a href="#">@lang('home.Something_else_there')</a></li>
                                                        <li class="split"></li>
                                                        <li><a href="#">@lang('home.Separated_link')</a></li>
                                                    </ul>
                                                    <!-- /.sub-menu -->
                                                </div>
                                                <!-- /.dropdown js__dropdown -->
                                                <div class="content">
                                                    <div id="chart-3" class="js__chart" data-type="curve" data-chart="'Year'/'Desktop'/'Mobile' | '2008'/53/0 | '2009'/35/73 | '2010'/89/14 | '2011'/50/50 | '2012'/86/37 | '2013'/47/89 | '2014'/75/50 | '2015'/100/70 "></div>
                                                </div>
                                                <!-- /.content -->
                                            </div>
                                            <!-- /.box-content -->
                                        </div>
                                        <!-- /.col-lg-4 col-md-12 -->

                                        <div class="col-lg-4 col-xs-12">
                                            <div class="box-content">
                                                <h4 class="box-title">@lang('home.Daily_Sales')</h4>
                                                <!-- /.box-title -->
                                                <div class="dropdown js__drop_down">
                                                    <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                                                    <ul class="sub-menu">
                                                        <li><a href="#">@lang('home.Action')</a></li>
                                                        <li><a href="#">@lang('home.Another_action')</a></li>
                                                        <li><a href="#">@lang('home.Something_else_there')</a></li>
                                                        <li class="split"></li>
                                                        <li><a href="#">@lang('home.Separated_link')</a></li>
                                                    </ul>
                                                    <!-- /.sub-menu -->
                                                </div>
                                                <!-- /.dropdown js__dropdown -->
                                                <div class="content">
                                                    <div id="chart-1" class="js__chart" data-type="donut" data-chart="'Type'/'Number' | 'Normal Sales'/50 | 'In-Site Sales'/20 | 'Mail-Order Sales'/20"></div>
                                                </div>
                                                <!-- /.content -->
                                            </div>
                                            <!-- /.box-content -->
                                        </div>
                                        <!-- /.col-lg-4 col-xs-12 -->


                                        <!-- /.col-lg-3 col-md-6 col-xs-12 -->
                                        <div class="col-lg-6 col-xs-12">
                                            <div class="box-content">
                                                <div id="calendar-widget"></div>
                                            </div>
                                            <!-- /.box-content -->
                                        </div>
                                        <!-- /.col-lg-6 col-xs-12 -->
                                        <div class="col-lg-6 col-xs-12">
                                            <div class="box-content">
                                                <h4 class="box-title">@lang('home.Purchases')</h4>
                                                <!-- /.box-title -->
                                                <div class="dropdown js__drop_down">
                                                    <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                                                    <ul class="sub-menu">
                                                        <li><a href="#">@lang('home.Action')</a></li>
                                                        <li><a href="#">@lang('home.Another_action')</a></li>
                                                        <li><a href="#">@lang('home.Something_else_there')</a></li>
                                                        <li class="split"></li>
                                                        <li><a href="#">@lang('home.Separated_link')</a></li>
                                                    </ul>
                                                    <!-- /.sub-menu -->
                                                </div>
                                                <!-- /.dropdown js__dropdown -->
                                                <div class="table-responsive table-purchases">
                                                    <table class="table table-striped margin-bottom-10">
                                                        <thead>
                                                        <tr>
                                                            <th style="width:40%;">@lang('home.Projects')</th>
                                                            <th>@lang('home.Price')</th>
                                                            <th>>@lang('home.Date')</th>
                                                            <th>>@lang('home.State')</th>
                                                            <th style="width:5%;"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>Amaza Themes</td>
                                                            <td>$71</td>
                                                            <td>Nov 12,2016</td>
                                                            <td class="text-success">Completed</td>
                                                            <td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Macbook</td>
                                                            <td>$142</td>
                                                            <td>Nov 10,2016</td>
                                                            <td class="text-danger">Cancelled</td>
                                                            <td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Samsung TV</td>
                                                            <td>$200</td>
                                                            <td>Nov 01,2016</td>
                                                            <td class="text-warning">Pending</td>
                                                            <td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Ninja Admin</td>
                                                            <td>$200</td>
                                                            <td>Oct 28,2016</td>
                                                            <td class="text-warning">Pending</td>
                                                            <td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Galaxy Note 5</td>
                                                            <td>$200</td>
                                                            <td>Oct 28,2016</td>
                                                            <td class="text-success">Completed</td>
                                                            <td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>CleanUp Themes</td>
                                                            <td>$71</td>
                                                            <td>Oct 22,2016</td>
                                                            <td class="text-success">Completed</td>
                                                            <td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Facebook WP Plugin</td>
                                                            <td>$10</td>
                                                            <td>Oct 15,2016</td>
                                                            <td class="text-success">Completed</td>
                                                            <td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Iphone 7</td>
                                                            <td>$100</td>
                                                            <td>Oct 12,2016</td>
                                                            <td class="text-warning">Pending</td>
                                                            <td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nova House</td>
                                                            <td>$100</td>
                                                            <td>Oct 12,2016</td>
                                                            <td class="text-warning">Pending</td>
                                                            <td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Repair Cars</td>
                                                            <td>$35</td>
                                                            <td>Oct 12,2016</td>
                                                            <td class="text-warning">Pending</td>
                                                            <td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- /.table -->
                                                </div>
                                                <!-- /.table-responsive -->
                                            </div>
                                            <!-- /.box-content -->
                                        </div>
                                        <!-- /.col-lg-6 col-xs-12 -->
                                    </div>
                                    <!-- /.row -->
                                    <footer class="footer">
                                        <ul class="list-inline">
                                            <li>2016 © NinjaAdmin.</li>
                                            <li><a href="#">Privacy</a></li>
                                            <li><a href="#">Terms</a></li>
                                            <li><a href="#">Help</a></li>
                                        </ul>
                                    </footer>
                                <!-- /.main-content -->



                </div>




            </section>
            <!-- /.content -->


        </div>
        <!-- /.content-wrapper -->


        @include('layouts._footer')

    </div>



    <!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 3 -->
    <script type="text/javascript" src="{{asset('house/laydate/laydate.js')}}"></script>
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    {{--<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>--}}

    <script src="{{ asset('static/ajaxForm.js') }}"></script>
    <script src="{{ asset('static/layer/dialog.js') }}"></script>
    <script src="{{ asset('static/layer/layer.js') }}"></script>
    <script src="{{ asset('static/common.js') }}"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <!--
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('home_style') }}/js/nprogress.js"></script>
    <!-- Google Chart -->
    <script type="text/javascript" src="{{ asset('home_style') }}/js/loader.js"></script>

    <!-- Chartist Chart -->
    <script src="{{ asset('home_style') }}/js/chartist.min.js"></script>
    <script src="{{ asset('home_style') }}/js/chart.chartist.init.min.js"></script>

    <!-- FullCalendar -->
    <script src="{{ asset('home_style') }}/js/moment.js"></script>
    <script src="{{ asset('home_style') }}/js/fullcalendar.min.js"></script>
    <script src="{{ asset('home_style') }}/js/fullcalendar.init.js"></script>

    <script src="{{ asset('home_style') }}/js/main.min.js"></script>
    <script src="{{ asset('home_style') }}/js/color-switcher.min.js"></script>

    </body>
    </html>

