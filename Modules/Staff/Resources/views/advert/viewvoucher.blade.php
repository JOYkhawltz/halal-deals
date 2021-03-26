@extends('staff::layouts.main')

@section('css')
<link href="{{ URL::asset('public/backend/custom/datatable/dataTables.min.css') }}" rel="stylesheet" type="text/css">
@stop

@section('breadcrumb')
<li>
    <span class="active">Adverts</span>
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
                <table class="ui celled table table-bordered datatable" cellspacing="0" width="100%" id="advert-voucherdetails-management" data-id="{{$id}}">
                    <thead>
                        <tr>
                            <th>Advert ID</th>
                            <th>voucher ID</th>
                            <th>Redeem</th>
                            <th>purchasing user</th>  
                            <th>Status</th>
                    </thead>
                    <tbody>
                               
                                
                            </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
<script src="{{ URL::asset('public/backend/custom/datatable/dataTables.min.js') }}" type="text/javascript"></script>
@stop