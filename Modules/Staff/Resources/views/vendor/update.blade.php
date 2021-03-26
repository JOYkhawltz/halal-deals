@extends('staff::layouts.main')
@section('css')
<link href="{{ URL::asset('public/frontend/css/icofont.min.css') }}" rel="stylesheet" type="text/css" /> 
<link href="{{ URL::asset('public/frontend/css/style.css') }}" rel="stylesheet" type="text/css" />
<style>
    textArea{resize: vertical;}
</style>
@stop
@section('breadcrumb')
<li> <a href="{{ Route('vendor.index') }}">Vendors</a></li>
<li> <a href="{{ Route('vendor.show', ['id' => base64_encode($model->id)]) }}">{{ $model->full_name }}</a></li>
<li class="active">Update</li>
@stop
@section('content')
<div class="user-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Updating details of {{ $model->full_name }}</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ Route('staff-vendor.update', ['id' => base64_encode($model->id)]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <input type="hidden" name="id" value="{{ $model->id }}">
                    <table class="abmin-prof-tbl">
                        <tr>
                            <th>First name</th>
                            <td>{{ (isset($model->first_name) && $model->first_name !== NULL) ? $model->first_name : "Not Given" }} </td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td>{{ (isset($model->last_name) && $model->last_name !== NULL) ? $model->last_name : "Not Given" }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td> {{ (isset($model->email) && $model->email !== NULL) ? $model->email : "Not Given" }} </td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td> {{ (isset($model->phone) && $model->phone !== NULL) ? $model->phone : "Not Given" }}  </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td> @if($model->status == '0')
                                Inactive
                                @elseif($model->status == '1')
                                Active
                                @else
                                Block
                                @endif  
                            </td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td> {{ (isset($model->phone) && $model->phone !== NULL) ? $model->phone : "Not Given" }}  </td>
                        </tr>
                        <!-- Business -->
                        <tr>
                            <th>Name</th>
                            <td> {{ (isset($business->name) && $business->name !== NULL) ? $business->name : "Not Given" }}  </td>
                        </tr>
                        <tr>
                            <th>Address 1</th>
                            <td> {{ (isset($business->address1) && $business->address1 !== NULL) ? $business->address1 : "Not Given" }}  </td>
                        </tr>
                        <tr>
                            <th>Address 2</th>
                            <td> {{ (isset($business->address2) && $business->address2 !== NULL) ? $business->address2 : "Not Given" }}  </td>
                        </tr>
                        <tr>
                            <th>Town</th>
                            <td> {{ (isset($business->town) && $business->town !== NULL) ? $business->town : "Not Given" }}  </td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td> {{ (isset($business->city) && $business->city !== NULL) ? $business->city : "Not Given" }}  </td>
                        </tr>
                        <tr>
                            <th>Post Code</td>
                            <td> {{ (isset($business->post_code) && $business->post_code !== NULL) ? $business->post_code : "Not Given" }}  </td>
                        </tr>
                        <tr>
                            <th>Telephone no</th>
                            <td> {{ (isset($business->telphone_no) && $business->telphone_no !== NULL) ? $business->telphone_no : "Not Given" }}  </td>
                        </tr>
                        <tr>
                            <th>Website</th>
                            <td> {{ (isset($business->website) && $business->website !== NULL) ? $business->website : "Not Given" }}  </td>
                        </tr>
                        <tr>
                            <th>Contact Name</th>
                            <td> {{ (isset($business->contact_name) && $business->contact_name !== NULL) ? $business->contact_name : "Not Given" }}  </td>
                        </tr>
                        <tr>
                            <th>Contact No</th>
                            <td> {{ (isset($business->contact_no) && $business->contact_no !== NULL) ? $business->contact_no : "Not Given" }}  </td>
                        </tr>
                        <tr>
                            <th>Halal Cert</th>
                            <td>  @if($business->halal_cert == 1)
                                HMC Approved
                                @elseif($business->halal_cert == 2)
                                HFA Approved
                                @elseif($business->halal_cert == 3)
                                Other Certification
                                @elseif($business->halal_cert == 4)
                                No Certification but fully halal
                                @elseif($business->halal_cert == 5)
                                Non halal meat also served
                                @elseif($business->halal_cert == 6)
                                Halal upon request only-predominantly non halal meat served
                                @else
                                N/A
                                @endif  
                            </td>
                        </tr>
                        <tr>
                            <th>Alcohol Served</th>
                            <td>  @if($business->alchohol_served == 1)
                                Yes
                                @elseif($business->alchohol_served == 2)
                                No
                                @elseif($business->alchohol_served == 3)
                                Byob Allowed
                                @else
                                N/A
                                @endif  
                            </td>
                        </tr>
                        <tr>
                            <th>Male Service</th>
                            <td>  @if($business->male_service == 1)
                                Male Only
                                @elseif($business->male_service == 2)
                                Upon Request
                                @elseif($business->male_service == 3)
                                Mixed Group Service
                                @elseif($business->male_service == 4)
                                No Guarantee
                                @else
                                N/A
                                @endif  
                            </td>
                        </tr>
                        <tr>
                            <th>Female Service</th>
                            <td>  @if($business->female_service == 1)
                                Female Only
                                @elseif($business->female_service == 2)
                                Upon Request
                                @elseif($business->female_service == 3)
                                Mixed Group Service
                                @elseif($business->female_service == 4)
                                No Guarantee
                                @else
                                N/A
                                @endif  
                            </td>
                        </tr>
                        <tr>
                            <th>Gender Segregated</th>
                            <td>  @if($business->gender_segregated == 1)
                                Yes
                                @elseif($business->gender_segregated == 2)
                                Upon Request
                                @elseif($business->gender_segregated == 3)
                                No
                                @else
                                N/A
                                @endif  
                            </td>
                        </tr>
                        <tr>
                            <th>Family Area</th>
                            <td>  @if($business->gender_segregated == 1)
                                Yes
                                @elseif($business->gender_segregated == 2)
                                Upon Request
                                @elseif($business->gender_segregated == 3)
                                No
                                @else
                                N/A
                                @endif  
                            </td>
                        </tr>
                        <tr>
                            <th>Introduction</th>
                            <td>{{ (isset($business->introduction) && $business->introduction !== NULL) ? $business->introduction : "Not Given" }}</td>
                        </tr>
                        <tr>
                            <th>Details</th>
                            <td>{{ (isset($business->details) && $business->details !== NULL) ? $business->details : "Not Given" }}</td>
                        </tr>
                        <tr>
                            <th>Smallprint</th>
                            <td>{{ (isset($business->smallprint) && $business->smallprint !== NULL) ? $business->smallprint : "Not Given" }}</td>
                        </tr>
                    </table>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group  {{ $errors->has('yt_link') ? ' has-error' : '' }}">
                                <label for="usr"><strong>YT Link :</strong></label>
                                <input type="text" name="yt_link" class="form-control" value="{{$business->yt_link}}">
                                @if ($errors->has('yt_link'))
                                <div class="help-block">{{ $errors->first('yt_link') }}</div>
                                @endif
                            </div>
                        </div>
                        @if($business->yt_link!==NULL)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <iframe width="420" height="200" frameborder="0"
                                        src="{{$business->yt_link}}">
                                </iframe>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group  {{ $errors->has('commission_type') ? ' has-error' : '' }}">
                                <label for="usr"><strong>Commission Type : </strong></label>
                                <input type="radio" name="commission_type" value="1" {{($business->commission_type==='1')?"checked":""}} />Commission
                                <input type="radio" name="commission_type" value="2" {{($business->commission_type==='2')?"checked":""}} />Commission Rate
                                @if ($errors->has('commission_type'))
                                <div class="help-block">{{ $errors->first('commission_type') }}</div>
                                @endif
                            </div>
                        </div> 
                        <div class="col-sm-3  {{ $errors->has('commission_rate') ? ' has-error' : '' }}">
                            <div class="form-group">
                                <label for="usr"><strong>Commission Rate (%) :</strong></label>
                                <input type="text" name="commission_rate" class="form-control" value="{{number_format($business->commission_rate,2)}}">
                                @if ($errors->has('commission_rate'))
                                <div class="help-block">{{ $errors->first('commission_rate') }}</div>
                                @endif
                            </div>
                        </div> 
                        <div class="col-sm-3  {{ $errors->has('additional_rate') ? ' has-error' : '' }}">
                            <div class="form-group">
                                <label for="usr"><strong>Additional Rate (%):</strong></label>
                                <input type="text" name="additional_rate" class="form-control" value="{{number_format($business->additional_rate,2)}}">
                                @if ($errors->has('additional_rate'))
                                <div class="help-block">{{ $errors->first('additional_rate') }}</div>
                                @endif
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn green">Update</button>
                            <a href="{{ Route('staff-vendor.show', ['id' => base64_encode($model->id)]) }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
    $(document).ready(function () {
        $(".sub-cat").hide();
        $(".main_cat").click(function () {
            $(this).closest("li").find(".sub-cat").toggle(300);
            $(this).find("#plus").toggle();
            $(this).find("#minus").toggle();
        });
        $(document).on('click', '.sub_type', function () {
            var main_sub_ul = $(this).parents("li").parent();
            if ($(this).prop("checked") == true) {
                $(main_sub_ul).parent().find(".main_type").attr('checked', true);
            }
            if ($(main_sub_ul).find('.sub_type:checked').length == 0) {
                $(main_sub_ul).parent().find(".main_type").removeAttr('checked');
            }
        });
    });
</script>
@endsection