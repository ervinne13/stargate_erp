<?php
$multipleProperty = "";
$fieldName        = $field;
if (isset($multiple) && $multiple) {
    $multipleProperty = 'multiple="multiple"';
    $fieldName        = $field . "[]";
    $valueList        = isset($$field) ? explode(',', $$field) : [];
} else {
    $multiple = false;
}
?>

<div class="form-group {{$field}}-form-group {{isset($errorMessage) ? "has-error" : ""}}">
    <label class="control-label col-xs-5">{{$label}}:</label>
    <div class="col-xs-7">

        @if (isset($mode) && $mode == 'view')
        <p class="form-view-value">{{isset($$field) ?  $$field : ""}}</p>
        @else
        <label class="control-label {{$field}}-error-container error-container" for="inputError" {{isset($errorMessage) ? "" : "hidden"}}>
            <i class="fa fa-times-circle-o"></i> <span class="{{$field}}-error">{{isset($errorMessage) ? $errorMessage : ""}}</span>
        </label>
        @if (count($options) == 1)
        <input type="text" class="form-control" tabindex="{{$tabIndex or ""}}" readonly name="{{$field}}" value="{{isset($$field) && $$field}}">
        @else
        <select name="{{$fieldName}}" tabindex="{{$tabIndex or ""}}" class="select2 form-control mall-field-form" {{$multipleProperty}}>
            @if (!$multiple)
            <option value="" disabled {{isset($$field) && $$field ? "" : "selected"}}></option>
            @endif
            @foreach($options AS $key => $option)

            <?php
            if (isset($optionValueField)) {
                $value = $option[$optionValueField];
            } else {
                $value = $key;
            }

            if (isset($optionDisplayField)) {
                $displayText = $option[$optionDisplayField];
            } else {
                $displayText = $option;
            }

            if ($multiple) {
                $selected = (isset($valueList) && in_array($value, $valueList)) ? "selected" : "";
            } else {
                $selected = (isset($$field) && $$field == $value) ? "selected" : "";
            }
            ?>

            <option value="{{$value}}" {{$selected}}>
                {{$displayText}}
            </option>
            @endforeach
        </select>
        @endif
        @endif
    </div>
</div>