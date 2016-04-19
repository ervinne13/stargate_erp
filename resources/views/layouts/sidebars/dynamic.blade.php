<?php
$baseUrl = URL::to('');
if (!isset($currentModuleHeader)) {
    $currentModuleHeader = $viewData["currentModuleHeader"];
}
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">     

        @foreach($currentModuleHeader->moduleChildren AS $subHeaderModule)

        @if ($subHeaderModule->M_Header == 1)
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="{{$baseUrl . "/" . $subHeaderModule->M_Trigger}}">
                    <i class='{{$subHeaderModule->M_Icon}}'></i> 
                    <span>{{$subHeaderModule->M_Description}}</span> 
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    @foreach($subHeaderModule->moduleChildren AS $modules)
                    <li>
                        <a href="{{$baseUrl . "/" . $modules->M_Trigger}}">
                            <i class='{{$modules->M_Icon}}'></i> 
                            <span>{{$modules->M_Description}}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>
        @else
        <ul class="sidebar-menu">
            <li>
                <a href="{{$baseUrl . "/" . $subHeaderModule->M_Trigger}}">
                    <i class='{{$subHeaderModule->M_Icon}}'></i> 
                    <span>{{$subHeaderModule->M_Description}}</span>
                </a>
            </li>
        </ul>
        @endif


        @endforeach
        <!-- Sidebar Menu -->
        <!--        <ul class="sidebar-menu">
                    <li class="treeview">
                        <a href="#">
                            <i class='fa fa-group'></i> 
                            <span>User & Approval Setup</span> 
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
        
                        </ul>
                    </li>
                </ul>
                <ul class="sidebar-menu">
                    <li class="treeview">
                        <a href="#">
                            <i class='fa fa-gear'></i> 
                            <span>Application Setup</span> 
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">                                      
                        </ul>
                    </li>
                </ul>
                <ul class="sidebar-menu">
                    <li class="treeview">
                        <a href="#">
                            <i class='fa fa-file'></i> 
                            <span>Master Files</span> 
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">                    
                        </ul>
                    </li>
                </ul>-->
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
