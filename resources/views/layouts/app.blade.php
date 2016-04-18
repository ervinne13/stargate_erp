<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

    @include('layouts.partials.htmlheader')
    @section('htmlheader')    
    @show

    <!--
    BODY TAG OPTIONS:
    =================
    Apply one or more of the following classes to get the
    desired effect
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-black                              |
    |               | skin-purple                             |
    |               | skin-yellow                             |
    |               | skin-red                                |
    |               | skin-green                              |
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
    -->
    <body class="{{env("APP_THEME_SKIN")}} sidebar-mini">
        <div class="wrapper">

            @include('layouts.partials.mainheader')

            @if (isset($sidebar))
            @include($sidebar)
            @else
            @include('layouts.partials.sidebar')
            @endif                       

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                @include('layouts.partials.contentheader')

                <!-- Main content -->
                <section class="content">
                    <!-- Your Page Content Here -->
                    @yield('main-content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            @include('layouts.partials.controlsidebar')

            @include('layouts.partials.footer')

        </div><!-- ./wrapper -->

        @include('layouts.partials.scripts')
        @section('scripts')        
        @show

    </body>
</html>
