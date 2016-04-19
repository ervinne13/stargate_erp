<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">     

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="#">
                    <i class='fa fa-group'></i> 
                    <span>User & Approval Setup</span> 
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active">
                        <a href="{{ url('administration/users') }}">
                            <i class='fa fa-user'></i> 
                            <span>Users</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{ url('administration/users') }}">
                            <i class='fa fa-group'></i> 
                            <span>Roles</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{ url('administration/users') }}">
                            <i class='fa fa-check'></i> 
                            <span>Approval Setup</span>
                        </a>
                    </li>
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
                    <li>
                        <ul class="sidebar-menu">
                            <li class="treeview">
                                <a href="#">
                                    <i class='fa fa-gear'></i> 
                                    <span>General</span> 
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <a href="{{ url('administration/modules') }}">
                                            <i class='fa fa-cubes'></i> 
                                            <span>Modules</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('administration/no-series') }}">
                                            <i class='fa fa-cube'></i> 
                                            <span>Number Series</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('administration') }}">
                                            <i class='fa fa-globe'></i> 
                                            <span>Region</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('administration') }}">
                                            <i class='fa fa-ship'></i> 
                                            <span>Area</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('administration') }}">
                                            <i class='fa fa-map-marker'></i> 
                                            <span>Location Level</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('administration') }}">
                                            <i class='fa fa-bullseye'></i> 
                                            <span>Purpose</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <ul class="sidebar-menu">
                            <li class="treeview">
                                <a href="#">
                                    <i class='fa fa-money'></i> 
                                    <span>Accounting</span> 
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <a href="{{ url('administration/customertype') }}">
                                            <i class='fa fa-cubes'></i> 
                                            <span>Customer Type</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('administration/currency') }}">
                                            <i class='fa fa-dollar'></i> 
                                            <span>Currency</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('administration/fixedasset') }}">
                                            <i class='fa fa-building'></i> 
                                            <span>Fixed Asset Class</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('administration') }}">
                                            <i class='fa fa-money'></i> 
                                            <span>Cost/Profit Class</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('administration') }}">
                                            <i class='fa fa-fax'></i> 
                                            <span>Machine Type</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('administration') }}">
                                            <i class='fa fa-user'></i> 
                                            <span>Supplier Type</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('administration') }}">
                                            <i class='fa fa-money'></i> 
                                            <span>Payment Terms</span>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a href="{{ url('administration') }}">
                                            <i class='fa fa-money'></i> 
                                            <span>Tax</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>                     
                    </li>
                    <li>
                        <a href="{{ url('administration/exchangerate') }}">
                            <i class='fa fa-exchange'></i> 
                            <span>Exchange Rate</span>
                        </a>
                    </li>
                    <li>
                        <ul class="sidebar-menu">
                            <li class="treeview">
                                <a href="#">
                                    <i class='fa fa-dropbox'></i> 
                                    <span>Inventory</span> 
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <a href="{{ url('administration/customertype') }}">
                                            <i class='fa fa-balance-scale'></i> 
                                            <span>Unit of Measurement</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('administration/currency') }}">
                                            <i class='fa fa-map-marker'></i> 
                                            <span>Location Type</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('administration/fixedasset') }}">
                                            <i class='fa fa-dropbox'></i> 
                                            <span>Item Type</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('administration') }}">
                                            <i class='fa fa-question'></i> 
                                            <span>Category</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('administration') }}">
                                            <i class='fa fa-group'></i> 
                                            <span>Buyer Setup</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('administration') }}">
                                            <i class='fa fa-question'></i> 
                                            <span>Sub Category</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('administration') }}">
                                            <i class='fa fa-search'></i> 
                                            <span>Identifier Setup</span>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a href="{{ url('administration') }}">
                                            <i class='fa fa-sitemap'></i> 
                                            <span>Concerned Department</span>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a href="{{ url('administration') }}">
                                            <i class='fa fa-search'></i> 
                                            <span>Identifier</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>                     
                    </li>                    
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
                    <li>
                        <a href="{{ url('administration/company') }}">
                            <i class='fa fa-sitemap'></i> 
                            <span>Company</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('administration/cpc') }}">
                            <i class='fa fa-money'></i> 
                            <span>Cost/Profit Center</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('administration/locationstructure') }}">
                            <i class='fa fa-globe'></i> 
                            <span>Location Structure</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('administration') }}">
                            <i class='fa fa-dropbox'></i> 
                            <span>Item Master</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('administration') }}">
                            <i class='fa fa-user'></i> 
                            <span>Customer</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('administration') }}">
                            <i class='fa fa-user'></i> 
                            <span>Supplier</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('administration') }}">
                            <i class='fa fa-building'></i> 
                            <span>Store/Department Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('administration') }}">
                            <i class='fa fa-user'></i> 
                            <span>Services</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>        
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
