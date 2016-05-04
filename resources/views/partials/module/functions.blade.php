<?php
//  automatic icons
$triggerIconMap = [
    "activate" => "fa fa-check",
    "deactivate" => "fa fa-close",
];
?>

<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-bolt"></i> Functions
    <span class="caret"></span>
</a>       
<ul class="dropdown-menu">
    @foreach($functions AS $function)

    <?php $icon           = array_key_exists($function->F_Trigger, $triggerIconMap) ? $triggerIconMap[$function->F_Trigger] : ""; ?>

    <li>
        <a href="#" id="{{$function->F_Function_id}}" data-trigger="{{$function->F_Trigger}}" data-module-id="{{$function->F_FK_Module_id}}">
            <i class="{{$icon}}"></i> {{$function->F_FunctionName}}
        </a>
    </li>
    @endforeach
</ul>