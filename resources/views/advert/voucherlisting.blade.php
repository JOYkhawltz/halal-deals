@extends('layouts.main')
@section('css')
<link href="{{ URL::asset('public/backend/custom/datatable/dataTables.min.css') }}" rel="stylesheet" type="text/css">
@stop

@section('content')
<div class="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-3">
                @include('partials.left')
            </div>
            <div class="col-md-10 col-sm-9">

                <div class="product-list-tbl-wrap">
                    <div class="row border-btm">
                        <div class="col-sm-6">
                            <h2>Voucher  Listings</h2>
                        </div>
                        <div class="col-sm-6 text-right pt-3 pr-4">

                        </div>
                    </div>


                    <div class="product-list-tbl table-responsive">
                        <table id="voucher-list">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Voucher Price</th>
                                    <th>Purchasing user</th>                                    
                                    <th>Voucher Buying Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                        
                    </div>
                </div>

                @dashFooter @enddashFooter
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@stop
@section('js')
<script src="{{ URL::asset('public/backend/custom/datatable/dataTables.min.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('#voucher-list').DataTable({
//            processing: true,
            serverSide: true,
            ajax: '{{ route("get-advert-voucher-list") }}',
            columns: [
                {data: 'voucher_ID', name: 'voucher_ID'},
                {data: 'advert_ID', name: 'advert_ID'},
                {data: 'purchasing_user', name: 'purchasing_user'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
        });
    });
</script>
<script>
    $(document).ready(function () {
    });
</script>
@endsection
