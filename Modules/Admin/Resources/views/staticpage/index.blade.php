@extends('admin::layouts.main')

@section('breadcrumb')
<li class="active">Static Pages</li>
@stop

@section('css')
<link href="{{ URL::asset('public/backend/custom/datatable/dataTables.min.css') }}" rel="stylesheet" type="text/css">
@stop

@section('content')
<h3 class="page-title">Static Pages
    <small>Manage all the static page of the site from here</small>
</h3>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-layers font-green-haze" aria-hidden="true"></i>
                    <span class="caption-subject font-green-haze bold uppercase">Static Pages</span>
                </div>
                <div class="pull-right">
                    <!--<a class="btn btn-success" href="javascript:;"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>&nbsp;-->
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover datatable" width="100%" id="static-page-table">
                        <thead>
                            <tr>
                                <th class="bold"> # </th>
                                <th class="bold"> Page Name </th>
                                <th class="bold"> Content </th>
                                <th class="bold"> Last Updated </th>
                                <th class="bold" width="15%"> Actions </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="{{ URL::asset('public/backend/custom/datatable/dataTables.min.js') }}" type="text/javascript"></script>
@stop