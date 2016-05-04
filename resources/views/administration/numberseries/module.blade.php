
@extends('layouts.app', ["sidebar" => "layouts.sidebars.administration"])

@section('htmlheader')
<link rel="stylesheet" type="text/css" href="{{ asset('/plugins/datatables/dt-1.10.11/datatables.min.css') }}"/>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/plugins/datatables/dt-1.10.11/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/underscore-min.js') }}"></script>

<!--Contains default current module and module header info-->
@include("partials.module_js_info")

<script type="text/javascript" src="{{ asset('/js/sg-datatable.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/module-processor.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/administration/numberseries/form.js') }}"></script>
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Number Series</h3> {{$formData["NS_Id"] or ""}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">                
                @include('administration.numberseries.form', $formData)
            </div>

            <div class="box-footer">
                @include('partials.module.action_buttons')
            </div>
        </div>
    </div>
</div>

@endsection
