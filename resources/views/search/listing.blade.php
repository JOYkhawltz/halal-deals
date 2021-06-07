<?php
$arr = [];
if (count($model) > 0):
    foreach ($model as $key => $val) {
        if (in_array($val->advert_ID, $arr)) {
            continue;
        } else {
            $arr[$key] = $val->advert_ID;
        }
        if ($key < $limit) {
            ?>
            <div class="col-md-4">
<!--                <div class="offer-box">
                    <div class="media">
                        <div class="media-body">
                            <div class="off-price">{{str_limit($val->title,15)}}</div>
                        <div class="media-right">
                            @if(count($val->product)>0)
                            @if(!empty($val->product->defaultPic))
                            <div class="brand-logo"><img src="{{ URL::asset('public/uploads/frontend/product/preview/'.$val->product->defaultPic->image_name) }}" height="50" width="50"></div>
                            @else
                            <div class="brand-logo"><img src="{{ URL::asset('public/frontend/images/product1.png') }}"></div>
                            @endif
                            @endif
                                    <div class="brand-logo"><img src="{{ URL::asset('public/frontend/images/brand1.png') }}"></div>
                        </div>
                        </div>
                    </div>
                    <div class="offer-txt">
                        {{ str_limit($val->smallprint, 80)}}
                    </div>
                    <div class="media">
                        <div class="media-right">
                            <a href="{{Route('advert-details',['id'=>$val->advert_ID])}}" class="deflt-btn">Get Coupon</a>
                        </div>
                    </div>
                </div>-->
                 <a href="{{Route('advert-details',['id'=>$val->advert_ID])}}">
                            <div class="offer-box">
                                <div class="offer-box-top">
                                    @if(count($val->product)>0)
                                    @if(!empty($val->product->defaultPic))
                                    <img class="img-fluid" src="{{ URL::asset('public/uploads/frontend/product/preview/'.$val->product->defaultPic->image_name) }}"/>
                                    @else
                                    <img class="img-fluid" src="{{ URL::asset('public/frontend/images/product1.png') }}"></div>
                                    @endif
                                    @endif
                                </div>
                                <div class="offer-box-bottom">
                                    <div>
                                    <h3>{{str_limit($val->title,15)}}</h3>
                                    <h5>{{$val->name}}</h5>
                                    </div>
                                    <div>
                                        <span class="ourprice">Our price<h4><i class="icofont-pound"></i>{{$val->cost_price}}</h4></span>
                                        <span class="normalprice">Normal price<h4><i class="icofont-pound"></i>{{$val->hd_price}}</h4></span>
                                    </div>
                                </div>
                            </div>
                        </a>
            </div>
            <?php
        }
    }else:
    ?>
    <div class="col-md-12">
        <div class="alert alert-danger text-center" role="alert">
            No record found!
        </div>
    </div>
<?php endif; ?>
