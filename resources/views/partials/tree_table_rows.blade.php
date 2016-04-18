
@foreach($modules AS $module)
<tr>
    <td>
        <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapse-{{$module["M_Module_id"]}}" aria-expanded="false" aria-controls="collapse-{{$module["M_Module_id"]}}">
            <i class="fa fa-caret-right"></i>
        </a> {{$module["M_Description"]}}
    </td>
    <td></td>
    <td></td>
</tr>
@endforeach
