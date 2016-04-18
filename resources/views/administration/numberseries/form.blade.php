
<?php
if (!isset($mode)) {
    $mode = "edit"; //  default mode
}

//  initialize select fields
$modulesSelect = [
    "label"              => "Module",
    "field"              => "NS_FK_Module_id",
    "optionValueField"   => "M_Module_id",
    "optionDisplayField" => "M_Description",
    "options"            => $modules,
    "mode"               => $mode,
    "tabIndex"           => 3
];

$locationsSelect = [
    "label"              => "Location",
    "field"              => "NS_Location",
    "optionValueField"   => "SP_StoreID",
    "optionDisplayField" => "SP_StoreName",
    "options"            => $locations,
    "mode"               => $mode,
    "tabIndex"           => 4
];
?>

<form id="{{$currentModule->M_Module_id}}-form" class="small-field-form row form-horizontal">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="col-md-6">
        @include("partials.elements.input", ["label" => "Code", "field" => "NS_Id", "tabIndex" => 1, "mode" => $mode])
        @include("partials.elements.input", ["label" => "Description", "field" => "NS_Description", "tabIndex" => 2, "mode" => $mode])
        @include('partials.elements.select', $modulesSelect)
        @include('partials.elements.select', $locationsSelect)
    </div>
    <div class="col-md-6">
        @include("partials.elements.input", ["label" => "Starting No.", "field" => "NS_StartNo", "tabIndex" => 5, "mode" => $mode])
        @include("partials.elements.input", ["label" => "Ending No.", "field" => "NS_EndingNo", "tabIndex" => 6, "mode" => $mode])        
        @include("partials.elements.input", ["label" => "Last No. Used", "field" => "NS_LastNoUsed", "readonly" => true, "mode" => $mode])
        @include("partials.elements.input", ["label" => "Last Date Used", "field" => "NS_LastDateUsed", "readonly" => true, "mode" => $mode])        
    </div>
</form>