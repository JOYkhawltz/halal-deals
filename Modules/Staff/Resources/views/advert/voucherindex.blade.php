@extends('staff::layouts.main')

@section('css')
<link href="{{ URL::asset('public/backend/custom/datatable/dataTables.min.css') }}" rel="stylesheet" type="text/css">
@stop

@section('breadcrumb')
<li>
    <span class="active">vouchers</span>
</li>
@stop

@section('content')


<div class="portlet box blue-hoki">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-adn"></i>
            Vouchers
        </div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-scrollable" style="border: none;">
                <table class="ui celled table table-bordered datatable" cellspacing="0" width="100%" id="advert-voucher-management">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>voucher amount(<i class="fa fa-gbp" aria-hidden="true"></i>)</th>
                            <th>Total vouchers</th>                                    
                            <th>Voucher Expired IN</th>
                            <th>Status</th>
                            <th>Action</th>
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