@extends('frontend.layouts.app')
@section('content')
    <!-- About Section Starts Here -->
    <section class="about-section padding-top bg_img padding-bottom overflow-hidden mt-4"
        style="background: url({{ asset('frontend/assets/images/top/bg.png') }});"> <br>
        <div class="container">
            <div class="row">
                <div class="col-12">
                  <textarea class="form--control form-control" name="" id="" cols="30" rows="10" placeholder="Welcome to feedback, please give feedback-please describe the problem in detail when providing feedback, preferably attach a screenshot of the problem you encountered, we will immediately process your feedback!" style="background:#3a3a3a;"></textarea>
                </div>
                <div class="col-12 col-md-12 text-center mt-4">
                    <h5>Send helpful feedback</h5>
                    <p>Chance to win Mystery Rewards</p>
                    <img src="{{asset('frontend/assets/images/feedback.png')}}" class="img-fluid">
                </div>
                <div class="col-12 mt-4">
                    <div class="form-group">
                        <button class="cmn--btn active w-100 btn--round" type="button" onclick="submitForm()">Sign In</button>
                    </div>
                </div>
                </div>
            </div>
            <br><br>
    </section>
@endsection
