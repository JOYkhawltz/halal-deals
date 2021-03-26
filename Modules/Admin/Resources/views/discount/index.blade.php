@extends('admin::layouts.main')

@section('breadcrumb')
<li class="active">Discount Management</li>
@stop

@section('css')
<link href="{{ URL::asset('public/backend/custom/datatable/dataTables.min.css') }}" rel="stylesheet" type="text/css">
@stop

@section('content')
<h3 class="page-title">Discount Management
    <small>Manage all the discounts of the site from here</small>
</h3>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-list-ul" aria-hidden="true"></i>
                    <span class="caption-subject font-green-haze bold uppercase">Discounts</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover datatable" width="100%" id="admin-discount-table">
                        <thead>
                            <tr>
                                <th class="bold"> # </th>
                                <th class="bold"> Discount Name </th>
                                <th class="bold"> Discount Rate </th>
                                <th class="bold"> Updated At </th>
                                <th class="bold"> Status </th>
                                <th class="bold" width="23%"> Actions </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal fade" tabindex="-1" role="dialog" id="deletecustomerModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #17C4BB;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="color: white;">Delete Ad</h4>
            </div>
            <div class="modal-body">
                <h4>Do you want to delete this ad?</h4>
            </div>
            <div class="modal-footer">
                <form id="deletecustomerFORM" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success" style="background-color: #17C4BB;">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div> -->
@stop

@section('js')
<script src="{{ URL::asset('public/backend/custom/datatable/dataTables.min.js') }}" type="text/javascript"></script>
@stop