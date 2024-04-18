@extends('frontend.layouts.app')
@section('content')
    <section class="about-section padding-top bg_img padding-bottom overflow-hidden mt-3"
        style="background: url({{ asset('frontend/assets/images/top/bg.png') }}); min-height: 600px;"> <br>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="mt-3 mb-3 text-center">Please swipe left - right to choose your favorite poster</h5>
                </div>
            </div>
            <div class="row gy-2 gx-2 mb-3 scroll-plan">
                <div class="col-md-4">
                    <img src="{{ asset('frontend/assets/images/top/bg.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('frontend/assets/images/top/bg.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('frontend/assets/images/top/bg.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('frontend/assets/images/top/bg.png') }}" class="img-fluid" alt="">
                </div>
            </div>
            <div class="col-md-12 text-center">
                <a href="#" class="btn btn-primary mb-3">INVITATION LINK</a>
                <a class="btn btn-outline-primary" onclick="copyTextCode('{{route('register')}}?invitation_code={{Auth::guard('web')->user()->user_id}}')">Copy invitation link</a>
            </div>
        </div><br><br>
    </section>
@endsection
