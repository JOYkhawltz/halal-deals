@extends('layouts.main')

@section('content')
<section class="main-body-section">
    <div class="bottom_bx_nw contact_box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="inner_form">
                        <h2 class="section-heading">GET IN TOUCH</h2>
                        <div class="heading-line"></div>
                        <form class="" id="contact-us-form" action="{{route('contact-us')}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Name*" type="text" name="name">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Email*" type="email" name="email">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Phone" type="text" name="phone_no">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Subject" type="text" name="subject">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Message*" name="message"></textarea>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="frm-btn text-center">
                                        <button class="deflt-btn" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('js')

@stop    