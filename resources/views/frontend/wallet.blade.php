@extends('frontend.layouts.app')
@section('content')
    <section class="account-section overflow-hidden bg_img"
        style="background:url({{ asset('frontend/assets/images/account/bg.jpg') }})">
        <div class="container">
            <div class="mb-3">
                <div class="userInfo__container_wallet">
                    <div class="userInfo__container-content p-0">
                        <div class="wallet-container-header-belly">
                            <img src="https://www.bdg3.com/assets/png/wallets-f7d6f3d6.png" alt="">
                            <div>₹{{Auth::guard('web')->user()->total_wallet_amount}}</div><span>Total balance</span>
                        </div>
                    </div>
                </div>
                <div class="userinfo-content">
                    <div class="totalSavings__container">
                        <div class="totalSavings__container-header">
                            <div class="totalSavings__container-header-box ar-1px-b">
                                <div class="totalSavings__container-header__title"><span>Main wallet</span></div>
                                <p class="totalSavings__container-header__subtitle"><span>₹{{Auth::guard('web')->user()->total_wallet_amount}}</span></p>
                            </div>
                        </div>
                        <div class="totalSavings-container-content-fund">
                            <div class="totalSavings__container-content-item">
                                <a href="{{route('user.wallet.recharge')}}">
                                    <div>
                                        <img src="{{ asset('frontend/assets/images/dashboard/deposit.png') }}" alt="">
                                        <span>Deposit</span>
                                    </div>
                                </a>
                            </div>
                            <div class="totalSavings__container-content-item">
                                <a href="{{route('user.withdrawl')}}">
                                    <div>
                                        <img src="{{ asset('frontend/assets/images/dashboard/widthdral.png') }}" alt="">
                                        <span>Withdraw</span>
                                    </div>
                                </a>
                            </div>
                            <div class="totalSavings__container-content-item">
                                <a href="#">
                                    <div>
                                        <img src="{{ asset('frontend/assets/images/dashboard/transfer.png') }}" alt="">
                                        <span>Transfer</span>
                                    </div>
                                </a>
                            </div>
                            <div class="totalSavings__container-content-item">
                                <div><img src="{{ asset('frontend/assets/images/dashboard/wallet.png') }}" alt="">
                                    <span>Deposit history</span>
                                </div>
                            </div>
                            <div class="totalSavings__container-content-item">
                                <div><img src="{{ asset('frontend/assets/images/dashboard/vip.png') }}">
                                    <span>Withdrawal history</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="financialServices__container">
                        <div class="financialServices__container-footer"></div>
                        <div class="financialServices__container-box">
                            <div>
                                <div class="financialServices__container-box-para">
                                    <h3>534.52</h3> <span>Lottery</span>
                                </div>
                            </div>
                            <div>
                                <div class="financialServices__container-box-para">
                                    <h3>0.00</h3> <span>EVO_Video</span>
                                </div>
                            </div>
                            <div>
                                <div class="financialServices__container-box-para">
                                    <h3>0.00</h3> <span>JILI</span>
                                </div>
                            </div>
                            <div>
                                <div class="financialServices__container-box-para">
                                    <h3>0.00</h3> <span>JDB</span>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="record__main" payid="1">
                        <div class="record__main-title">
                            <img src="{{ asset('frontend/assets/images/dashboard/saveWallet.png') }}"
                                alt=""><span>Wallet history</span>
                        </div>
                        <div>
                            @foreach ($wallets as $wallet)
                                <div class="record__main-info">
                                    <div class="record__main-info__title flex_between">
                                        <div class="recharge_text">Type</div>
                                        <div class="flex_between">
                                            <div class="fail">{{ucwords(str_replace('_',' ',$wallet->type))}}</div>
                                        </div>
                                    </div>
                                    <div class="record__main-info__money item flex_between">
                                        <span>Amount</span><span>₹{{$wallet->amount}}</span>
                                    </div>
                                    {{-- <div class="record__main-info__type item flex_between">
                                        <span>Type</span><span>TYpay-QR</span>
                                    </div> --}}
                                    <div class="record__main-info__time item flex_between">
                                        <span>Time</span><span>{{$wallet->created_at->format('d-m-Y h:i A')}}</span></div>
                                    <div class="record__main-info__orderNumber item flex_between"><span>क्रम संख्या</span>
                                        <div>
                                            <span>

                                                @if($wallet->type == 'deposite')
                                                    {{$wallet->deposite->transaction_id}}
                                                @elseif($wallet->type == 'withdrawal')
                                                    {{$wallet->withdrawal->withdrawal_request_id}}
                                                @elseif($wallet->type == 'bet')
                                                    {{$wallet->bet->startGame->start_game_id}}
                                                @elseif($wallet->type == 'reward')
                                                    {{$wallet->reward->startGame->start_game_id}}
                                                @endif

                                            </span>
                                            {{-- <img src="{{ asset('frontend/assets/images/dashboard/copy.png') }}"
                                                alt=""> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
