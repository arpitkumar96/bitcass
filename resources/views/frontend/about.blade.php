@extends('frontend.layouts.app')
@section('content')
    <!-- Support Section Starts Here -->
    <section class="support-section padding-top bg_img padding-bottom mt-5" style="background: url({{ asset('frontend/assets/images/top/bg.png') }});">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12">
                    <img src="{{asset('frontend/assets/images/aboutbg.png')}}" class="w-100">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                    <ul class="content-itm">
                        <li><a href="#"><img src="{{asset('frontend/assets/images/dashboard/recharge.png')}}"> <span> Confidentiality Agreement </span><small><i class="las la-chevron-right"></i></small></a></li>
                        <li><a href="#"><img src="{{asset('frontend/assets/images/dashboard/recharge.png')}}"> <span> Risk Disclosure Agreement </span><small><i class="las la-chevron-right"></i></small></a></li>
                    </ul>
                </div>
            </div>
    </section>
@endsection
