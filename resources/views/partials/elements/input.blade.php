<!DOCTYPE html>
<?php
if (isset($$field)) {
    $value = $$field;
} else {
    $value = NULL;
}
?>

<div class="form-group {{$field}}-form-group {{isset($errorMessage) ? "has-error" : ""}}">
    <label class="control-label col-xs-5">{{$label}}:</label>
    <div class="col-xs-7">
        @if (isset($mode) && $mode == 'view')
        <p class="form-view-value">{{$value}}</p>
        @else
        <label class="control-label {{$field}}-error-container error-container" for="inputError" {{isset($errorMessage) ? "" : "hidden"}}>
            <i class="fa fa-times-circle-o"></i> <span class="{{$field}}-error">{{isset($errorMessage) ? $errorMessage : ""}}</span>
        </label>
        <input type="{{$type or "text"}}" class="form-control small-field-form" tabindex="{{$tabIndex or ""}}" value="{{$value or ""}}" name="{{$field}}" {{isset($readonly) && $readonly ? "readonly" : ""}}>
        @endif
    </div>
</div>