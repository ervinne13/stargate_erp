<!DOCTYPE html>
<div class="form-group {{$field}}-form-group {{isset($errorMessage) ? "has-error" : ""}}">
    <label class="control-label col-xs-5">{{$label}}:</label>
    <div class="col-xs-7">

        @if (isset($mode) && $mode == 'view')
        <p class="form-view-value">{{$$field}}</p>
        @else
        <label class="control-label {{$field}}-error-container error-container" for="inputError" {{isset($errorMessage) ? "" : "hidden"}}>
            <i class="fa fa-times-circle-o"></i> <span class="{{$field}}-error">{{isset($errorMessage) ? $errorMessage : ""}}</span>
        </label>
        @if (count($options) > 0)
        <select name="{{$field}}" tabindex="{{$tabIndex or ""}}" class="select2 form-control">
            <option value="" disabled {{isset($$field) && $$field ? "" : "selected"}}></option>
            @foreach($options AS $option)
            <?= $selected = (isset($$field) && $$field == $option[$optionValueField]) ? "selected" : "" ?>
            <option value="{{$option[$optionValueField]}}" {{$selected}}>
                {{$option[$optionDisplayField]}}
            </option>
            @endforeach
        </select>
        @else
        <input type="text" class="form-control" tabindex="{{$tabIndex or ""}}" readonly name="{{$field}}" value="{{isset($$field) && $$field}}">
        @endif
        @endif
    </div>
</div>