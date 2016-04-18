<?php
$sidebar = "layouts.sidebars.administration";
?>

@extends('layouts.app')

@section('htmlheader-title')
Administration
@endsection

@section('breadcrumb-html')
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('htmlheader')
<link rel="stylesheet" type="text/css" href="{{ asset('/plugins/datatables/dt-1.10.11/datatables.min.css') }}"/>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/plugins/datatables/dt-1.10.11/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/underscore-min.js') }}"></script>

<script type="text/javascript" src="{{ asset('/js/sg-datatable.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/administration/users/index.js') }}"></script>
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>

                <div class="box-tools pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bolt"></i> Functions
                        <span class="caret"></span>
                    </a>       
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#">
                                <i class="fa fa-check"></i> Set Active
                            </a>
                        </li>
                        <li>
                            <a href="/administration">
                                <i class="fa fa-remove"></i> Set Inactive
                            </a>
                        </li>                       
                    </ul>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered" id="users-table">
                    <thead>
                        <tr>
                            <th>
                                @include('partials.access_inline', $headerAccess)
                            </th>
                            <th>
                                <input type="checkbox" class="toggle-check">
                            </th>
                            <th>User Id</th>
                            <th>Username</th>
                            <th>Position</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script id="access_inline_template" type="text/html">
    @include('templates.access_inline')
</script>

<script id="checkbox_inline_template" type="text/html">
    @include('templates.checkbox_inline')
</script>

@endsection
