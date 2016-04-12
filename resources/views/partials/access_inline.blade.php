@if (isset($access) && $access)
@foreach ($access as $key => $value)

<?php
$baseUrl = URL::to('/');
$trigger = TRIM($value['UA_Trigger']);

$generatedProperties = "";

if (isset($id) && $value['UA_Get'] == 1) {
    $generatedProperties = "href=\"{$baseUrl}/app/{$trigger}?id={$id}\"";
} else if (isset($id) && $value['UA_Get'] != 1) {
    $generatedProperties = "href=\"=javascript:void(0)\" class=\"{$trigger}\" data-id=\"{$id}\"";
} else {
    $generatedProperties = "href=\"{$baseUrl}/app/{$trigger}\"";
}
?>

<a {{$generatedProperties}}  data-container="body" data-toggle="tooltip" data-placement="top" title="{{$value['UA_AccessName']}}">
    <span class="glyphicon {{$value['UA_Icon']}}"></span>
</a>

@endforeach
@endif
