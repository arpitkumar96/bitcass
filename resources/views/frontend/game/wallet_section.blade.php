<div class="cards">
    <div class="wallet-1">
        <div class="thumg">
            <img src="{{ asset('frontend/assets/images/wallet.png') }}" class="img-fluid" alt="">
        </div>
        <div class="text">
            <h6> Wallet balance</h6>
            <h5>₹{{Auth::guard('web')->user()->total_wallet_amount}} <i class="las la-sync" onclick="refreshWalletSection()"></i></h5>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-6">
            <a href="{{ route('user.wallet.recharge') }}" class="cmn--btn active btn--sm"><i class="las la-user"></i>Deposit</a>
        </div>
        <div class="col-6">
            <a href="{{ route('user.withdrawl') }}" class="cmn--btn active btn--sm float-end"><i class="las la-user"></i>Withdraw</a>
        </div>
    </div>
</div>
