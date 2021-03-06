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
                        <a href="{{ url('administration/position') }}">
                            <i class='fa fa-group'></i> 
                            <span>Roles</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{ url('administration/approval-setup') }}">
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
                                <a href="{{ url('administration/attributes/260') }}">
                                    <i class='fa fa-globe'></i> 
                                    <span>Region</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('administration/attributes/261') }}">
                                    <i class='fa fa-ship'></i> 
                                    <span>Area</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('administration/reason') }}">
                                    <i class='fa fa-bullseye'></i> 
                                    <span>Purpose</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class='fa fa-money'></i> 
                            <span>Accounting</span> 
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ url('administration/customer-type') }}">
                                    <i class='fa fa-cubes'></i> 
                                    <span>Customer Type</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('administration/attributes/34') }}">
                                    <i class='fa fa-dollar'></i> 
                                    <span>Currency</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('administration/attributes/146') }}">
                                    <i class='fa fa-building'></i> 
                                    <span>Fixed Asset Class</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('administration/attributes/152') }}">
                                    <i class='fa fa-money'></i> 
                                    <span>Cost/Profit Class</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('administration/attributes/149') }}">
                                    <i class='fa fa-fax'></i> 
                                    <span>Machine Type</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('administration/attributes/156') }}">
                                    <i class='fa fa-user'></i> 
                                    <span>Supplier Type</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('administration/payment-terms') }}">
                                    <i class='fa fa-money'></i> 
                                    <span>Payment Terms</span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="{{ url('administration/tax') }}">
                                    <i class='fa fa-money'></i> 
                                    <span>Tax</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('administration/exchange-rate') }}">
                            <i class='fa fa-exchange'></i> 
                            <span>Exchange Rate</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class='fa fa-dropbox'></i> 
                            <span>Inventory</span> 
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ url('administration/attributes/33') }}">
                                    <i class='fa fa-balance-scale'></i> 
                                    <span>Unit of Measurement</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('administration/attributes/144') }}">
                                    <i class='fa fa-map-marker'></i> 
                                    <span>Location Type</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('administration/item-type') }}">
                                    <i class='fa fa-dropbox'></i> 
                                    <span>Item Type</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('administration/category') }}">
                                    <i class='fa fa-question'></i> 
                                    <span>Category</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('administration/buyer-setup') }}">
                                    <i class='fa fa-group'></i> 
                                    <span>Buyer Setup</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('administration/sub-category') }}">
                                    <i class='fa fa-question'></i> 
                                    <span>Sub Category</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('administration/identifier-setup') }}">
                                    <i class='fa fa-search'></i> 
                                    <span>Identifier Setup</span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="{{ url('administration/department-setup') }}">
                                    <i class='fa fa-sitemap'></i> 
                                    <span>Concerned Department</span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="{{ url('administration/identifier') }}">
                                    <i class='fa fa-search'></i> 
                                    <span>Identifier</span>
                                </a>
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
                        <a href="{{ url('administration/cost-profit-center') }}">
                            <i class='fa fa-money'></i> 
                            <span>Cost/Profit Center</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('administration/location') }}">
                            <i class='fa fa-globe'></i> 
                            <span>Location Structure</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('administration/item-master') }}">
                            <i class='fa fa-dropbox'></i> 
                            <span>Item Master</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('administration/customer') }}">
                            <i class='fa fa-user'></i> 
                            <span>Customer</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('administration/supplier') }}">
                            <i class='fa fa-user'></i> 
                            <span>Supplier</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('administration/store-profile') }}">
                            <i class='fa fa-building'></i> 
                            <span>Store/Department Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('administration/services') }}">
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
