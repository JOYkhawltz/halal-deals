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
                            <h2>Orders</h2>
                        </div>

                    </div>


                    <div class="product-list-tbl table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    
                                    <th>Order Number</th>
                                    <th>customer Name</th>
                                    <th>Type</th>
                                    <th>Quantity</th>                                    
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @csrf
                                @forelse($models as $model)
                                @php
                                $user=App\User::where('id','=',$model->user_id)->first();
                                $order=App\OrderMaster::where('id',$model->order_id)->first()
                                @endphp
                                <tr>
                                    
                                    <td>{{(isset($order->order_number)) ?$order->order_number: "#" }} </td>
                                    <td>{{$user->first_name.' '.$user->last_name}}</td>    
                                    <td>{{$model->type}}</td>
                                    <td>{{$model->quantity}}</td>
                                    <td>
                                        @if ($model->status === '0') 
                                        <span class="badge badge-warning">Processing</span>
                                        @elseif ($model->status === '1') 
                                        <span class="badge badge-info">Order Placed</span>
                                        @elseif ($model->status === '2') 
                                        <span class="badge badge-success">Shipped</span>
                                        @elseif ($model->status === '3') 
                                        <span class="badge badge-success">Delivered</span>
                                        @elseif ($model->status === '4') 
                                        <span class="badge badge-danger">Canceled</span>
                                        @else 
                                        <span class="badge badge-danger">Cancel</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{Route('view-order-details',['id'=>($model->id)])}}" class="view"><i class="icofont-eye-alt"></i></a>
                                        <a href="{{Route('edit-order-details',['id'=>($model->id)])}}" class="edit"><i class="icofont-ui-edit"></i></a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10">No Orders Found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if(count($models)>0)
                        <div class="row justify-content-center mt-3">
                            {!!$models->links()!!}
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
