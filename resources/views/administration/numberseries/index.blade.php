<?php
$sidebar = "layouts.sidebars.administration";
?>

@extends('layouts.app')

@section('htmlheader')
<link rel="stylesheet" type="text/css" href="{{ asset('/plugins/datatables/dt-1.10.11/datatables.min.css') }}"/>

<meta name="_token" content="{{ csrf_token() }}">

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/plugins/datatables/dt-1.10.11/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/underscore-min.js') }}"></script>

<!--Contains default current module and module header info-->
@include("partials.module_js_info")

<script type="text/javascript" src="{{ asset('/js/sg-datatable.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/module-list-processor.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/administration/numberseries/index.js') }}"></script>

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
                <table class="table table-bordered" id="number-series-table">
                    <thead>
                        <tr>
                            <th style="min-width: 35px;">
                                @include('partials.access_inline', $headerAccess)
                            </th>
                            <th>No. Series ID</th>
                            <th>Description</th>
                            <th>Module</th>
                            <th>Location</th>                            
                            <th>Starting No.</th>                            
                            <th>Ending No.</th>                            
                            <th>Last No. Used</th>                            
                            <th>Last Date Used</th>
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

@endsection
