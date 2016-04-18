<?php
$sidebar = "layouts.sidebars.administration";
?>

@extends('layouts.app')

@section('htmlheader')
<link rel="stylesheet" type="text/css" href="{{ asset('/plugins/datatables/dt-1.10.11/datatables.min.css') }}"/>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/plugins/datatables/dt-1.10.11/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/underscore-min.js') }}"></script>

<!--Contains default current module and module header info-->
@include("partials.module_js_info")

<script type="text/javascript" src="{{ asset('/js/sg-datatable.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/module-processor.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/administration/numberseries/form.js') }}"></script>
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Create Number Series</h3>                
            </div>
            <!-- /.box-header -->
            <div class="box-body">                
                @include('administration.numberseries.form', $formData)
            </div>

            <div class="box-footer">
                <div class="pull-right">
                    <button id="action-save-new" class="btn btn-success btn-flat">
                        <i class="fa fa-plus"></i> Save And New
                    </button>
                    <button id="action-save-close" class="btn btn-primary btn-flat">
                        <i class="fa fa-save"></i> Save And Close
                    </button>
                    <button id="action-close" class="btn btn-default btn-flat">
                        <i class="fa fa-close"></i> Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
