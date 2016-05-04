<div class="form-group {{$field}}-form-group">
    <label class="control-label col-xs-5">{{$label}}:</label>
    <div class="col-xs-7">

        @if (isset($mode) && $mode == 'view')
        <p class="form-view-value">{{isset($value) ?  $value : ""}}</p>
        @elseif (count($options) == 1)
        <input type="text" class="form-control" tabindex="{{$tabIndex or ""}}" readonly name="{{$field}}" value="{{isset($value) && $value}}">
        @else

        <select name="{{$field}}" class="select2 form-control mall-field-form sg-small-field {{$additionalClasses}}" {{$multipleProperty}} {{$tabIndex}} {{$readonly}}>
            @if (!$multiple)            
            <option value="" disabled {{isset($value) && $value ? "" : "selected"}}></option>
            @endif            

            <?php
            if (!is_array($options)) {
                $options = $options->toArray();
            }
            ?>

            @foreach($options AS $key => $option)

            <?php
            if (is_object($option)) {
                $option = $option->toArray();
            }

            if (is_array($option) && !array_key_exists($optionValueField, $option)) {
                throw new Exception("The specified optionValueField {$optionValueField} does not exist in the options");
            }

            $optionValue = isset($optionValueField) && $optionValueField ? $option[$optionValueField] : $key;

            if ($multiple) {                
                $selected = (isset($value) && in_array($optionValue, $value)) ? "selected" : "";
            } else {
                $selected = (isset($value) && $value == $optionValue) ? "selected" : "";
            }
            ?>

            <option value="{{$optionValue}}" {{$selected}}>
                {{isset($optionDisplayField) ? $option[$optionDisplayField] : $option}}
            </option>
            @endforeach
        </select>
        @endif        
    </div>
</div>