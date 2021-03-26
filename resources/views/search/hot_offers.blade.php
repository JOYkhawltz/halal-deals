@extends('layouts.main')
@section('content')
<section class="main-body-section">
    <div class="product_list">
        <div class="container">
            <div class="row">
                <form action="{{Route('post-hotdeal-search')}}" id="loadmoreForm">
                        @csrf
                        <input type="hidden" id="limit" name="limit" value="{{ $limit }}">
                        <input type="hidden" id="offset" name="offset" value="{{ $offset }}">
                </form>
                <div class="col-md-12">
                    <div class="right_part">
                        <div class="top_part d-flex justify-content-between align-items-center">
                            <h1>DEALS OFFERS</h1>
<!--                            <div class="right_part_box">
                                <span class="sort_form">Sort By:</span>
                                <span class="stl_drp">
                                    <select class="form-control selectpicker bs-select-hidden" onchange="sortByCoupon(this);">
                                        <option val="">Sort by Price</option>
                                        <option value="htl">Price High to Low</option>
                                        <option value="lth">Price Low to High</option> 
                                    </select><div class="btn-group bootstrap-select form-control"><button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" title="Sort by Price"><span class="filter-option pull-left">Sort by Price</span>&nbsp;<span class="caret"></span></button><div class="dropdown-menu open"><ul class="dropdown-menu inner" role="menu"><li data-original-index="0" class="selected"><a tabindex="0" class="" style="" data-tokens="null"><span class="text">Sort by Price</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class="" style="" data-tokens="null"><span class="text">Price High to Low</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class="" style="" data-tokens="null"><span class="text">Price Low to High</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div></div>
                                </span>
                            </div>-->
                        </div>
                        <div class="bottom_part">
                            <div class="row" id="fetchhotdealResults">
                                
                            </div>
                        </div>
                        <div class="foot_prt text-center">
                            <a href="#" class="search_load_btn d-none">SHOW MORE <i class="icofont-rounded-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
@section('js')
<script>
    $(document).ready(function () {
        loadHotOffers();
    });
</script>
@stop