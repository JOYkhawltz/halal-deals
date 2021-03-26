@extends('layouts.main')


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
                            <h2>Voucher  Details</h2>
                            
                        </div>
                        <div class="col-sm-6">
                        <!-- <input type="text" name="search_voucher" id="search_voucher" onkeyup="search_vouher(this.value)"> -->
                        <div class="top-search-form">
                            <form class="header-job-search" action="search_listing.html">
                                @csrf
                                       <div class="input-group">
                                           <input type="hidden" name="advert_id" id="advert_id" value="{{$id}}">
                                           <input type="text" class="form-control prolist_nw" onkeyup="search_vouher(this.value)" placeholder="Search voucher code" aria-label="Username" aria-describedby="basic-addon1">
                                         
                                         
                                           <div class="input-group-append search_btn">
                                               <button class="btn btn-outline-secondary" type="button"><i class="icofont-search-1"></i></button>
                                           </div>
                                       </div>
                                   </form>
                            </div>

                        </div>

                    </div>


                    <div class="product-list-tbl table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Voucher ID</th>
                                    <th>Redeem</th>                                    
                                    <th>purchasing user</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="voucher_details">
                                @csrf
                                @forelse($vouchers as $voucher)
                                @php
                                $user=App\User::where('id','=',$voucher->purchasing_user)->first();
                                @endphp
                                <tr>
                                    <td>{{$voucher->voucher_ID}}</td>
                                    <td>
                                        @if($voucher->redeem==='1')
                                        <span class="badge badge-success">redeem</span>
                                        @else
                                        <span class="badge badge-warning">Not redeem</span>
                                        @endif
                                    </td>
                                    <td>{{$user->first_name.' '.$user->last_name}}</td>                                    
                                    <td>
                                        @if($voucher->status==='0')
                                        <span class="badge badge-warning">Pending</span>
                                        @else
                                        <span class="badge badge-success">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{Route('advert-voucheredit-details',['id'=>($voucher->id)])}}" class="edit"><i class="icofont-ui-edit"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10">No voucher Purchase.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if(count($vouchers)>0)
                        <div class="row justify-content-center mt-3">
                            {!!$vouchers->links()!!}
                        </div>
                        @endif
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
<script>
    function search_vouher(value)
    {
        var url='{{route("search-voucher")}}';
        var advert_id=$("#advert_id").val();
        var csrf_token = $('input[name=_token]').val();
        $.ajax({
            url: url,
            type: 'POST',
            headers: {'X-CSRF-TOKEN': csrf_token},
            dataType: 'json',
            data: {search_data:value,advert_id:advert_id},
            success: function (resp) {
                console.log(resp);
                $("#voucher_details").html(resp.content);
            }
        })
    }
</script>
@endsection
