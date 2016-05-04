<div class="pull-right">
    @if($mode == "create")
    <button id="action-save-new" type="button" class="btn btn-success btn-flat">
        <i class="fa fa-plus"></i> Save And New
    </button>
    <button id="action-save-close" type="button" class="btn btn-primary btn-flat">
        <i class="fa fa-save"></i> Save And Close
    </button>
    <button id="action-close" type="button" class="btn btn-default btn-flat">
        <i class="fa fa-close"></i> Cancel
    </button>
    @elseif ($mode == "edit")
    <button id="action-update-close" type="button" class="btn btn-success btn-flat" data-id="{{$id or (isset($idField) ? $$idField : "")}}">
        <i class="fa fa-save"></i> Update
    </button>
    <button id="action-close" type="button" class="btn btn-default btn-flat">
        <i class="fa fa-close"></i> Cancel
    </button>
    @endif
</div>