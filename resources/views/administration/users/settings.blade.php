
@extends('layouts.app', ["sidebar" => "layouts.sidebars.administration"])

@section('htmlheader-title')
Administration
@endsection

@section('htmlheader')
<link rel="stylesheet" type="text/css" href="{{ asset('/plugins/datatables/dt-1.10.11/datatables.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('/plugins/jquery.treetable/jquery.treetable.css') }}"/>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/plugins/datatables/dt-1.10.11/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/underscore-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/jquery.treetable/jquery.treetable.js') }}"></script>

<!--Contains default current module and module header info-->
@include("partials.module_js_info")

<script type="text/javascript" src="{{ asset('/js/sg-datatable.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/administration/users/settings.js') }}"></script>
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{$user["U_Username"]}} <small>Settings</small></h3>

                <div class="box-tools pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bolt"></i> Functions
                        <span class="caret"></span>
                    </a>       
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#">
                                <i class="fa fa-save"></i> Save Settings
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <!--Actions-->
                <div>
                    <button id="action-expand-all" class="btn btn-link">
                        <i class="fa fa-plus"></i> Expand All
                    </button>
                    <button id="action-collapse-all" class="btn btn-link">
                        <i class="fa fa-minus"></i> Collapse All
                    </button>

                    <input id="checkbox-check-all" type="checkbox" /> Check All
                </div>

                <table class="table table-bordered" id="settings-table">
                    <thead>
                        <tr>
                            <th>Module</th>
                            <th>Access</th>
                            <th>Function</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script id="treetable_row_template" type="text/html">
    @include('templates.treetable_row')
</script>

@endsection
