<div class="form-group sg-small-field-group {{$field}}-form-group">
    <label class="control-label col-md-5">{{$label}}:</label>
    <div class="col-md-7">
        @if ($mode == 'view')
        <p class="form-view-value">{{$value}}</p>
        @else      
        <input type="{{$type}}" name="{{$field}}" class="form-control sg-small-field {{$additionalClasses}}" value="{{$value}}" {{$tabIndex}} {{$readonly}}>
        @endif
    </div>
</div>