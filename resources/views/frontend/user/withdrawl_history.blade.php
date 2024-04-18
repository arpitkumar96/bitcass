@extends('frontend.layouts.app')
@section('content')
    <!-- About Section Starts Here -->
    <section class="about-section padding-top bg_img padding-bottom overflow-hidden mt-4"
        style="background: url({{ asset('frontend/assets/images/top/bg.png') }});"> <br>
        <div class="container">
            <form id="search_form">
            <div class="row">
                <div class="col-12 mb-2">
                    <ul class="withdrawls-history hor-swipe">
                        <li class="withdrawls-item">
                            <label class="withdrawls-megabox d-block mb-3">
                                <input type="radio" name="search_game_category" id="search_game_category" checked>
                                <span class="d-block p-2 withdrawls-megabox-elem">
                                    <img src="{{ asset('frontend/assets/images/icon/all.png') }}" class="img-fluid"> All
                                </span>
                            </label>
                        </li>
                        <li class="withdrawls-item">
                            <label class="withdrawls-megabox d-block mb-3">
                                <input type="radio" name="search_game_category" id="search_game_category">
                                <span class="d-block p-2 withdrawls-megabox-elem">
                                    <img src="{{ asset('frontend/assets/images/icon/bank-card.png') }}" class="img-fluid"> Bank Card
                                </span>
                            </label>
                        </li>
                        <li class="withdrawls-item">
                            <label class="withdrawls-megabox d-block mb-3">
                                <input type="radio" name="search_game_category" id="search_game_category">
                                <span class="d-block p-2 withdrawls-megabox-elem">
                                    <img src="{{ asset('frontend/assets/images/icon/usdt.png') }}" class="img-fluid"> USDT
                                </span>
                            </label>
                        </li>
                    </ul>
                </div>
                    <div class="col-6">
                        <label for="">Choose Type</label>
                        <div class="form-group">
                            <select class="form-control form--control" aria-label="Default select example">
                                <option selected>Choose Type</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="">Select Date</label>
                        <div class="form-group">
                            <input id="date" type="date" class="form-control form--control">
                        </div>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-12">
                    <div class="rechargeh__container">
                        <div class="rechargeh__container-head mb-2">
                            <img src="{{ asset('frontend/assets/images/dashboard/history.png') }}">
                            <h1>Withdrawal history</h1>
                        </div>
                        <div class="record__main-info">
                            <div class="record__main-info__title flex_between">
                                <div class="recharge_text">Withdrawal</div>
                                <div class="flex_between">
                                    <div class="fail">Pending</div>
                                </div>
                            </div>
                            <div class="record__main-info__money item flex_between">
                                <span>Amount</span><span>₹23</span>
                            </div>

                            <div class="record__main-info__time item flex_between">
                                <span>Time</span><span>15-03-2024 06:13 PM</span>
                            </div>
                            <div class="record__main-info__orderNumber item flex_between"><span>क्रम संख्या</span>
                                <div>
                                    <span>17105065963494</span>

                                </div>
                            </div>
                        </div>
                        <div class="rechargeh__container-content">
                            <div class="empty__container text-center">
                                <img src="{{ asset('frontend/assets/images/empty-ea102850.png') }}">
                                <p>No data</p>
                            </div>
                        </div>
                        <div class="rechargeh__container-footer text-center mt-2">
                            <button>All Records</button>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
    </section>
@endsection
