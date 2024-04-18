@extends('frontend.layouts.app')
@section('content')
    <section class="account-section overflow-hidden bg_img" style="background:url({{ asset('frontend/assets/images/account/bg.jpg') }})">
        <div class="container">
            <div class="mb-3">
                <div class="userInfo__container">
                    <div class="userInfo__container-content">
                        <div class="userInfo__container-content-wrapper">
                            <div class="userInfo__container-content__avatar">
                                <img src="{{ asset('frontend/assets/images/dashboard/user.png') }}" class="userAvatar">
                            </div>
                            <div class="userInfo__container-content__name">
                                <div class="userInfo__container-content-nickname">
                                    <h3>XYZ Sharma</h3>
                                    <p>UID | {{ Auth::guard('web')->user()->user_id }} <i class="las la-copy"></i></p>
                                    <div class="n0"></div>
                                </div>
                                {{-- <div class="userInfo__container-content-uid">
                                <span>UID</span><span>|</span><span>3495474</span> <i class="las la-copy"></i>
                            </div>
                            <div class="userInfo__container-content-logintime">
                                <span>Last login:&nbsp;</span><span>2024-02-27 14:24:03</span>
                            </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="userinfo-content">
                    <div class="totalSavings__container">
                        <div class="totalSavings__container-header">
                            <div class="totalSavings__container-header-box ar-1px-b">
                                <div class="totalSavings__container-header__title"><span>Total balance</span></div>
                                <p class="totalSavings__container-header__subtitle">
                                    ₹<span id="current_wallet_amount">{{ Auth::guard('web')->user()->total_wallet_amount }}</span> <i class="las la-sync" onclick="refreshWalletAmount()"></i>
                                </p>

                                <p class="view"><small><a href="#"><i class="las la-eye"></i></a></small></p>

                            </div>
                        </div>
                        <div class="totalSavings__container-content">
                            <div class="totalSavings__container-content-item">
                                <a href="{{route('user.wallet')}}">
                                    <img src="{{ asset('frontend/assets/images/dashboard/wallet.png') }}" alt="">
                                    <span>Wallet</span>
                                </a>
                            </div>
                            <div class="totalSavings__container-content-item">
                                <a href="{{ route('user.wallet.recharge') }}">
                                    <img src="{{ asset('frontend/assets/images/dashboard/deposit.png') }}" alt="">
                                    <span>Deposit</span>
                                </a>
                            </div>
                            <div class="totalSavings__container-content-item">
                                <a href="{{ route('user.withdrawl') }}">
                                    <img src="{{ asset('frontend/assets/images/dashboard/widthdral.png') }}" alt="">
                                    <span>Withdraw</span>
                                </a>
                            </div>
                            <div class="totalSavings__container-content-item">
                                <a>
                                    <img src="{{ asset('frontend/assets/images/dashboard/vip.png') }}">
                                    <span>VIP</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="financialServices__container">
                        <div class="financialServices__container-footer"></div>
                        <div class="financialServices__container-box">
                            <div>
                                <a class="d-flex" href="{{route('user.bet.history')}}">
                                <img src="{{ asset('frontend/assets/images/dashboard/bet.png') }}">
                                <div class="financialServices__container-box-para">
                                    <h3>Trade</h3><span>My trading history</span>
                                </div>
                                </a>
                            </div>
                            <div>
                                <a class="d-flex" href="{{route('user.transaction_history')}}">
                                <img src="{{ asset('frontend/assets/images/dashboard/transaction.png') }}">
                                <div class="financialServices__container-box-para">
                                    <h3>Transaction</h3><span>My transaction history</span>
                                </div>
                                </a>
                            </div>
                            <div>
                                <a class="d-flex" href="{{ route('user.deposit_history')}}">
                                <img src="{{ asset('frontend/assets/images/dashboard/deposte.png') }}">
                                <div class="financialServices__container-box-para">
                                    <h3>Deposit</h3><span>My deposit history</span>
                                </div>
                                </a>
                            </div>
                            <div>
                                <a  class="d-flex" href="{{ route('user.withdrawl_history') }}">
                                <img src="{{ asset('frontend/assets/images/dashboard/widthdra.png') }}">
                                <div class="financialServices__container-box-para">
                                    <h3>Withdraw</h3><span>My withdraw history</span>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="settingPanel__container">
                        <div class="settingPanel__container-items">
                            <div class="settingPanel__container-items__item ar-1px-b">
                                <div class="settingPanel__container-items__title">
                                    <a href="{{route('user.notification')}}"> <img src="{{ asset('frontend/assets/images/dashboard/notification.png') }}"><span>Notification</span></a>
                                </div>
                                <div class="settingPanel__container-items-right">
                                    <i class="las la-angle-right"></i>
                                </div>
                            </div>
                            <div class="settingPanel__container-items__item ar-1px-b">
                                <div class="settingPanel__container-items__title">
                                   <a href="{{route('redeemgift')}}"><img src="{{ asset('frontend/assets/images/dashboard/gift.png') }}"><span>Gifts
                                    </span></a>
                                </div>
                                <div class="settingPanel__container-items-right">
                                    <i class="las la-angle-right"></i>
                                </div>
                            </div>
                            <div class="settingPanel__container-items__item ar-1px-b">
                                <div class="settingPanel__container-items__title">
                                    <a href="{{route('user.gamestatics')}}"> <img src="{{ asset('frontend/assets/images/dashboard/game.png') }}"><span>
                                        Game statistics</span> </a>
                                </div>
                                <div class="settingPanel__container-items-right">
                                    <i class="las la-angle-right"></i>
                                </div>
                            </div>
                            <div class="settingPanel__container-items__item ar-1px-b">
                                <div class="settingPanel__container-items__title">
                                    <img
                                        src="{{ asset('frontend/assets/images/dashboard/language.png') }}"><span>Language</span>
                                </div>
                                <div class="settingPanel__container-items-right">
                                    <h5 style="display: none;">0</h5><span>English</span>
                                    <i class="las la-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="serviceCenter-wrap">
                        <div class="serviceCenter__container">
                            <h1>Service center</h1>
                            <div class="serviceCenter__container-items">
                                <a href="{{route('user.settings')}}">
                                <div class="serviceCenter__container-items__item">
                                       <img src="{{ asset('frontend/assets/images/dashboard/setting.png') }}">
                                       <span>Settings</span>
                                    </div>
                                </a>
                                <a href="{{route('user.feedback')}}">
                                <div class="serviceCenter__container-items__item">
                                    <img src="{{ asset('frontend/assets/images/dashboard/feedback.png') }}">
                                    <span>Feedback</span>
                                </div>
                                </a>
                                <a href="#">
                                <div class="serviceCenter__container-items__item">
                                    <img src="{{ asset('frontend/assets/images/dashboard/notification2.png') }}">
                                    <span>Notification</span>
                                </div>
                                </a>
                                <a href="{{route('support')}}">
                                <div class="serviceCenter__container-items__item">
                                    <img src="{{ asset('frontend/assets/images/dashboard/serviceCenter.png') }}">
                                    <span>24/7 Customer service</span>
                                </div>
                                </a>
                                <a href="#">
                                <div class="serviceCenter__container-items__item">
                                    <img src="{{ asset('frontend/assets/images/dashboard/beginners-guide.png') }}">
                                    <span>Beginner's Guide</span>
                                </div>
                                </a>
                                <a href="{{route('about')}}">
                                <div class="serviceCenter__container-items__item">
                                    <img src="{{ asset('frontend/assets/images/dashboard/about.png') }}">
                                    <span>About Us</span>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="serviceCenter-wrap-header">
                        <form action="{{ route('user.logout') }}" method="POST">
                            @csrf
                            <button>
                                <img src="{{ asset('frontend/assets/images/dashboard/logout.png') }}" style="margin-right: 5px;"> Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('js')

        <script>

            function refreshWalletAmount(){
                $.ajax({
                    type: 'GET',
                    url: "{{route('get.current.wallet.amount')}}",
                    success: function(data) {
                        $('#current_wallet_amount').text(data.current_wallet_amount)
                    }
                });
            }

        </script>

    @endpush
@endsection
