
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
        <form id="{{$currentModule->M_Module_id}}-form" class="small-field-form row form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#profile-tab" data-toggle="tab">Profile</a></li>
                    <li><a href="#password-tab" data-toggle="tab">Change Password</a></li>                    
                </ul>
                <div class="tab-content">                    
                    <div class="tab-pane active" id="profile-tab">
                        <div class="row">
                            <div class="col-md-6">
                                {{SGForm::input("Username", "U_User_id", ["mode" => $mode, "tabIndex" => 1, "value" => $formData->U_User_id])}}
                                {{SGForm::input("Full Name", "U_Username", ["mode" => $mode, "tabIndex" => 2, "value" => $formData->U_Username])}}
                            </div>
                            <div class="col-md-6">
                                {{SGForm::select("Role", "U_FK_Position_id", $selectableRoles, [
                                    "optionValueField"   => "P_Position_id",
                                    "optionDisplayField" => "P_Position",
                                    "value"              => $formData->U_FK_Position_id,
                                    "mode"               => $mode,
                                    "tabIndex"           => 3
                                ])}}                                

                                {{SGForm::select("Location", "U_Location_id_list", $selectableLocations, [
                                    "optionValueField"   => "SP_StoreID",
                                    "optionDisplayField" => "SP_StoreName",
                                    "value"              => $formData->U_Location_id_list,
                                    "mode"               => $mode,
                                    "multiple"           => true,
                                    "tabIndex"           => 4
                                ])}}

                                {{SGForm::select("Default", "U_Default_location", $formData["U_Location_id_list"] ? explode(",", $formData["U_Location_id_list"]) : [], [
                                    "value"    => $formData->U_Default_location,
                                    "mode"     => $mode,
                                    "tabIndex" => 5
                                ])}}
                            </div>
                        </div>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="password-tab">
                        <div class="row">
                            <div class="col-md-6">
                                {{SGForm::input("Password", "U_Password", ["mode" => $mode, "tabIndex" => 6,  "type" => "password"])}}
                                {{SGForm::input("Repeat Password", "U_Password_repeat", ["mode" => $mode, "tabIndex" => 7, "type" => "password"])}}
                            </div>
                        </div>
                    </div><!-- /.tab-pane -->                    
                </div><!-- /.tab-content -->

                <div class="box-footer">
                    @include('partials.module.action_buttons')
                </div>

            </div><!-- nav-tabs-custom -->
        </form>

    </div>
</div>

@endsection
