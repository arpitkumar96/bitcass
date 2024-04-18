@extends('frontend.layouts.app')
@section('content')
<style>
    .van-cell {
        padding: 0;
    }
</style>
    <!-- About Section Starts Here -->
    <section class="about-section padding-top bg_img padding-bottom overflow-hidden mt-5" style="background: url({{ asset('frontend/assets/images/top/bg.png') }});"> <br>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 mb-4">
                    <div class="balance-card">
                        <h6>
                            <img src="{{ asset('frontend/assets/images/balance.png') }}" class="img-fluid mb-2" alt="" style="width: 20px;">
                            Available balance
                        </h6>
                        <h3>₹{{ $available_balance }}</h3>
                        <div class="row mt-3">
                            <div class="col-6">
                                <img src="{{ asset('frontend/assets/images/chip.png') }}" alt="" class="img-fluid mb-2" style="width: 30px;">
                            </div>
                            <div class="col-6">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="recharge_container_active text-center">
                        <div class="recharge_img">
                            <img class="img" src="{{ asset('frontend/assets/images/withdrawl.png') }}" alt="">
                        </div>
                        <p class="recharge_content">Bank Card </p>
                    </div>
                </div>
                {{-- <div class="col-4">
                    <div class="recharge_container text-center">
                        <div class="recharge_img">
                            <img class="img" src="{{ asset('frontend/assets/images/USDT.png') }}" alt="">
                        </div>
                        <p class="recharge_content">USDT </p>
                    </div>
                </div> --}}
            </div>
            <div class="row">

                <div class="addWithdrawType mt-3">
                    <a class="addWithdrawType-dtls">
                        @if(Auth::guard('web')->user()->bankDetail)
                            <p><b>Bank Name: </b>{{Auth::guard('web')->user()->bankDetail->bank_name}}</p>
                            <p><b>Account Number: </b>{{Auth::guard('web')->user()->bankDetail->account_number}}</p>
                            <p><b>Phone Number: </b>{{Auth::guard('web')->user()->bankDetail->phone_number}}</p>
                            <p><b>Email: </b>{{Auth::guard('web')->user()->bankDetail->email}}</p>
                            <p><b>IFSC Code: </b>{{Auth::guard('web')->user()->bankDetail->ifsc_code}}</p>
                        @endif
                    </a>
                </div>

                <div class="addWithdrawType mt-3">
                    <a href="{{route('user.bank.detail')}}" class="addWithdrawType-top">
                        {{-- @if(Auth::guard('web')->user()->bankDetail)
                            <b>Bank Name: </b>{{Auth::guard('web')->user()->bankDetail->bank_name}}
                            <b>Account Number: </b>{{Auth::guard('web')->user()->bankDetail->account_number}}
                            <b>Phone Number: </b>{{Auth::guard('web')->user()->bankDetail->phone_number}}
                            <b>Email: </b>{{Auth::guard('web')->user()->bankDetail->email}}
                            <b>IFSC Code: </b>{{Auth::guard('web')->user()->bankDetail->ifsc_code}}
                        @endif --}}
                        <img src="{{ asset('frontend/assets/images/dashboard/add.png') }}">
                        <span>Add address</span>
                    </a>
                    <div class="addWithdrawType-text">Need to add beneficiary information to be able to withdraw money</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="explain usdt">
                        <div class="head">
                            <img src="{{ asset('frontend/assets/images/dashboard/usdt.png') }}">
                            <h1>Select amount of INR</h1>
                        </div>
                        <form action="{{route('user.withdrawl.request')}}" method="POST">
                            @csrf
                            <div class="Recharge__content-paymoney__money-input">
                                <div class="place-div">₹</div>
                                <div class="van-cell van-field amount-input">
                                    <div class="van-cell__value van-field__value">
                                        <div class="van-field__body">
                                            <input type="number" class="form-control" name="withdrawal_amount" placeholder="Please enter withdrawal amount">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('withdrawal_amount')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            {{-- <div class="balance usdt">
                                <div>
                                    <span>Withdrawable balance
                                        <h6 class="yellow">₹0.00</h6>
                                    </span>
                                    <input type="button" value="All">
                                </div>
                            </div> --}}
                            <button class="btn btn-success w-100 mt-3 mb-3">Withdraw</button>
                        </form>
                        <div class="Recharge__container-intro p-0">
                            <div class="Recharge__container-intro__lists">
                                <div class="item">
                                    <p>Need to bet <span>₹494.00</span> to be able to withdraw</p>
                                    <p>Withdraw time <span>00:00-23:59</span></p>
                                    <p>Inday Remaining Withdrawal Times<span>5</span></p>
                                    <p>Withdrawal amount range <span>₹1,000.00-₹10,000,000.00</span></p>
                                    <p>After withdraw, you need to confirm the blockchain main network 3 times before it arrives at your account.</p>
                                    <p>Please confirm that the operating environment is safe to avoid information being tampered with or leaked.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rechargeh__container">
                        <div class="rechargeh__container-head ">
                            <img src="{{ asset('frontend/assets/images/dashboard/history.png') }}">
                            <h1>Withdrawal history</h1>
                        </div>
                        @forelse($withdrawal_requests as $withdrawal_request)
                            <div class="record__main-info">
                                <div class="record__main-info__title flex_between">
                                    <div class="recharge_text">Withdrawal</div>
                                    <div class="flex_between">
                                        <div class="fail">{{ucwords($withdrawal_request->status)}}</div>
                                    </div>
                                </div>
                                <div class="record__main-info__money item flex_between">
                                    <span>Amount</span><span>₹{{$withdrawal_request->amount}}</span>
                                </div>
                                {{-- <div class="record__main-info__type item flex_between">
                                    <span>Type</span><span>TYpay-QR</span>
                                </div> --}}
                                <div class="record__main-info__time item flex_between">
                                    <span>Time</span><span>{{$withdrawal_request->created_at->format('d-m-Y h:i A')}}</span></div>
                                <div class="record__main-info__orderNumber item flex_between"><span>क्रम संख्या</span>
                                    <div>
                                        <span>{{$withdrawal_request->withdrawal_request_id}}</span>
                                        {{-- <img src="{{ asset('frontend/assets/images/dashboard/copy.png') }}"
                                            alt=""> --}}
                                    </div>
                                </div>
                                <div class="record__main-info__orderNumber item flex_between"><span>Remark</span>
                                    <div>
                                        <span>{{$withdrawal_request->remark}}</span>
                                        {{-- <img src="{{ asset('frontend/assets/images/dashboard/copy.png') }}"
                                            alt=""> --}}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="rechargeh__container-content">
                                <div class="empty__container text-center">
                                    <img src="{{ asset('frontend/assets/images/empty-ea102850.png') }}">
                                    <p>No data</p>
                                </div>
                            </div>
                        @endforelse
                        {{-- <div class="rechargeh__container-footer text-center mt-2">
                            <button>All Records</button>
                        </div> --}}
                    </div>
                </div>
            </div>
            <br><br>
    </section>
@endsection
