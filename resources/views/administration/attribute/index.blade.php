
@extends('layouts.app', ["sidebar" => "layouts.sidebars.administration"])

@section('htmlheader-title')
Administration
@endsection

@section('htmlheader')
<link rel="stylesheet" type="text/css" href="{{ asset('/plugins/datatables/dt-1.10.11/datatables.min.css') }}"/>

<meta name="module_id" content="{{$attribute["A_Code"]}}">

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/plugins/datatables/dt-1.10.11/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/underscore-min.js') }}"></script>

<!--Contains default current module and module header info-->
@include("partials.module_js_info")

<script type="text/javascript" src="{{ asset('/js/sg-datatable.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/module-processor.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/administration/attributes/index.js') }}"></script>
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>

                <div class="box-tools pull-right">
                    @include('partials.module.functions')
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body"> 
                <table class="table table-bordered" id="attributes-table">
                    <thead>
                        <tr>
                            <th>
                                @include('partials.access_inline', ["accessList" => $headerAccess])
                            </th>
                            <th>
                                <input type="checkbox" class="toggle-check">
                            </th>
                            <th>Code</th>
                            <th>Description</th>                            
                            <th>Status</th>
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

<script id="checkbox_inline_template" type="text/html">
    @include('templates.checkbox_inline', ["idField" => "AD_Id"])
</script>

@endsection
