@extends('frontend.layouts.app')
@section('content')
    <section class="support-section padding-top bg_img padding-bottom mt-5"
        style="background: url({{ asset('frontend/assets/images/top/bg.png') }});">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="activity-wrapper">
                        <div class="activity-banner">
                            <div>
                                <div class="banner-title">Task</div>
                                <div class="banner-para">Please remember to follow the event page</div>
                                <div class="banner-para">We will launch user feedback activities from
                                    time to time</div>
                            </div>
                        </div>
                        <div class="activity-panel">
                            <div class="activity-panel-header lg3">
                                <a href="#">
                                    <div class="header-item">
                                        <div class="van-badge__wrapper">
                                            <div class="a1 bgcontainer"></div>
                                        </div><span>Task Award</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="header-item">
                                        <div class="van-badge__wrapper">
                                            <div class="a3 bgcontainer"></div>
                                        </div><span>Trading rebate</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="header-item">
                                        <div class="van-badge__wrapper">
                                            <div class="a4 bgcontainer"></div>
                                        </div><span>Super Jackpot</span>
                                    </div>
                                </a>
                            </div>
                            <div class="activity-panel-content">
                                <div class="content-title">
                                    <a href="#">
                                        <img class="img-fluid"
                                            src="https://www.bdg3.com/assets/png/signInBanner-c7e3b971.png">
                                        <div class="content-para">Gifts</div>
                                        <p>Enter the redemption code to receive gift rewards</p>
                                    </a>
                                </div>
                                <div class="content-title">
                                    <a href="#">
                                        <img class="img-fluid"
                                            src="https://www.bdg3.com/assets/png/giftRedeem-6dad7105.png">
                                        <div class="content-para">Attendance bonus</div>
                                        <p>The more consecutive days you sign in, the higher the reward will
                                            be.</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div role="feed" class="van-list" aria-busy="false">
                            <div class="activitySection__container">
                                @foreach ($activity_banners as $activity_banner)
                                    <a href="{{$activity_banner->url??'#'}}">
                                        <div class="box">
                                            <img src="{{asset('backend/assets/image/activity_banners/'.$activity_banner->image)}}" class="act_0">
                                            <div class="box-content">
                                                <div class="box-title">{{$activity_banner->name}}</div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div></br></br>
    </section>
@endsection
