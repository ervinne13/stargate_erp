
<!--<style>
    /*.row .col-xs-2, .row .col-xs-10{display:inline-block; float: none}*/
</style>-->

<?php
$mode = 'edit';

//  initialize select fields
$rolesSelect = [
    "label"              => "Role",
    "field"              => "U_FK_Position_id",
    "optionValueField"   => "P_Position_id",
    "optionDisplayField" => "P_Position",
    "options"            => $roles,
    "mode"               => 'edit',
    "tabIndex"           => 5
];

$locationsSelect = [
    "label"              => "Location",
    "field"              => "U_Location_id_list",
    "optionValueField"   => "SP_StoreID",
    "optionDisplayField" => "SP_StoreName",
    "options"            => $locations,
    "mode"               => 'edit',
    "multiple"           => true,
    "tabIndex"           => 6
];

$defaultLocationSelect = [
    "label"    => "Default Location",
    "field"    => "U_Default_location",
    "options"  => [],
    "mode"     => 'edit',
    "tabIndex" => 7
];
?>

@extends('layouts.app', ["sidebar" => "layouts.sidebars.administration"])

@section('htmlheader-title')
Administration
@endsection

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
<script type="text/javascript" src="{{ asset('/js/module-list-processor.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/test/inline_form_tables.js') }}"></script>
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>

                <div class="box-tools pull-right">
                    @include('partials.module.functions')
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered" id="users-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                @include('partials.access_inline', ["accessList" => $headerAccess])
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

<!--<div id="user_form_template">-->
<script id="user_form_template" type="text/html">
    <tr id="inline_form_<%= id %>" role="form">
        <td colspan="7">
            <!--<div class="container-fluid">-->            
            <div class="row">
                <div class="form-horizontal">
                    <div class="col-md-6">
                        {{SGForm::input("Username", "U_User_id", ["mode" => $mode, "tabIndex"=> 1])}}
                        {{SGForm::input("Full Name", "U_Username", ["mode" => $mode, "tabIndex"=> 2])}}
                    </div>
                    <div class="col-md-6">
                        {{SGForm::input("Username", "U_User_id", ["mode" => $mode, "tabIndex"=> 1])}}
                        {{SGForm::input("Full Name", "U_Username", ["mode" => $mode, "tabIndex"=> 2])}}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="pull-right">
                    <button id="inline-form-action-save" type="button" class="btn btn-success btn-flat">
                        <i class="fa fa-check"></i> Save
                    </button>
                    <button id="inline-form-action-save-and-next" type="button" class="btn btn-primary btn-flat">
                        <i class="fa fa-save"></i> Save & Next
                    </button>
                    <button id="inline-form-action-close" type="button" class="btn btn-default btn-flat">
                        <i class="fa fa-close"></i> Discard & Close
                    </button>
                </div>
            </div>            
            <!--</div>-->
        </td>
    </tr>
</script>
<!--</div>-->

@endsection
