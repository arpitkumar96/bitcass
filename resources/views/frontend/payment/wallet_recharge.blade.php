@extends('frontend.layouts.app')
@section('content')
    @push('css')
        <style>
            .btn-check:checked+.btn-secondary {
                background: linear-gradient(0deg, #ff9c19 40%, #ffdd2d 110%);
                border-radius: 0.13333rem;
                color: #000;
                border: none;
                width: 100%;
                line-height: 40px;
                height: 40px;
                text-align: center;
            }

            .btn-secondary {
                background: transparent;
            }

            .btn-secondary:hover {
                background: none;
            }

            .btn-secondary:active {
                background: none !important;
            }

            .Recharge__content-quickInfo__item .other>input:checked {
                background: linear-gradient(0deg, #ff9c19 40%, #ffdd2d 110%);
            }

            .aiz-megabox input {
                position: absolute;
                z-index: -1;
                opacity: 0;
            }
            .aiz-megabox{
                color: #8f5206;
            }
            .aiz-megabox>input:checked~.aiz-megabox-elem,
            .aiz-megabox>input:checked~.aiz-megabox-elem {
                color: #fff;
                background: linear-gradient(0deg, #ff9c19 40%, #ffdd2d 110%);
                padding: 10px;
                border-radius: 10px;
                text-align: center;
            }

            .aiz-megabox .aiz-megabox-elem {
                color: #fff;
                background: #56003f;
                padding: 10px;
                border-radius: 10px;
                text-align: center;
            }

            .aiz-megabox .aiz-megabox-elem img {
                width: 50px;
                height: 50px;
                margin-bottom: 5px;
                border-radius: 50%;
            }
            .van-cell {
                padding: 0;
            }
        </style>
    @endpush
    <section class="about-section padding-top bg_img padding-bottom overflow-hidden mt-5" style="background: url({{ asset('frontend/assets/images/top/bg.png') }});"> <br>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 mb-4">
                    <div class="balance-card">
                        <div class="wallet-recharge">
                          <div class="thumb">
                            <img src="{{ asset('frontend/assets/images/balance.png') }}" class="img-fluid mb-2">
                          </div>

                          <div class="text">
                            <h6>Balance</h6>
                            <h3>₹{{ Auth::guard('web')->user()->total_wallet_amount }}</h3>
                          </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <img src="{{ asset('frontend/assets/images/chip.png') }}" alt="" class="img-fluid mb-2" style="width: 30px;">
                            </div>
                            <div class="col-6"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($payment_types as $pay_key => $payment_type)
                <div class="col-4">
                    <label class="aiz-megabox d-block mb-3">
                        <input type="radio" class="online_payment" name="payment_type" value="{{ $payment_type->id }}"
                            @if ($pay_key == 0) checked @endif onclick="getChannel()">
                        <span class="d-block p-2 aiz-megabox-elem">
                            <img src="{{ asset('backend/assets/image/payment_types/' . $payment_type->image) }}" alt="">
                            <span class="d-block text-center">
                                <h5 class="text-white">{{ $payment_type->name }}</h5>
                            </span>
                        </span>
                    </label>
                </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="Recharge__content mt-3">
                        <div class="Recharge__content-quickInfo boxStyle">
                            <div class="Recharge__content-quickInfo__title">
                                <div class="title"><img src="{{ asset('frontend/assets/images/dashboard/quickpay.png') }}" alt="">
                                    <p>Select Channel</p>
                                </div>
                            </div>
                            <div class="rechargeTypes_list" id="channel_div">
                                @php
                                    if (isset($payment_types[0]->channel)) {
                                        if (count($payment_types[0]->channel) != 0) {
                                            $channels = $payment_types[0]->channel;
                                        } else {
                                            $channels = [];
                                        }
                                    } else {
                                        $channels = [];
                                    }
                                @endphp
                                @include('frontend.payment.channel')
                            </div>
                        </div>
                        <div class="Recharge__content-paymoney boxStyle">
                            <div class="Recharge__content-paymoney__title"><img src="{{ asset('frontend/assets/images/dashboard/saveWallet.png') }}" alt="">
                                <p>Deposit amount</p>
                            </div>
                            <div class="Recharge__content-paymoney__money-list">
                                <div class="Recharge__content-paymoney__money-list__item">
                                    <input type="radio" class="btn-check" name="amount" value="100" onclick="setAmount()" id="option0" autocomplete="off" checked>
                                    <label for="option0" class="btns btn-secondary"><span>₹</span> 100</label>
                                </div>
                                <div class="Recharge__content-paymoney__money-list__item">
                                    <input type="radio" class="btn-check" name="amount" value="500" onclick="setAmount()" id="option1" autocomplete="off">
                                    <label for="option1" class="btns btn-secondary"><span>₹</span> 500</label>
                                </div>
                                <div class="Recharge__content-paymoney__money-list__item">
                                    <input type="radio" class="btn-check" name="amount" value="1000" onclick="setAmount()" id="option2" autocomplete="off">
                                    <label for="option2" class="btns btn-secondary"><span>₹</span> 1K</label>
                                </div>
                                <div class="Recharge__content-paymoney__money-list__item">
                                    <input type="radio" class="btn-check" name="amount" value="5000" onclick="setAmount()" id="option3" autocomplete="off">
                                    <label for="option3" class="btns btn-secondary"><span>₹</span> 5K</label>
                                </div>
                                <div class="Recharge__content-paymoney__money-list__item">
                                    <input type="radio" class="btn-check" name="amount" value="10000" onclick="setAmount()" id="option4" autocomplete="off">
                                    <label for="option4" class="btns btn-secondary"><span>₹</span> 10K</label>
                                </div>
                                <div class="Recharge__content-paymoney__money-list__item">
                                    <input type="radio" class="btn-check" name="amount" value="15000" onclick="setAmount()" id="option5" autocomplete="off">
                                    <label for="option5" class="btns btn-secondary"><span>₹</span> 15K</label>
                                </div>
                            </div>
                            <div class="Recharge__content-paymoney__money-input">
                                <div class="place-div">₹</div>
                                <div class="van-cell van-field amount-input">
                                    <div class="van-cell__value van-field__value">
                                        <div class="van-field__body">
                                            <input type="number" class="form-control" id="final_amount" value="100" placeholder="Please enter the amount">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="text-danger" style="display: none" id="final_amount_error"></span>
                        </div>
                        <a class="btn btn-success w-100 mt-3 mb-3" onclick="deposit()">Deposit</a>

                        <div class="Recharge__container-intro">
                            <div class="Recharge__container-intro__title">
                                <img src="{{ asset('frontend/assets/images/dashboard/recharge.png') }}" alt="">
                                <p>Recharge instructions</p>
                            </div>
                            <div class="Recharge__container-intro__lists">
                                <div class="item">
                                    <p>If the transfer time is up, please fill out the deposit form again.</p>
                                    <p>The transfer amount must match the order you created, otherwise the money cannot be credited successfully.</p>
                                    <p>If you transfer the wrong amount, our company will not be responsible for the lost amount!</p>
                                    <p>Note: do not cancel the deposit order after the money has been transferred.</p>
                                </div>
                            </div>
                        </div>

                        <div class="record__main" payid="1">
                            <div class="record__main-title">
                                <img src="{{ asset('frontend/assets/images/dashboard/saveWallet.png') }}" alt=""><span>Deposit history</span>
                            </div>
                            <div>
                                @foreach ($wallet_recharge_requests as $wallet_recharge_request)
                                    <div class="record__main-info">
                                        <div class="record__main-info__title flex_between">
                                            <div class="recharge_text">Deposit</div>
                                            <div class="flex_between">
                                                <div class="fail">{{ ucwords($wallet_recharge_request->status) }}</div>
                                            </div>
                                        </div>
                                        <div class="record__main-info__money item flex_between">
                                            <span>Balance</span><span>₹{{ $wallet_recharge_request->amount }}</span>
                                        </div>
                                        <div class="record__main-info__type item flex_between">
                                            <span>Type</span><span>TYpay-QR</span>
                                        </div>
                                        <div class="record__main-info__time item flex_between">
                                            <span>Time</span><span>{{ $wallet_recharge_request->created_at->format('d-m-Y h:i A') }}</span>
                                        </div>
                                        <div class="record__main-info__orderNumber item flex_between"><span>क्रम संख्या</span>
                                            <div>
                                                <span>{{ $wallet_recharge_request->transaction_id }}</span>
                                                <img src="{{ asset('frontend/assets/images/dashboard/copy.png') }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div><br><br><br>
    </section>

    @push('js')
        <script>
            function getChannel() {
                $('.preloader').show();
                var payment_type_id = $('input[name="payment_type"]:checked').val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('user.get.channel.by.payment.type') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        payment_type_id: payment_type_id
                    },
                    success: function(data) {
                        $('#channel_div').html(data.view)
                        $('.preloader').hide();
                    }
                });
            }

            function setAmount() {
                $('.preloader').show();
                var amount = $('input[name="amount"]:checked').val();
                $('#final_amount').val(amount);
                $('.preloader').hide();
            }

            function deposit() {
                $('#loader_text').text('Loading...');
                $('.preloader').show();
                var payment_type_id = $('input[name="payment_type"]:checked').val();
                var channel_id = $('input[name="channel"]:checked').val();
                var final_amount = $('#final_amount').val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('user.get.qr') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        payment_type_id: payment_type_id,
                        channel_id: channel_id,
                        final_amount: final_amount,
                    },
                    success: function(data) {
                        $('.preloader').hide();
                        var win = window.open(data, '_blank');
                        win.focus();
                    },
                    error: function(request, status, error) {
                        $('#loader_text').text(request.responseJSON.message);
                        setTimeout(function() {
                            $('.preloader').hide();
                        }, 2000);
                    }
                });
            }
        </script>
    @endpush
@endsection
