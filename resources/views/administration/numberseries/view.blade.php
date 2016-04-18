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
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Number Series</h3> {{$formData["NS_Id"]}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">                
                @include('administration.numberseries.form', $formData)
            </div>
        </div>
    </div>
</div>

@endsection
