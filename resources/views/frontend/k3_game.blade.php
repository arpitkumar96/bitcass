@extends('frontend.layouts.app')
@section('content')
    <section class="about-section padding-top bg_img padding-bottom overflow-hidden mt-5"
        style="background: url({{ asset('frontend/assets/images/top/bg.png') }});"> <br>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 mb-4" id="wallet_section">
                    <div class="cards">
                        <div class="wallet-1">
                            <div class="thumg">
                                <img src="{{ asset('frontend/assets/images/wallet.png') }}" class="img-fluid" alt="">
                            </div>
                            <div class="text">
                                <h6>Wallet balance</h6>
                                <h5>₹100 <i class="las la-sync"></i></h5>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <a href="#" class="cmn--btn active btn--sm"><i class="las la-user"></i>Deposit</a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="cmn--btn active btn--sm float-end"><i
                                        class="las la-user"></i>Withdraw</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="noticeBar__container" sitemsg=""><svg xmlns="http://www.w3.org/2000/svg" width="48"
                            height="48" viewBox="0 0 48 48" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M41.977 36.5356L41.976 36.5376C41.488 37.7866 40.241 38.3286 39.189 37.7476C38.141 37.1596 37.692 35.6806 38.171 34.4346C39.25 31.7086 39.804 28.5196 39.804 25.1886C39.804 21.3406 39.04 17.6176 37.646 14.6966C37.077 13.4856 37.437 11.9706 38.44 11.2946C39.445 10.6176 40.732 11.0446 41.302 12.2386C43.071 15.9616 44.014 20.4326 43.999 25.1886C43.999 29.2326 43.295 33.1696 41.977 36.5356ZM34.32 32.2426C34.095 32.2426 33.87 32.1896 33.646 32.1006C32.554 31.6596 31.969 30.2506 32.34 28.9526L32.341 28.9476C32.686 27.7366 32.866 26.4716 32.866 25.1706C32.866 23.6386 32.627 22.1786 32.148 20.7886C31.713 19.5066 32.222 18.0636 33.3 17.5466C34.38 17.0476 35.592 17.6536 36.027 18.9366C36.702 20.9136 37.046 23.0156 37.046 25.1886C37.046 27.0416 36.793 28.8406 36.298 30.5686C35.998 31.6016 35.188 32.2426 34.32 32.2426ZM27.461 41.2976C26.664 41.7546 25.802 41.9976 24.923 41.9976C24.114 41.9976 23.317 41.8086 22.575 41.4046C22.535 41.3786 22.481 41.3516 22.44 41.3246L13.396 34.4406H10.278C7.364 34.4406 5 33.0836 5 30.1766V18.7326C5 15.8386 7.362 14.4826 10.264 14.4826H13.382L22.44 7.66557C22.481 7.63857 22.522 7.62557 22.561 7.59857C24.088 6.76357 25.945 6.80457 27.435 7.70657C29.027 8.66257 29.984 10.3716 30.012 12.2706V36.7336C30.012 38.6456 29.055 40.3546 27.461 41.2976Z"
                                fill="url(#paint0_linear_235_31)"></path>
                            <defs>
                                <linearGradient id="paint0_linear_235_31" x1="5" y1="7" x2="5"
                                    y2="40.9996" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#FAE59F"></stop>
                                    <stop offset="1" stop-color="#C4933F"></stop>
                                </linearGradient>
                            </defs>
                        </svg>
                        <div class="noticeBar__container-body">
                            <div class="noticeBar__container-body-text">Please Remember The Upi Id Of
                                Your Payment And Fill In The Correct Utr Number And Amount To Submit. When You Need To
                                Continue Recharging, Please Be Sure To Go To BDGGame To Get A New Upi Account Again!
                                Please
                                Make Sure To Follow The Above Steps So That Your Transactions Can Be Deposited Into Your
                                Account Faster</div>
                        </div>
                        <button>Detail</button>
                    </div>
                </div>
                <div class="col-12">
                    <ul class="bet-history hor-swipe">
                        <li class="bet-item">
                            <label class="bet-megabox d-block mb-3">
                                <input type="radio" name="search_game_category" value="" checked>
                                <span class="d-block p-2 bet-megabox-elem text-center">
                                    <img src="{{ asset('frontend/assets/images/icon/k3.png') }}" class="img-fluid mb-1">
                                    <span class="d-block text-center">
                                        <h5 class="text-white">K3 Lotre <br> 1Min</h5>
                                    </span>
                                </span></label>
                        </li>
                        <li class="bet-item">
                            <label class="bet-megabox d-block mb-3">
                                <input type="radio" name="search_game_category" value="">
                                <span class="d-block p-2 bet-megabox-elem text-center">
                                    <img src="{{ asset('frontend/assets/images/icon/k3.png') }}" class="img-fluid mb-1">
                                    <span class="d-block text-center">
                                        <h5 class="text-white">K3 Lotre <br> 3Min</h5>
                                    </span>
                                </span></label>
                        </li>
                        <li class="bet-item">
                            <label class="bet-megabox d-block mb-3">
                                <input type="radio" name="search_game_category" value="">
                                <span class="d-block p-2 bet-megabox-elem text-center">
                                    <img src="{{ asset('frontend/assets/images/icon/k3.png') }}" class="img-fluid mb-1">
                                    <span class="d-block text-center">
                                        <h5 class="text-white">K3 Lotre <br> 5Min</h5>
                                    </span>
                                </span></label>
                        </li>
                        <li class="bet-item">
                            <label class="bet-megabox d-block mb-3">
                                <input type="radio" name="search_game_category" value="">
                                <span class="d-block p-2 bet-megabox-elem text-center">
                                    <img src="{{ asset('frontend/assets/images/icon/k3.png') }}" class="img-fluid mb-1">
                                    <span class="d-block text-center">
                                        <h5 class="text-white">K3 Lotre <br> 10Min</h5>
                                    </span>
                                </span></label>
                        </li>
                    </ul>
                </div>
                <div class="col-12">
                    <div class="K3TL__C">
                        <div class="K3TL__C-l1">
                            <div class="left">
                                <p>Period</p>
                                <div class="K3TL__C-rule">How to play</div>
                            </div>
                            <p>Time remaining</p>
                        </div>
                        <div class="K3TL__C-l2">
                            <div>20240408090930</div>
                            <div class="K3TL__C-time">
                                <div>0</div>
                                <div>0</div>
                                <div notime="">:</div>
                                <div>2</div>
                                <div>7</div>
                            </div>
                        </div>
                        <div class="K3TL__C-l3">
                            <div class="box">
                                <div class="num3"></div>
                                <div class="num1"></div>
                                <div class="num4"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="K3B__C-nav">
                        <div class="active">Total</div>
                        <div class="">2 same</div>
                        <div class="">3 same</div>
                        <div class="">Different</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="K3B__C-bettingList">
                        <div class="num num3">
                            <div class="ball rball">
                                <div class="K3B__C-odds-bet num3">3</div>
                            </div>
                            <div class="K3B__C-odds-rate">207.36X </div>
                        </div>
                        <div class="num num4">
                            <div class="ball gball">
                                <div class="K3B__C-odds-bet num4">4</div>
                            </div>
                            <div class="K3B__C-odds-rate">69.12X </div>
                        </div>
                        <div class="num num5">
                            <div class="ball rball">
                                <div class="K3B__C-odds-bet num5">5</div>
                            </div>
                            <div class="K3B__C-odds-rate">34.56X </div>
                        </div>
                        <div class="num num6">
                            <div class="ball gball">
                                <div class="K3B__C-odds-bet num6">6</div>
                            </div>
                            <div class="K3B__C-odds-rate">20.74X </div>
                        </div>
                        <div class="num num7">
                            <div class="ball rball">
                                <div class="K3B__C-odds-bet num7">7</div>
                            </div>
                            <div class="K3B__C-odds-rate">13.83X </div>
                        </div>
                        <div class="num num8">
                            <div class="ball gball">
                                <div class="K3B__C-odds-bet num8">8</div>
                            </div>
                            <div class="K3B__C-odds-rate">9.88X </div>
                        </div>
                        <div class="num num9">
                            <div class="ball rball">
                                <div class="K3B__C-odds-bet num9">9</div>
                            </div>
                            <div class="K3B__C-odds-rate">8.3X </div>
                        </div>
                        <div class="num num10">
                            <div class="ball gball">
                                <div class="K3B__C-odds-bet num10">10</div>
                            </div>
                            <div class="K3B__C-odds-rate">7.68X </div>
                        </div>
                        <div class="num num11">
                            <div class="ball rball">
                                <div class="K3B__C-odds-bet num11">11</div>
                            </div>
                            <div class="K3B__C-odds-rate">7.68X </div>
                        </div>
                        <div class="num num12">
                            <div class="ball gball">
                                <div class="K3B__C-odds-bet num12">12</div>
                            </div>
                            <div class="K3B__C-odds-rate">8.3X </div>
                        </div>
                        <div class="num num13">
                            <div class="ball rball">
                                <div class="K3B__C-odds-bet num13">13</div>
                            </div>
                            <div class="K3B__C-odds-rate">9.88X </div>
                        </div>
                        <div class="num num14">
                            <div class="ball gball">
                                <div class="K3B__C-odds-bet num14">14</div>
                            </div>
                            <div class="K3B__C-odds-rate">13.83X </div>
                        </div>
                        <div class="num num15">
                            <div class="ball rball">
                                <div class="K3B__C-odds-bet num15">15</div>
                            </div>
                            <div class="K3B__C-odds-rate">20.74X </div>
                        </div>
                        <div class="num num16">
                            <div class="ball gball">
                                <div class="K3B__C-odds-bet num16">16</div>
                            </div>
                            <div class="K3B__C-odds-rate">34.56X </div>
                        </div>
                        <div class="num num17">
                            <div class="ball rball">
                                <div class="K3B__C-odds-bet num17">17</div>
                            </div>
                            <div class="K3B__C-odds-rate">69.12X </div>
                        </div>
                        <div class="num num18">
                            <div class="ball gball">
                                <div class="K3B__C-odds-bet num18">18</div>
                            </div>
                            <div class="K3B__C-odds-rate">207.36X </div>
                        </div>
                        <div class="num numA">
                            <div class="">Big</div>
                            <div class="K3B__C-odds-rate">1.92X </div>
                        </div>
                        <div class="num numB">
                            <div class="">Small</div>
                            <div class="K3B__C-odds-rate">1.92X </div>
                        </div>
                        <div class="num numC">
                            <div class="">Odd</div>
                            <div class="K3B__C-odds-rate">1.92X </div>
                        </div>
                        <div class="num numD">
                            <div class="">Even</div>
                            <div class="K3B__C-odds-rate">1.92X </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="K3B__C-betting2">
                        <div class="K3B__C-betting2-tip1">2 matching numbers: odds<span>(13.83)</span>
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div class="K3B__C-betting2-line1 mb30">
                            <div class="">
                                <div>11</div>
                            </div>
                            <div class="">
                                <div>22</div>
                            </div>
                            <div class="">
                                <div>33</div>
                            </div>
                            <div class="">
                                <div>44</div>
                            </div>
                            <div class="">
                                <div>55</div>
                            </div>
                            <div class="">
                                <div>66</div>
                            </div>
                        </div>
                        <div class="K3B__C-betting2-tip1">A pair of unique numbers: odds<span>(69.12)</span>
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div class="K3B__C-betting2-line2">
                            <div class="">
                                <div class="">11</div>
                            </div>
                            <div class="">
                                <div class="">22</div>
                            </div>
                            <div class="">
                                <div class="">33</div>
                            </div>
                            <div class="">
                                <div class="">44</div>
                            </div>
                            <div class="">
                                <div class="">55</div>
                            </div>
                            <div class="">
                                <div class="">66</div>
                            </div>
                        </div>
                        <div class="K3B__C-betting2-line3">
                            <div class="">
                                <div class="">1</div>
                            </div>
                            <div class="">
                                <div class="">2</div>
                            </div>
                            <div class="">
                                <div class="">3</div>
                            </div>
                            <div class="">
                                <div class="">4</div>
                            </div>
                            <div class="">
                                <div class="">5</div>
                            </div>
                            <div class="">
                                <div class="">6</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="K3B__C-betting3">
                        <div class="K3B__C-betting3-tip1">3 of the same number: odds <span>(207.36)</span><i
                                class="fas fa-question-circle"></i><!----><!----><!----></i></div>
                        <div class="K3B__C-betting3-line1 mb30">
                            <div class="">
                                <div>111</div>
                            </div>
                            <div class="">
                                <div>222</div>
                            </div>
                            <div class="">
                                <div>333</div>
                            </div>
                            <div class="">
                                <div>444</div>
                            </div>
                            <div class="">
                                <div>555</div>
                            </div>
                            <div class="">
                                <div>666</div>
                            </div>
                        </div>
                        <div class="K3B__C-betting3-tip1">Any 3 of the same number: odds <span>(34.56)</span><i
                                class="van-badge__wrapper van-icon van-icon-question icon"
                                style="color: rgb(217, 172, 79); font-size: 16px;"><!----><!----><!----></i></div>
                        <div class="K3B__C-betting3-btn">Any 3 of the same number: odds</div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="K3B__C-betting4">
                        <div class="K3B__C-betting4-tip1">3 different numbers: odds <span>(34.56)</span><i
                                class="fas fa-question-circle"></i></div>
                        <div class="K3B__C-betting4-line1 mb30">
                            <div class="">
                                <div>1</div>
                            </div>
                            <div class="">
                                <div>2</div>
                            </div>
                            <div class="">
                                <div>3</div>
                            </div>
                            <div class="">
                                <div>4</div>
                            </div>
                            <div class="">
                                <div>5</div>
                            </div>
                            <div class="">
                                <div>6</div>
                            </div>
                        </div>
                        <div class="K3B__C-betting4-tip1">3 continuous numbers: odds <span>(8.64)</span><i
                                class="fas fa-question-circle"></i></div>
                        <div class="K3B__C-betting4-btn">3 continuous numbers</div>
                        <div class="K3B__C-betting4-tip1">2 different numbers: odds <span>(6.91)</span><i
                                class="van-badge__wrapper van-icon van-icon-question icon"
                                style="color: rgb(217, 172, 79); font-size: 16px;"><!----><!----><!----></i></div>
                        <div class="K3B__C-betting4-line1">
                            <div class="">
                                <div>1</div>
                            </div>
                            <div class="">
                                <div>2</div>
                            </div>
                            <div class="">
                                <div>3</div>
                            </div>
                            <div class="">
                                <div>4</div>
                            </div>
                            <div class="">
                                <div>5</div>
                            </div>
                            <div class="">
                                <div>6</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="RecordNav__C">
                        <div class="active">Game history</div>
                        <div class="">Chart</div>
                        <div class="">My history</div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="GameRecord__C">
                        <div class="GameRecord__C-head">
                            <div class="van-row">
                                <div class="van-col van-col--10">Period</div>
                                <div class="van-col van-col--4">Sum</div>
                                <div class="van-col van-col--10">Results</div>
                            </div>
                        </div>
                        <div class="GameRecord__C-body">
                            <div class="van-row">
                                <div class="van-col van-col--8">20240409120083</div>
                                <div class="van-col van-col--1"><span>6</span></div>
                                <div class="van-col van-col--4"><span>Small</span></div>
                                <div class="van-col van-col--4"><span>Even</span></div>
                                <div class="van-col van-col--6">
                                    <div class="GameRecord__C-body-premium">
                                        <div class="n1"></div>
                                        <div class="n2"></div>
                                        <div class="n3"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="van-row">
                                <div class="van-col van-col--8">20240409120082</div>
                                <div class="van-col van-col--1"><span>8</span></div>
                                <div class="van-col van-col--4"><span>Small</span></div>
                                <div class="van-col van-col--4"><span>Even</span></div>
                                <div class="van-col van-col--6">
                                    <div class="GameRecord__C-body-premium">
                                        <div class="n2"></div>
                                        <div class="n5"></div>
                                        <div class="n1"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="van-row">
                                <div class="van-col van-col--8">20240409120074</div>
                                <div class="van-col van-col--1"><span>9</span></div>
                                <div class="van-col van-col--4"><span>Small</span></div>
                                <div class="van-col van-col--4"><span>Odd</span></div>
                                <div class="van-col van-col--6">
                                    <div class="GameRecord__C-body-premium">
                                        <div class="n5"></div>
                                        <div class="n1"></div>
                                        <div class="n3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="Trend__C">
                        <div class="Trend__C-head">
                            <div class="van-row">
                                <div class="van-col van-col--8">Period</div>
                                <div class="van-col van-col--6">Results</div>
                                <div class="van-col van-col--10">Number</div>
                            </div>
                        </div>
                        <div class="Trend__C-body">
                            <div class="van-row">
                                <div class="van-col van-col--8">20240409090859</div>
                                <div class="van-col van-col--6">
                                    <div class="Trend__C-body-premium">
                                        <div class="n3"></div>
                                        <div class="n4"></div>
                                        <div class="n2"></div>
                                    </div>
                                </div>
                                <div class="van-col van-col--10">
                                    <div class="Trend__C-body-gameText"><span>3
                                            consecutive numbers</span></div>
                                </div>
                            </div>
                            <div class="van-row">
                                <div class="van-col van-col--8">20240409090851</div>
                                <div class="van-col van-col--6">
                                    <div class="Trend__C-body-premium">
                                        <div class="n6"></div>
                                        <div class="n4"></div>
                                        <div class="n6"></div>
                                    </div>
                                </div>
                                <div class="van-col van-col--10">
                                    <div class="Trend__C-body-gameText"><span>2
                                            same numbers</span></div>
                                </div>
                            </div>
                            <div class="van-row">
                                <div class="van-col van-col--8">20240409090850</div>
                                <div class="van-col van-col--6">
                                    <div class="Trend__C-body-premium">
                                        <div class="n4"></div>
                                        <div class="n4"></div>
                                        <div class="n2"></div>
                                    </div>
                                </div>
                                <div class="van-col van-col--10">
                                    <div class="Trend__C-body-gameText"><span>2
                                            same numbers</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">

                </div>
            </div>

            <br><br><br>
    </section>
@endsection
