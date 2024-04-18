@extends('frontend.layouts.app')
@section('content')
    <!-- About Section Starts Here -->
    <section class="about-section padding-top bg_img padding-bottom overflow-hidden mt-4"
        style="background: url({{ asset('frontend/assets/images/top/bg.png') }});"> <br>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="statics">
                    <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
                    <label class="btn btn-secondary" for="option1">Today</label>

                    <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
                    <label class="btn btn-secondary" for="option2">Yesterday</label>

                    <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off">
                    <label class="btn btn-secondary" for="option3">This week</label>

                    <input type="radio" class="btn-check" name="options" id="option4" autocomplete="off">
                    <label class="btn btn-secondary" for="option4">This month</label>
                </div>

                <div class="rechargeh__container">
                    <div class="record__main-info text-center p-4">
                       <h3>₹10.00</h3>
                       <p>Total bet</p>
                    </div>
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="rechargeh__container">
                        <div class="record__main-info">
                            <div class="Recharge__content-paymoney__title"><img src="{{ asset('frontend/assets/images/dashboard/saveWallet.png')}}" alt="">
                                <p>Lottery</p>
                            </div>
                            <div class="record__main-info__money item flex_between">
                                <span>Total bet</span><span>₹10.00</span>
                            </div>
                            <div class="record__main-info__time item flex_between">
                                <span>Number of bets</span><span>1</span>
                            </div>
                            <div class="record__main-info__time item flex_between">
                                <span>Winning amount</span><span>₹0.00</span>
                            </div>
                        </div>
                        <div class="rechargeh__container-content">
                            <div class="empty__container text-center">
                                <img src="{{ asset('frontend/assets/images/empty-ea102850.png') }}">
                                <p>No data</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
    </section>
@endsection
