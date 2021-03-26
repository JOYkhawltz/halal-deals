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
                            <h2>Product Listings</h2>
                        </div>
                        <div class="col-sm-6 text-right pt-3 pr-4">
                            <a href="{{route('add-product')}}" class="deflt-btn"><i class="fa fa-plus"></i> Add Product</a>
                        </div>
                    </div>


                    <div class="product-list-tbl table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Verified</th>
                                    <th>Verified Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @csrf
                                @forelse($products as $product)
                                <tr>
                                    <td>{{$product->prod_ID}}</td>
                                    <td><img src="{{URL::asset('public/uploads/frontend/product/preview/'.$product->defaultPic->image_name)}}" onerror="this.onerror=null;this.src={{URL::asset('public/frontend/images/box.png')}};"></td>
                                    <td>{{$product->name}}</td>
                                    <td><i class="fa fa-gbp" aria-hidden="true"></i>{{$product->normal_price}}</td>
                                    <td>{{str_limit($product->brief_description,15)}}</td>
                                    <td>
                                        @if($product->price_verified==='1')
                                        Yes
                                        @else
                                        NO
                                        @endif
                                    </td>
                                    <td> 
                                        @if($product->price_verified_date!==NULL)
                                        {{\Carbon\Carbon::parse($product->price_verified_date)->format('d F Y')}}
                                        @else
                                        Not Verified
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->status==='0')
                                        <span class="badge badge-warning">Pending</span>
                                        @else
                                        <span class="badge badge-success">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!--<a href="#" class="view"><i class="icofont-eye-alt"></i></a>-->
                                        <a href="{{Route('edit-product',['id'=>base64_encode($product->prod_ID)])}}" class="edit"><i class="icofont-edit"></i></a>
                                        <a href="javascript:void(0);" class="delete delete-product" data-id="{{$product->prod_ID}}"><i class="icofont-ui-delete"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9">No Products Found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if(count($products)>0)
                        <div class="row justify-content-center mt-3">
                            {!!$products->links()!!}
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
