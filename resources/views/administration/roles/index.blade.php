
@extends('layouts.app', ["sidebar" => "layouts.sidebars.administration"])

@section('htmlheader-title')
Roles | Positions
@endsection

@section('htmlheader')
<link rel="stylesheet" type="text/css" href="{{ asset('/plugins/datatables/dt-1.10.11/datatables.min.css') }}"/>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/plugins/datatables/dt-1.10.11/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/underscore-min.js') }}"></script>

<!--Contains default current module and module header info-->
@include("partials.module_js_info")

<script type="text/javascript" src="{{ asset('/js/sg-datatable.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/module-list-processor.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/administration/roles/index.js') }}"></script>
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body"> 
                <table class="table table-bordered" id="roles-table">
                    <thead>
                        <tr>
                            <th>
                                @include('partials.access_inline', ["accessList" => $headerAccess])
                            </th>
                            <th>Position ID</th>
                            <th>Position</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script id="access_inline_template" type="text/html">
    @include('templates.access_inline')
</script>

@endsection
