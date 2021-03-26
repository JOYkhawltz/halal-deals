@extends('admin::layouts.main')

@section('css')
<link href="{{ URL::asset('public/backend/custom/datatable/dataTables.min.css') }}" rel="stylesheet" type="text/css">
@stop

@section('breadcrumb')
<li>
    <span class="active">Orders</span>
</li>
@stop

@section('content')


<div class="portlet box blue-hoki">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-history"></i>
            Orders
        </div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-scrollable" style="border: none;">
                    <table class="ui celled table table-bordered datatable" cellspacing="0" width="100%" id="order-management">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Order Number</th>
                            <th>Customer Name</th>
                            <th>Payment Gateway</th>
                            <th> Pay Amount(<i class="fa fa-gbp" aria-hidden="true"></i>)</th>
                            <th> Payment Status</th>
                            <th style="width: 120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="{{ URL::asset('public/backend/custom/datatable/dataTables.min.js') }}" type="text/javascript"></script>
@stop