@extends('layouts.main')
@section('css')
<link href="{{ URL::asset('public/backend/custom/datatable/dataTables.min.css') }}" rel="stylesheet" type="text/css">
@stop


@section('content')
<style>
.redeemtext {
  width: 79%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.redeemsubmit {
  width: 20%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.redeemsubmit:hover {
  background-color: #45a049;
}

.redeemdiv {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
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
                            <h2>Redeem</h2>
                        </div>

                    </div>


                    <!-- <div class="product-list-tbl redeemdiv">
                        
                        <form action="/action_page.php">
                         <h2>VOUCHER CODEEE</h2>
                            <label style="display:block"for="vouchercode">Voucher Code</label>
                             <input class="redeemtext" type="text" id="voucherc" name="vouchercode" placeholder="Your voucher code..">
                            <input type="search" class placeholder="your voucher code" aria-controls="voucher-list" >
                            <input class="redeemsubmit" type="submit" value="Submit">
  
                        @if(count($models)>0)
                        <div class="row justify-content-center mt-3">
                            {!!$models->links()!!}
                        </div>
                        @endif
                    </div> -->
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
            ajax: '{{ route("get-redeem-list") }}',
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
