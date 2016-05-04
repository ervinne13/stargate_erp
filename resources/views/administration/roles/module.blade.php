
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
<script type="text/javascript" src="{{ asset('/js/administration/roles/form.js') }}"></script>
@endsection

@section('main-content')

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

                    <div class="col-md-6">
                        {{SGForm::input("Position", "P_Position", ["value" => $formData->P_Position, "mode" => $mode, "tabIndex" => 1])}}

                        {{SGForm::select("Position Type", "P_Type", $types, [
                            "value"              => $formData->P_Type,
                            "mode"               => $mode,
                            "tabIndex"           => 2
                        ])}}

                        {{SGForm::select("Parent", "P_Parent", $rolesOfCurrentType, [
                            "value"              => $formData->P_Parent,
                            "optionValueField"   => "P_Position_id",
                            "optionDisplayField" => "P_Position",
                            "mode"               => $mode,
                            "tabIndex"           => 3
                        ])}}
                    </div>
                </form>
            </div>

            <div class="box-footer">
                <?php $P_Position_id = $formData->P_Position_id ?>
                @include('partials.module.action_buttons', ["idField" => "P_Position_id"])
            </div>
        </div>
    </div>
</div>

<script id="role_parent_template" type="text/html">
    @include('templates.role_parent')
</script>


@endsection
