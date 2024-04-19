@extends('frontend.layouts.app')
@section('content')
    <section class="about-section padding-top bg_img padding-bottom overflow-hidden mt-5" style="background: url({{ asset('frontend/assets/images/top/bg.png') }});"> <br>
        <div class="container">
            <div class="row">
                <div class="promotion">
                    {{-- <div class="airdrop">
                        <a href="#">
                            <h4>Your Airdrop...... (n) BTS Token</h4>
                            <p>Listing Soon @1$ price</p>
                        </a>
                    </div> --}}
                    <a href="#" class="w-100">
                        <div class="promote__cell-item">
                            <div class="label">
                                <img src="{{ asset('frontend/assets/images/bitcoin-btc-logo.png') }}" alt=""><span>Your Airdrop BTS Token</span>
                                <p class="soon">Listing Soon @1$ price</p>
                            </div>
                            <div class="arrow">
                                <span>15</span>
                                <img src="http://127.0.0.1:8000/frontend/assets/images/pramotion/arrow.png" alt="">
                            </div>
                        </div>
                    </a>
                    <div class="amount">{{$total_yesterday_commission}}</div>
                    <div class="amount_txt">Yesterday's total commission</div>
                    <div class="tip">Upgrade the level to increase commission income</div>
                    <div class="info_content">
                        <div class="info">
                            <div class="head">Direct subordinates</div>
                            <div class="line1">
                                <div>{{ $total_direct_subordinate }}</div> number of register
                            </div>
                            <div class="line2">
                                <div>{{$total_direct_deposite_count}}</div> Deposit number
                            </div>
                            <div class="line3">
                                <div>{{$total_direct_deposite_amount}}</div> Deposit amount
                            </div>
                            {{-- <div class="line1">
                                <div>0</div> Number of people making first deposit
                            </div> --}}
                        </div>
                        <div class="info">
                            <div class="head u2">Team subordinates</div>
                            <div class="line1">
                                <div>{{$total_indirect_subordinate}}</div> number of register
                            </div>
                            <div class="line2">
                                <div>0</div> Deposit number
                            </div>
                            <div class="line3">
                                <div>0</div> Deposit amount
                            </div>
                            {{-- <div class="line1">
                                <div>0</div> Number of people making first deposit
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="shareBtnContainer"><a href="{{route('user.pramotion.share')}}" class="shareBtn">Invitation Links</a></div>
                    <div class="promote__cell">
                        <a href="#">
                            <div class="promote__cell-item">
                                <div class="label">
                                    <img src="{{ asset('frontend/assets/images/pramotion/copy_code.png') }}" alt=""><span>Copy invitation code</span>
                                </div>
                                <div class="arrow" onclick="copyTextCode('{{Auth::guard('web')->user()->user_id}}')">
                                    <span>{{Auth::guard('web')->user()->user_id}}</span>
                                    <img src="{{ asset('frontend/assets/images/pramotion/arrow.png') }}" alt="">
                                </div>
                            </div>
                        </a>
                        <a href="{{route('user.team.report')}}">
                            <div class="promote__cell-item">
                                <div class="label">
                                    <img src="{{ asset('frontend/assets/images/pramotion/team_port.png') }}" alt=""><span>Subordinate data</span>
                                </div>
                                <div class="arrow">
                                    <img src="{{ asset('frontend/assets/images/pramotion/arrow.png') }}" alt="">
                                </div>
                            </div>
                        </a>
                        <a href="{{route('commission')}}">
                            <div class="promote__cell-item">
                                <div class="label">
                                    <img src="{{ asset('frontend/assets/images/pramotion/commission.png') }}" alt=""><span>Commission detail</span>
                                </div>
                                <div class="arrow">
                                    <img src="{{ asset('frontend/assets/images/pramotion/arrow.png') }}" alt="">
                                </div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="promote__cell-item">
                                <div class="label">
                                    <img src="{{ asset('frontend/assets/images/pramotion/invite_reg.png') }}" alt=""><span>Invitation rules</span>
                                </div>
                                <div class="arrow">
                                    <img src="{{ asset('frontend/assets/images/pramotion/arrow.png') }}" alt="">
                                </div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="promote__cell-item">
                                <div class="label">
                                    <img src="{{ asset('frontend/assets/images/pramotion/server.png') }}" alt=""><span>Agent line customer service</span>
                                </div>
                                <div class="arrow">
                                    <img src="{{ asset('frontend/assets/images/pramotion/arrow.png') }}" alt="">
                                </div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="promote__cell-item">
                                <div class="label">
                                    <img src="{{ asset('frontend/assets/images/pramotion/rebateRatio.png') }}" alt=""><span>Rebate ratio</span>
                                </div>
                                <div class="arrow">
                                    <img src="{{ asset('frontend/assets/images/pramotion/arrow.png') }}" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="commission">
                        <div class="commission__title">
                            <i class="van-badge__wrapper van-icon">
                                <img class="van-icon__image" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAOSSURBVHgB7ZnPTxNBFMffbFtK+VFLPfRAE4tatUYJ0AMmSKzxghddIHgV/wLSvwC4ebLyF8DRRIH1ZExMLOpBDhhEYxObQE3qgQsQsLTSMuPMak23ne1u2ZbtYT8JtJ15b/q+M5k3O68AFhYWFhYGQNU6Y6LHA0JmEpBwCwjpAyAe6uKBukD2AKEUHS8FBL+EFls8+iyXghpRFfBk3DmFCJ6pX8CapOh3zUWXfj+txcnGa4yNtUxTZY/pgK1werCJGhkJ2eB14nhFr1PFCsTGHJO0eR7MRBBuR1/k4rpMK1oQmgKzIWRar6liBWJiawAEvAXNAHb0R6XMupaZcgVsuA+ahGBfIPZ9UZxMLIuBanZKAQSaRgCNJUIImRcwecuEqJmVCwiAAewtDvD6zsp/7L0RspksFGNiQpKL97j7wq41kKvDBf4eP6S30pD9leXasGCvDoTAf75b0Z7e/AnJr0lVP7fXDb5uX9Wxi2CCZhLPxZXQhBQvbRdAg/BwGILXL8LNkSFuPxM4fHeoIngGa7txZ1B1NcLDA/LYvYO9oAcbqsxOmgLcXZ3yq0MliOC1ILjaXar+rI+tDq+96NfWoe5fCgGIlG9qTQHVYKJ4M18OszG6J4rYMERKPxsS0Nnl1m1bXEmjEKxMNIYEmAES4FzpZ0MCDnb3ddvu7x5AIzAkIH+Ul1OlFsymQG0bgaaA4swdZvh5OvEpodpX9Et+SVa0F/IFKqogv88bEKd5kK29W6NZxA/b6W1uP/vy1TerNJ8HuQfZt7UEDTbP9Xv/6oM8dnozDSdFU0BWZQbLbTY+bsjBur1/s83+zgE38FrH1kIpALFr3clhAe9s70A9qHY4llK2B0gKmoSTCcC2ODQJbp2HpEJAVKJlDYTiYDIseL0nN+9OPAsmE7gc0G1bIeBfNcA0Ebx0XA3uQRZdOpqhXY/kqtkpIV+KwiH5flAN+jD3Q+GnZhhdyi3Q0qIEQk50Ou0PnW2tkTw9ObOZQ6gHrvY2+dXr88IZTyf4L/jB7tA8lgALylSPQAfsEiEck6YotyCM+i89kP6XW3Q9zIVGpRQC87MTZb00eIbup9FjAqZnJ4zQXHmbbgGsGkArA6aJwITMhsalhfJ2XXuglAQtMglAqwMGa0g1sEfoxF2ZkLhl95oFMLaWRU8Og0iX7z5ihSf5h4+6CUqxf4g+EWCAz04BFnpGpT2wsLCwsGgEfwCZpjPHkp2MDwAAAABJRU5ErkJggg==">
                            </i>
                            <span>Promotion data</span>
                        </div>
                        <div class="commission__body">
                            <div>
                                <span>0</span>
                                <span>This Week</span>
                            </div><span></span>
                            <div>
                                <span>0</span>
                                <span>Total commission</span>
                            </div>
                        </div>
                        <div class="commission__body">
                            <div>
                                <span>0</span>
                                <span>direct subordinate</span>
                            </div><span></span>
                            <div>
                                <span>0</span>
                                <span>Total number of subordinates in the team</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br><br>
    </section>

    @push('js')

        <script>

            function copyTextCode(text) {
                navigator.clipboard.writeText(text);
                $('.preloader').show();
                $('#loader_text').text('Invite Code Copied Successfully!');
                setTimeout(function() {
                    $('.preloader').hide();
                    $('#loader_text').text('Loading...');
                }, 1000);
            }

        </script>

    @endpush
@endsection
