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
                            <h2>Deal  Listings</h2>
                        </div>
                        <div class="col-sm-6 text-right pt-3 pr-4">
                            <a href="{{route('add-advert-deal')}}" class="deflt-btn"><i class="fa fa-plus"></i> Add Deal</a>
                        </div>
                    </div>


                    <div class="product-list-tbl table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Associate Product</th>
                                    <th>Cost Price</th>
                                    <th>HD Price</th>                                    
                                    <th>Deal Start</th>
                                    <th>Deal End</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @csrf
                                @forelse($adverts as $advert)
                                <tr>
                                    <td>{{$advert->advert_ID}}</td>
                                    <td>
                                        @if((isset($advert->product->name)))
                                        <a href="{{route('edit-product',['id'=>base64_encode($advert->prod_ID)])}}">{{$advert->product->name}}</a>
                                        @else
                                        Unknown
                                        @endif
                                    </td>
                                    <td><i class="fa fa-gbp" aria-hidden="true"></i>{{number_format($advert->cost_price,2)}}</td>
                                    <td><i class="fa fa-gbp" aria-hidden="true"></i>{{number_format($advert->hd_price,2)}}</td>                                    
                                    <td>{{(isset($advert->deal_start))?\Carbon\Carbon::parse($advert->deal_start)->format('d F Y'):'Not Applicable'}}</td>
                                    <td>{{(isset($advert->deal_end))?\Carbon\Carbon::parse($advert->deal_end)->format('d F Y'):'Not Applicable'}}</td>
                                    <td>
                                        @if($advert->status==='0')
                                        <span class="badge badge-warning">Pending</span>
                                        @else
                                        <span class="badge badge-success">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                    <a href="{{Route('edit-advert',['id'=>base64_encode($advert->advert_ID)])}}" class="edit"><i class="icofont-edit"></i></a>
                                        <a href="{{Route('advert-details',['id'=>($advert->advert_ID)])}}" class="view"><i class="icofont-eye-alt"></i></a>
                                        <a href="javascript:void(0);" class="delete delete-advert" data-id="{{$advert->advert_ID}}"><i class="icofont-ui-delete"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10">No Adverts Found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if(count($adverts)>0)
                        <div class="row justify-content-center mt-3">
                            {!!$adverts->links()!!}
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
    $(document).ready(function () {
    });
</script>
@endsection
