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

@section('contentheader-title')
Administration
@endsection

@section('contentheader-description')
Users
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
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered" id="users-table">
                    <thead>
                        <tr>
                            <th>
                                <a href="#">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </th>
                            <th>User Id</th>
                            <th>Username</th>
                            <th>Position</th>                            
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script id="actions_template" type="text/html">
    <div>
        <a href="/administration/users/<%= id %>">
            <i class="fa fa-pencil"></i>
        </a>
    </div>
</script>
@endsection
