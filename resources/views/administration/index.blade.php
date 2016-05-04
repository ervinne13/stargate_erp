<?php
$sidebar = "layouts.sidebars.administration";
?>

@extends('layouts.app')

@section('htmlheader-title')
Administration
@endsection

@section('contentheader-title')
Administration
@endsection

@section('contentheader-description')
Quick Links
@endsection

@section('htmlheader')
<link rel="stylesheet" type="text/css" href="{{ asset('/plugins/fullcalendar/fullcalendar.min.css') }}"/>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('/plugins/moment/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/administration/index.js') }}"></script>
@endsection

@section('main-content')
<!--<div class="container spark-screen">--> 
<div class="row">
    <section class="col-lg-6">

        <div class="col-md-6">
            <div class="info-box">
                <span class="info-box-icon bg-blue">
                    <i class="fa fa-user"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Users</span>
                    <span class="info-box-more">
                        <div>
                            <a href="administration/users/create">
                                <i class="fa fa-plus"></i>  Create New
                            </a>
                        </div>
                        <div>
                            <a href="administration/users">
                                <i class="fa fa-list"></i>  View List
                            </a>
                        </div>
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->

        <div class="col-md-6">
            <div class="info-box">
                <span class="info-box-icon bg-green">
                    <i class="fa fa-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Approval Setup</span>
                    <span class="info-box-more">
                        <div>
                            <a href="administration/approval/create">
                                <i class="fa fa-plus"></i>  Create New
                            </a>
                        </div>                        
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->

        <div class="col-md-6">
            <div class="info-box">
                <span class="info-box-icon bg-olive">
                    <i class="fa fa-cubes"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Modules</span>
                    <span class="info-box-more">
                        <div>
                            <a href="administration/no-series/create">
                                <i class="fa fa-plus"></i>  New Number Series
                            </a>
                        </div>
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->

        <div class="col-md-6">
            <div class="info-box">
                <span class="info-box-icon bg-purple">
                    <i class="fa fa-dropbox"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Inventory</span>
                    <span class="info-box-more">
                        <div>
                            <a href="administration/no-series/create">
                                <i class="fa fa-plus"></i>  New Item
                            </a>
                        </div>
                        <div>
                            <a href="administration/no-series/create">
                                <i class="fa fa-group"></i>  New Supplier
                            </a>
                        </div>
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->

    </section>

    <section class="col-lg-6">
        <!-- Calendar -->
        <div class="box">
            <div class="box-header">
                <i class="fa fa-calendar"></i>
                <h3 class="box-title">Calendar</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                        <button class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#">Add new event</a></li>
                            <li><a href="#">Clear events</a></li>
                            <li class="divider"></li>
                            <li><a href="#">View calendar</a></li>
                        </ul>
                    </div>
                    <button class="btn btn-default btn-sm" data-widget="collapse">
                        <i class="fa fa-minus"></i></button>                    
                </div><!-- /. tools -->
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
            </div><!-- /.box-body -->          
        </div><!-- /.box -->
    </section>
</div>
<!--</div>-->
@endsection
