<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">{!!env('APP_TITLE_SMALL_HTML')!!}</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">{!!env('APP_TITLE_HTML')!!}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if(isset($currentModuleHeader))              
                        <i class="{{$currentModuleHeader["M_Icon"]}}"></i> {{$currentModuleHeader["M_Description"]}}
                        <span class="caret"></span>
                        @else
                        <i class="fa fa-dashboard"></i> Dashboard
                        <span class="caret"></span>
                        @endif
                    </a>       
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li>
                            <a href="/dashboard">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </a>
                        </li>
                        @if (isset($moduleHeaders))
                        @foreach($moduleHeaders AS $moduleHeader)
                        <li {{$moduleHeader["M_Module_id"] == $currentModuleHeader["M_Module_id"] ? 'class="active"' : ""}}>
                            <a href="/{{$moduleHeader["M_Trigger"]}}">
                                <i class="{{$moduleHeader["M_Icon"]}}"></i> {{$moduleHeader["M_Description"]}}
                            </a>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </li

                <!-- Notifications Menu -->
                <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <!-- Inner Menu: contains the notifications -->
                            <ul class="menu">
                                <li><!-- start notification -->
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li><!-- end notification -->
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{URL::to('/logout')}}">
                        <i class="fa fa-sign-out"></i>
                        Logout
                    </a>
                </li>            
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>