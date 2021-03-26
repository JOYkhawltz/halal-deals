@extends('admin::layouts.main')

@section('css')
<link href="{{ URL::asset('public/backend/custom/datatable/dataTables.min.css') }}" rel="stylesheet" type="text/css">
@stop

@section('breadcrumb')
<li>
    <span class="active">Deals</span>
</li>
@stop

@section('content')


<div class="portlet box blue-hoki">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-adn"></i>
            Deals
        </div>
        <!--<div class="pull-right"><a href="" class="btn btn-success" style="position: relative; top: 3px;"><i class="fa fa-plus"></i> Add New</a></div>-->
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-scrollable" style="border: none;">
                <table class="ui celled table table-bordered datatable" cellspacing="0" width="100%" id="advert-deal-management">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Associate Product</th>
                            <th>Cost Price(<i class="fa fa-gbp" aria-hidden="true"></i>)</th>
                            <th>HD Price(<i class="fa fa-gbp" aria-hidden="true"></i>)</th>                                    
                            <th>Deal Start</th>
                            <th>Deal End</th>
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
<div class="modal fade" tabindex="-1" role="dialog" id="deleteadvertModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #17C4BB;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="color: white;">Delete Advert</h4>
            </div>
            <div class="modal-body">
                <h4>Do you want to delete this Advert?</h4>
            </div>
            <div class="modal-footer">
                <form id="deleteadvertFORM" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success" style="background-color: #17C4BB;">Yes</button>
                </form>
            </div>
        </div> /.modal-content 
    </div> /.modal-dialog 
</div>
@stop

@section('js')
<script src="{{ URL::asset('public/backend/custom/datatable/dataTables.min.js') }}" type="text/javascript"></script>
@stop