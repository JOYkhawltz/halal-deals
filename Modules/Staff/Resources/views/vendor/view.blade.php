@extends('staff::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('vendor.index') }}">Vendors</a></li>
<li class="active">View</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">Viewing details of {{ $model->full_name }}</span>
        </div>
    </div>
    <div class="portlet-body form">
        <label><strong>Product Type :</strong></label>
        @if($business->prod_types!==NULL)
        <div class="product-admin-sec">
            @php
            $user_product_types=explode(",",$business->prod_types);
            $user_product_sub_types=explode(",",$business->prod_sub_types);
            @endphp
            @foreach($user_product_types as $user_product_type)
            @php
            $product_type = \App\ProductType::where(['id'=>$user_product_type,'status'=>'1'])->first();
            @endphp
            <div class="col-sm-3">
                <h2>{{$product_type->name}}</h2>
                @if(count($user_product_sub_types)>0)
                <ul>
                    @foreach($user_product_sub_types as $user_product_sub_type)
                    @php
                    $product_sub_type = \App\ProductSubType::where(['parent_id'=>$user_product_type,'id'=>$user_product_sub_type,'status'=>'1'])->first();
                    @endphp
                    @if(count($product_sub_type)>0)
                    <li>• {{$product_sub_type->name}}</li>
                    @endif
                    @endforeach
                </ul>
                @endif
            </div>
            @endforeach
        </div>
        @else
        No Product type added
        @endif

        <!-- BEGIN FORM-->
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
            <tr>
                <th>Commission Type</th>
                <td>
                    @if($business->commission_type==='1')
                    Commission
                    @elseif($business->commission_type==='2')
                    Commission Rate
                    @else
                    Not Selected
                    @endif
                </td>
            </tr>
            <tr>
                <th>Commission Rate (%)</th>
                <td>{{ (isset($business->commission_rate)) ? number_format($business->commission_rate,2) : "Not Given" }}</td>
            </tr>
            <tr>
                <th>Additional Rate (%)</th>
                <td>{{ (isset($business->additional_rate)) ? number_format($business->additional_rate,2) : "Not Given" }}</td>
            </tr>
            <tr>
                <th>YT Link</th>
                <td>{{ (isset($business->yt_link)) ? $business->yt_link : "Not Set" }}</td>
            </tr>
            <tr>
                <th>HD Staff Link</th>
                <td>{{ (isset($business->hd_staff->first_name)) ? $business->hd_staff->first_name.' '.$business->hd_staff->last_name : "Not Set" }}</td>
            </tr>
        </table>
        <form class="form-horizontal">
            <div class="form-actions text-right">
                <a href="{{ Route('staff-vendor.edit', ['id' => base64_encode($model->id)]) }}" class="btn green">
                    <i class="fa fa-pencil"></i> Edit
                </a>
                <a href="{{ Route('staff-vendor.index') }}" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
@stop