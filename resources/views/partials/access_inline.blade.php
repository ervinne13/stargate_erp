
<?php
$baseUrl             = URL::to('');
?>

@if (isset($accessList) && $accessList)
@foreach ($accessList as $key => $access)

<?php
$trigger             = TRIM($access['UA_Trigger']);
$generatedProperties = "";

//  REST Compliance
if (strtolower($access['UA_AccessName']) === 'add') {    
    $splittedTrigger = explode('/', $trigger);
    $trigger         = $splittedTrigger[0] . "/" . $splittedTrigger[1] . "/create";
}

if (isset($id) && $access['UA_Get'] == 1) {
    $generatedProperties = "href={$baseUrl}/{$trigger}";
} else if (isset($id) && $access['UA_Get'] != 1) {
    $generatedProperties = "href=javascript:void(0) class=\"{$access['UA_AccessName']}\" data-id=\"{$id}\"";
} else {
    $generatedProperties = "href={$baseUrl}/{$trigger}";
}
?>

<a {{$generatedProperties}}  data-container="body" data-toggle="tooltip" data-placement="top" title="{{$access['UA_AccessName']}}">
    <span class="glyphicon {{$access['UA_Icon']}}"></span>
</a>

@endforeach
@endif
