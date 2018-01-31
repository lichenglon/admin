

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>@if(isset($__user_info__)) {{ $__user_info__['name'] }} @endif</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        {{--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form>--}}
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">@lang('layouts_aside.The_main_navigation')</li>


            @foreach($__menu_lists__ as $values)

                @if(!empty($values['sub']))

                    <li class="treeview">
                        <a href="{{ $values['url'] }}"><i class="fa {{ $values['icon'] }}"></i> <span>@if(Session::get('lang') == 'en') {{$values['en_name']}} @else {{$values['name']}} @endif</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                        </a>
                        <ul class="treeview-menu">
                            @foreach($values['sub'] as $child_values)
                                <li class="li_diy_menu"><a href="{{url($child_values['url'])}}"><i class="fa fa-circle-o"></i>@if(Session::get('lang') == 'en'){{ $child_values['en_name'] }} @else {{$child_values['name']}} @endif</a></li>
                            @endforeach

                        </ul>
                    </li>

                @else

                    <li class="li_diy_menu"><a href="{{ $values['url'] }}"><i class="fa {{ $values['icon'] }}"></i> <span>@if(Session::get('lang') == 'en'){{ $values['en_name'] }}@else {{$values['name']}} @endif</span></a></li>

                @endif



            @endforeach





        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>