
@extends('layouts.app', ["sidebar" => "layouts.sidebars.administration"])

@section('htmlheader')
<meta name="locations" content="{{$selectableLocations}}">
<link rel="stylesheet" type="text/css" href="{{ asset('/plugins/datatables/dt-1.10.11/datatables.min.css') }}"/>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/plugins/datatables/dt-1.10.11/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/underscore-min.js') }}"></script>

<!--Contains default current module and module header info-->
@include("partials.module_js_info")

<script type="text/javascript" src="{{ asset('/js/sg-datatable.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/module-processor.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/administration/users/form.js') }}"></script>
@endsection

@section('main-content')
<?php extract($formData->toArray()) ?>
<div class="row">
    <div class="col-md-12">     
        <div class="box">            
            <div class="box-header with-border">
                <h3 class="box-title">New User</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form id="{{$currentModule->M_Module_id}}-form" class="small-field-form row form-horizontal">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                    

                    <div class="col-md-6">
                        {{SGForm::input("Username", "U_User_id", ["mode" => $mode, "tabIndex" => 1])}}
                        {{SGForm::input("Password", "U_Password", ["mode" => $mode, "tabIndex" => 2,  "type" => "password"])}}
                        {{SGForm::input("Repeat Password", "U_Password_repeat", ["mode" => $mode, "tabIndex" => 3, "type" => "password"])}}
                        {{SGForm::input("Full Name", "U_Username", ["mode" => $mode, "tabIndex" => 4])}}
                    </div>
                    <div class="col-md-6">
                        {{SGForm::select("Role", "U_FK_Position_id", $selectableRoles, [
                            "optionValueField"   => "P_Position_id",
                            "optionDisplayField" => "P_Position",
                            "mode"               => $mode,
                            "tabIndex"           => 5
                        ])}}

                        {{SGForm::select("Location", "U_Location_id_list", $selectableLocations, [
                            "optionValueField"   => "SP_StoreID",
                            "optionDisplayField" => "SP_StoreName",                            
                            "mode"               => $mode,
                            "multiple"           => true,
                            "tabIndex"           => 6
                        ])}}

                        {{SGForm::select("Default", "U_Default_location", $formData["U_Location_id_list"] ? explode(",", $formData["U_Location_id_list"]) : [], [
                            "mode"     => $mode,
                            "tabIndex" => 7
                        ])}}
                    </div>
                </form>
            </div>

            <div class="box-footer">
                @include('partials.module.action_buttons')
            </div>
        </div>
    </div>
</div>

@endsection
