@extends('admin::layouts.main')

@section('breadcrumb')
<li class="active">User Contacts</li>
@stop

@section('css')
<link href="{{ URL::asset('public/backend/custom/datatable/dataTables.min.css') }}" rel="stylesheet" type="text/css">
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-phone font-green-haze" aria-hidden="true"></i>
                    <span class="caption-subject font-green-haze bold uppercase">User Contacts</span>
                </div>
                <div class="pull-right">
                    <!--<a class="btn btn-success" href="javascript:;"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>&nbsp;-->
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover datatable" width="100%" id="contact-table">
                        <thead>
                            <tr>
                                <th class="bold"> # </th>
                                <th class="bold"> Name </th>
                                <th class="bold"> Email </th>
                                <th class="bold"> Phone</th>
                                <th class="bold"> Contacted At </th>
                                <th class="bold"> Status </th>
                                <th class="bold" width="10%"> Actions </th>
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