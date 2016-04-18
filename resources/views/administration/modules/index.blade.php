<?php
$sidebar = "layouts.sidebars.administration";
?>

@extends('layouts.app')

@section('htmlheader-title')
Modules
@endsection

@section('htmlheader')
<link rel="stylesheet" type="text/css" href="{{ asset('/plugins/datatables/dt-1.10.11/datatables.min.css') }}"/>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/plugins/datatables/dt-1.10.11/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/underscore-min.js') }}"></script>

<script type="text/javascript" src="{{ asset('/js/sg-datatable.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/administration/modules/index.js') }}"></script>
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered" id="modules-table">
                    <thead>
                        <tr>
                            <th>Module ID</th>
                            <th>Description</th>
                            <th>Access</th>
                            <th>Functions</th>                            
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
