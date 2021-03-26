@extends('admin::layouts.main')

@section('breadcrumb')
<li><a href="{{ Route('product-type.index') }}">Product Types</a></li>
<li class="active">Product Sub Types</li>
@stop

@section('css')
<link href="{{ URL::asset('public/backend/custom/datatable/dataTables.min.css') }}" rel="stylesheet" type="text/css">
@stop

@section('content')
<h3 class="page-title">Product Sub Types
    <small>Manage all the product sub type of the site from here</small>
</h3>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-layers font-green-haze" aria-hidden="true"></i>
                    <span class="caption-subject font-green-haze bold uppercase">Product Sub Types</span>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ Route('product-sub-type.create', ['id' => base64_encode($id)]) }}"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>&nbsp;
                </div>
            </div>
            <div class="portlet-body">
                <input type="hidden" id="parent_id" value="{{ $id }}">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover datatable" width="100%" id="product-sub-type-table">
                        <thead>
                            <tr>
                                <th class="bold"> # </th>
                                <th class="bold"> Name </th>
                                <th class="bold"> Added On </th>
                                <th class="bold"> Status </th>
                                <th class="bold" width="20%"> Actions </th>
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

<script type="text/javascript">
$(document).ready(function () {

    var id = $('#parent_id').val();

    $('#product-sub-type-table').DataTable({
        processing: false,
        serverSide: true,
        order: [[0, "desc"]],
        ajax: full_path + 'product-sub-type?id=' + id,
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'created_at', name: 'created_at'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});
</script>
@stop