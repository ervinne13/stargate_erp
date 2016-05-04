
@extends('layouts.app', ["sidebar" => "layouts.sidebars.administration"])

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
<script type="text/javascript" src="{{ asset('/js/administration/attributes/form.js') }}"></script>
@endsection

@section('main-content')
<?php extract($formData->toArray()) ?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">New @yield('contentheader-description', isset($currentModule) ? $currentModule["M_Description"] : "")</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">                
                <form id="{{$currentModule->M_Module_id}}-form" class="small-field-form row form-horizontal">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="AD_FK_Code" value="{{ $AD_FK_Code }}">

                    <div class="col-md-6">                        
                        @include("partials.elements.input", ["label" => "Code", "field" => "AD_Code", "tabIndex" => 1, "mode" => $mode])
                        @include("partials.elements.input", ["label" => "Description", "field" => "AD_Desc", "tabIndex" => 2, "mode" => $mode])
                    </div>
                </form>
            </div>

            <div class="box-footer">
                @include('partials.module.action_buttons', ["idField" => "AD_Code"])
            </div>
        </div>
    </div>
</div>

@endsection
