@extends('layouts.main')


@section('content')
<div class="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-3">
                @include('partials.left')
            </div>
            <div class="col-md-10 col-sm-9 tab_dsh_2">
                <div class="dash-right-sec">
                    <h2 class="dash-title">Voucher  Edit</h2>
                    <form  method="post" action="{{Route('advert-voucheredit-details',['id'=>$model['id']])}}" id="edit-voucherdetail-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body nw_form">

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label">Voucher ID:</label>

                                        <p class="form-control-static"> 
                                            {{ (isset($model->voucher_ID)) ?$model->voucher_ID : "#" }}
                                        </p>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label">Purchasing user name:</label>

                                        <p class="form-control-static"> 
                                            {{$user->first_name.' '.$user->last_name}}
                                        </p>

                                    </div>
                                </div>
                                
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group nw_frm">
                                    <label class="control-label">Status <span class="required">*</span></label>
                                    <div class="radio-list nw_radiolist">
                                        <label class="radio-inline">
                                            <input type="radio" class="mr-2" name="redeem" value="1" {{($model->redeem==='1')?"checked":""}} />Redeem
                                        </label>

                                        <label class="radio-inline">
                                            <input type="radio" class="mr-2" name="redeem" value="2" {{($model->redeem==='2')?"checked":""}} />Not Redeem
                                        </label>
                                        <div class="help-block err_status"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="frm-btn text-center"><button class="deflt-btn" type="submit">Save</button></div>
                        </div>
                    </form>
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
