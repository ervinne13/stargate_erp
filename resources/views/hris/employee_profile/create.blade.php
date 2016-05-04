
@extends('layouts.app', ["sidebar" => "layouts.sidebars.dynamic"])

@section('htmlheader')
<link rel="stylesheet" type="text/css" href="{{ asset('/plugins/datatables/dt-1.10.11/datatables.min.css') }}"/>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/plugins/underscore-min.js') }}"></script>

<!--Contains default current module and module header info-->
@include("partials.module_js_info")

<script type="text/javascript" src="{{ asset('/js/sg-datatable.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/module-processor.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/hris/employee_profile/form.js') }}"></script>
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive" src="{{$employee["EP_Primary_image"]}}" alt="Employee primary picture">
                <h3 class="profile-username text-center">{{$employee["display_name"]}}</h3>
                <p class="text-muted text-center">{{$employee["EP_Title"]}}</p>

                <strong><i class="fa fa-tags margin-r-5"></i> Tags</strong>
                <p>
                    @foreach($employee["tags"] AS $tag)
                    <span class="label {{$tag["T_Label_style"]}}">{{$tag["T_Keyword"]}}</span>
                    @endforeach                
                </p>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

        <!-- About Me Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">About</h3>
            </div><!-- /.box-header -->
            <div class="box-body">

                <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                <p class="text-muted">{{$employee["EP_Short_location"]}}</p>

                <hr>

                <strong><i class="fa fa-book margin-r-5"></i>  Education</strong>
                <p class="text-muted">{{$employee["EP_Education"]}}</p>

                <hr>               

                <strong><i class="fa fa-bolt margin-r-5"></i> Skills</strong>
                <p>
                    @foreach($employee["skills"] AS $tag)
                    <span class="label {{$tag["EPS_Label_style"]}}">{{$tag["EPS_Skill"]}}</span>
                    @endforeach    
                </p>

                <hr>

                <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                <p>{{$employee["EP_Notes"]}}</p>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-content-basic-info" data-toggle="tab">Basic Information</a></li>
                <li><a href="#tab-content-pictures" data-toggle="tab">Pictures</a></li>
                <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="tab-content-basic-info">
                    @include('hris.employee_profile.basic_info', $employee)
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab-content-pictures">

                </div><!-- /.tab-pane -->

                <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputName" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputExperience" class="col-sm-2 control-label">Experience</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSkills" class="col-sm-2 control-label">Skills</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-danger">Submit</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.tab-pane -->
            </div><!-- /.tab-content -->
        </div><!-- /.nav-tabs-custom -->
    </div><!-- /.col -->
</div><!-- /.row -->

@endsection
