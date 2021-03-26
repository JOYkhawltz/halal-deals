@extends('staff::layouts.main')

@section('css')
<link href="{{ URL::asset('public/backend/custom/datatable/dataTables.min.css') }}" rel="stylesheet" type="text/css">
@stop

@section('breadcrumb')
<li>
    <span class="active">Products</span>
</li>
@stop

@section('content')


<div class="portlet box blue-hoki">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer"></i>
            Products
        </div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-scrollable" style="border: none;">
                <table class="ui celled table table-bordered datatable" cellspacing="0" width="100%" id="product-management">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Vendor Name</th>
                            <th>Product Name</th>
                            <th>Normal Price</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th style="width: 220px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="deleteproductModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #17C4BB;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="color: white;">Delete Product</h4>
            </div>
            <div class="modal-body">
                <h4>Do you want to delete this Product?</h4>
            </div>
            <div class="modal-footer">
                <form id="deleteproductFORM" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success" style="background-color: #17C4BB;">Yes</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@stop

@section('js')
<script src="{{ URL::asset('public/backend/custom/datatable/dataTables.min.js') }}" type="text/javascript"></script>
@stop