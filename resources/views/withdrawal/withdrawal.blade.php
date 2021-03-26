@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{URL::asset('public/frontend/custom/datetimepicker/css/bootstrap-datetimepicker.min.css')}}">
@endsection

@section('content')
<div class="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-3">
                @include('partials.left')
            </div>
            <div class="col-md-10 col-sm-9">
                <div class="dash-right-sec">
                    <h2 class="dash-title">Wallet</h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group bg_nw_on">
                                <label for="usr" class="d-block mb-2">Wallet Balance:</label>
                                <span class="cart-menu nw_area"><i class="icofont-wallet"></i><i class="fa fa-gbp" aria-hidden="true"></i>{{number_format($business->wallet_amount,2)}}</span>
                                <?php
                                $user_id = Auth::guard('frontend')->user()->id;
                                $wallet = App\Wallet::where('user_id', $user_id)->where('status', '0')->sum('amount');
                                $balance = ($business->wallet_amount) - $wallet;
                                ?>
                                <button class="deflt-btn nw_paybtn <?=($balance>0)?'':'d-none'?>"  style="cursor:pointer;border: none;" onclick="showwithdrawlform();">Withdrawls</button>
                                <span class="help-block"></span> 
                            </div>
                        </div> 
                    </div>
                    <div class="d-none" id="showwithdrawlform">
                        <h2 class="dash-title">Add Bank Information</h2>
                        <form method="post" class="form" action="{{route('withdrawl-request')}}" id="cash-withdrawal-form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="usr">Bank Name*</label>
                                        <input class="form-control" name="bank_name" type="text" placeholder="Enter Bank Name">
                                        <span class="help-block"></span> 
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="usr">Account Holder Name*</label>
                                        <input class="form-control" name="account_holder_name" type="text" placeholder="Enter Account Holder Name">
                                        <span class="help-block"></span> 
                                    </div>
                                </div> 
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="usr">Account Number*</label>
                                        <input class="form-control" name="account_number" type="text" placeholder="Enter Account Number">
                                        <span class="help-block"></span> 
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="usr">Branch Name*</label>
                                        <input class="form-control" name="branch_name" type="text" placeholder="Enter Branch Name">
                                        <span class="help-block"></span> 
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="usr">IFSC Code*</label>
                                        <input class="form-control" name="ifsc_code" type="text" placeholder="Enter IFSC Code">
                                        <span class="help-block"></span> 
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="usr">MICR Code</label>
                                        <input class="form-control" name="micr_code" type="text" placeholder="Enter MICR Code">
                                        <span class="help-block"></span> 
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="usr">Withdrawal Amount*</label>
                                        <input class="form-control" name="amount" type="text" placeholder="Enter Withdrawal Amount">
                                        <span class="help-block"></span> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="frm-btn text-center">
                                    <button class="deflt-btn" type="submit" style="cursor:pointer;">Request</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="history">
                        <h2 class="dash-title">History</h2>
                        <div class="product-list-tbl table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Withdraw Amount</th>
                                        <th>Bank Name</th>                                    
                                        <th>Withdrawl Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($withdrawls as $i=>$withdrawl)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td><i class="fa fa-gbp" aria-hidden="true"></i>{{number_format($withdrawl->amount,2)}}</td>
                                        <td>{{$withdrawl->bank_name}}</td>                                    
                                        <td>{{(isset($withdrawl->created_at))?\Carbon\Carbon::parse($withdrawl->created_at)->format('d F Y'):'Not Applicable'}}</td>
                                        <td>
                                            @if($withdrawl->status==='0')
                                            <span class="badge badge-warning">Pending</span>
                                            @else
                                            <span class="badge badge-success">Paid</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{Route('view-withdrawl-history',['id'=>($withdrawl->id)])}}" class="view"><i class="icofont-eye-alt"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10">No Withdrawl found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            @if(count($withdrawls)>0)
                            <div class="row justify-content-center mt-3">
                                {!!$withdrawls->links()!!}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @dashFooter @enddashFooter
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@stop