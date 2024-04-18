@extends('frontend.layouts.app')
@section('content')
    <section class="support-section padding-top bg_img padding-bottom mt-5" style="background: url({{ asset('frontend/assets/images/top/bg.png') }});">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="redeem">
                        <img src="{{ asset('frontend/assets/images/gift.png') }}" class="w-100">
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="explain usdt">
                        <div class="mb-3">
                            <p>Hii</p>
                            <p>We have a gift for you</p>
                        </div>
                        <h5 class="mb-2">Please enter the gift code below</h5>
                        <form action="{{ route('redeemgift.store') }}" method="POST">
                            @csrf
                            <input id="redeem_gift" type="text" name="redeem_gift" class="form--control form-control" placeholder="Please enter gift code">
                            <button class="btn btn-success w-100 mt-3 mb-3">Receive</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="rechargeh__container-head mb-2">
                    <img src="{{ asset('frontend/assets/images/dashboard/history.png') }}">
                    <h1>history</h1>
                </div>
                <div class="col-12">
                    @forelse ($redeem_gifts as $redeem_gift)
                        <div class="record__main-info">
                            <div class="record__main-info__title flex_between">
                                <div class="recharge_text">Type</div>
                                <div class="flex_between">
                                    <div class="fail">Gift</div>
                                </div>
                            </div>
                            <div class="record__main-info__money item flex_between">
                                <span>Amount</span><span>₹{{ $redeem_gift->amount }}</span>
                            </div>
                            <div class="record__main-info__time item flex_between">
                                <span>Time</span><span>{{ $redeem_gift->created_at->format('d-m-Y h:i A') }}</span>
                            </div>
                            <div class="record__main-info__orderNumber item flex_between"><span>Gift Code</span>
                                <div>
                                    <span>
                                        {{json_decode($redeem_gift->gift_detail)->code}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="explain">
                            <div class="rechargeh__container-content">
                                <div class="empty__container text-center">
                                    <img src="{{ asset('frontend/assets/images/empty-ea102850.png') }}">
                                    <p>No data</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div><br><br>
    </section>
@endsection
