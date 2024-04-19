<div class="tab-content">
    <div id="home" class="tab-pane active">
        <div class="row mt-3">
            <div class="col-12 col-md-12 m-auto">
                <div class="row m-0 TimeLeft__C">
                    <div class="col-6 p-2">
                        <div class="text-center">
                            <p class="btn-br">
                                <a data-bs-toggle="modal" data-bs-target="#Modal" style="cursor: pointer;">How to
                                    play</a>
                            </p>
                            <p class="mt-2" style="text-align:left">{{ $game->name }}</p>
                        </div>
                        <div class="TimeLeft__C-num mt-2">
                            <div class="n1"></div>
                            <div class="n2"></div>
                            <div class="n3"></div>
                            <div class="n4"></div>
                            <div class="n5"></div>
                        </div>
                    </div>
                    <div class="col-6 p-2">
                        <p class="text-end">Time remaining</p>
                        <div class="TimeLeft__C-time Timer">
                            <div class="countdown"></div>
                        </div><br>
                        <p class="text-end"><b>{{ $start_game->start_game_id }}</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="box-1">

            <div class="Betting__C-head">
                <div class="Betting__C-head-g">
                    <a class="cursor-pointer" onclick="getSelectedData('color','green')">Green</a>
                </div>
                <div class="Betting__C-head-p">
                    <a class="cursor-pointer" onclick="getSelectedData('color','violet')">Violet</a>
                </div>
                <div class="Betting__C-head-r">
                    <a class="cursor-pointer" onclick="getSelectedData('color','red')">Red</a>
                </div>
            </div>
            <div class="Betting__C-numC">
                <div class="item0">
                    <a class="cursor-pointer" onclick="getSelectedData('number','0')"> <img
                            src="{{ asset('frontend/assets/images/icon/n0.png') }}" alt=""></a>
                </div>
                <div class="item1">
                    <a class="cursor-pointer" onclick="getSelectedData('number','1')"><img
                            src="{{ asset('frontend/assets/images/icon/n1.png') }}" alt=""></a>
                </div>
                <div class="item2">
                    <a class="cursor-pointer" onclick="getSelectedData('number','2')"><img
                            src="{{ asset('frontend/assets/images/icon/n2.png') }}" alt=""></a>
                </div>
                <div class="item3">
                    <a class="cursor-pointer" onclick="getSelectedData('number','3')"><img
                            src="{{ asset('frontend/assets/images/icon/n3.png') }}" alt=""></a>
                </div>
                <div class="item4">
                    <a class="cursor-pointer" onclick="getSelectedData('number','4')"><img
                            src="{{ asset('frontend/assets/images/icon/n4.png') }}" alt=""></a>
                </div>
                <div class="item5">
                    <a class="cursor-pointer" onclick="getSelectedData('number','5')"><img
                            src="{{ asset('frontend/assets/images/icon/n5.png') }}" alt=""></a>
                </div>
                <div class="item6">
                    <a class="cursor-pointer" onclick="getSelectedData('number','6')"><img
                            src="{{ asset('frontend/assets/images/icon/n6.png') }}" alt=""></a>
                </div>
                <div class="item7">
                    <a class="cursor-pointer" onclick="getSelectedData('number','7')"><img
                            src="{{ asset('frontend/assets/images/icon/n7.png') }}" alt=""></a>
                </div>
                <div class="item8">
                    <a class="cursor-pointer" onclick="getSelectedData('number','8')"><img
                            src="{{ asset('frontend/assets/images/icon/n8.png') }}" alt=""></a>
                </div>
                <div class="item9">
                    <a class="cursor-pointer" onclick="getSelectedData('number','9')"><img
                            src="{{ asset('frontend/assets/images/icon/n9.png') }}" alt=""></a>
                </div>
            </div>
            <div class="Betting__C-multiple">
                <div class="Betting__C-multiple-l">Random</div>
                <div class="Betting__C-multiple-r rn">
                    <input type="radio" class="btn-check" name="quantity" value="1" id="option1"
                        autocomplete="off" checked>
                    <label class="btn btn-secondary" for="option1">X1</label>

                    <input type="radio" class="btn-check" name="quantity" value="5" id="option2"
                        autocomplete="off">
                    <label class="btn btn-secondary" for="option2">X5</label>

                    <input type="radio" class="btn-check" name="quantity" value="10" id="option3"
                        autocomplete="off">
                    <label class="btn btn-secondary" for="option3">X10</label>

                    <input type="radio" class="btn-check" name="quantity" value="20" id="option4"
                        autocomplete="off">
                    <label class="btn btn-secondary" for="option4">X20</label>

                    <input type="radio" class="btn-check" name="quantity" value="50" id="option5"
                        autocomplete="off">
                    <label class="btn btn-secondary" for="option5">X50</label>

                    <input type="radio" class="btn-check" name="quantity" value="100" id="option6"
                        autocomplete="off">
                    <label class="btn btn-secondary" for="option6">X100</label>

                    <input type="radio" class="btn-check" name="quantity" value="1000" id="option7"
                        autocomplete="off">
                    <label class="btn btn-secondary" for="option7">X1000</label>
                </div>
            </div>
            <div class="Betting__C-foot">
                <div class="Betting__C-foot-b">
                    <a class="cursor-pointer" onclick="getSelectedData('size','big')"> Up </a>
                </div>
                <div class="Betting__C-foot-s">
                    <a class="cursor-pointer" onclick="getSelectedData('size','small')">Down </a>
                </div>
            </div>

            <div class="preloader-gif d-none" id="5min_loader">
                <div class="gif-ldr">
                    <img src="" alt="" style="width: 330px;height: 265px;" id="timer_image">
                </div>
            </div>

        </div>
    </div>
    <div class="col-12 mt-3">
        <ul class="withdrawls-history hor-swipe">
            <li class="withdrawls-item">
                <label class="withdrawls-megabox d-block">
                    <input type="radio" name="nav_menu" onclick="getGameHistory('{{ $game->id }}')" checked>
                    <span class="d-block p-2 withdrawls-megabox-elem">
                     Game history
                    </span>
                </label>
            </li>
            <li class="withdrawls-item">
                <label class="withdrawls-megabox d-block">
                    <input type="radio" name="nav_menu" onclick="getGameChart('{{ $game->id }}')">
                    <span class="d-block p-2 withdrawls-megabox-elem">
                      Charts
                    </span>
                </label>
            </li>
            <li class="withdrawls-item">
                <label class="withdrawls-megabox d-block">
                    <input type="radio" name="nav_menu" onclick="getUserGameHistory('{{ $game->id }}')">
                    <span class="d-block p-2 withdrawls-megabox-elem">
                     My history
                    </span>
                </label>
            </li>
        </ul>

        <embed src="{{ asset('backend/assets/second-hand-149907.mp3') }}" loop="true" autostart="true"
            width="2" height="0" id="audio_div" class="d-none">

        <div class="row mt-2">
            <div class="table-responsive" id="history_div">
                @include('frontend.game.game_history')
            </div>
        </div>
    </div>
</div>
</div><br><br>

{{-- How to Play Content start --}}
<div class="modals fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-contents">
            <div class="modal-headers">
                <h3 class="modal-title" id="exampleModalLabel" style="text-align:center !important;">How to play</h3>
            </div>
            <div class="modal-body">
                {!! $game->how_to_play !!}
            </div>
            <div class="modal-footers text-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- How to Play Content End --}}

<input type="hidden" name="final_type" id="final_type">
<input type="hidden" name="final_data" id="final_data">

{{-- Modal Start --}}
<div class="modal fade p-0" id="final_form" tabindex="-1" style="overflow: hidden">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="Popup-11">
                    <div class="Popup-head">
                        <div class="Popup-head-title">{{ $game->name }}</div>
                        <div class="Popup-head-selectName"><span>Select</span><span id="selection"></span></div>
                    </div>
                    <div class="Popup-body">
                        <div class="Popup-body-line">Balance
                            {{-- <div class="Popup-body-line-list">
                                <div class="Popup-body-line-item bgcolor">1</div>
                                <div class="Popup-body-line-item">10</div>
                                <div class="Popup-body-line-item">100</div>
                                <div class="Popup-body-line-item">1000</div>
                            </div> --}}
                            <div class="Betting__C-multiple-r">
                                <input type="radio" class="btn-check" name="balance" value="1"
                                    id="balance1" autocomplete="off" checked onclick="calculateFinalAmount()">
                                <label class="btn btn-secondary" for="balance1">1</label>

                                <input type="radio" class="btn-check" name="balance" value="10"
                                    id="balance10" autocomplete="off" onclick="calculateFinalAmount()">
                                <label class="btn btn-secondary" for="balance10">10</label>

                                <input type="radio" class="btn-check" name="balance" value="100"
                                    id="balance100" autocomplete="off" onclick="calculateFinalAmount()">
                                <label class="btn btn-secondary" for="balance100">100</label>

                                <input type="radio" class="btn-check" name="balance" value="1000"
                                    id="balance1000" autocomplete="off" onclick="calculateFinalAmount()">
                                <label class="btn btn-secondary" for="balance1000">1000</label>
                            </div>
                        </div>
                        <div class="Popup-body-line">Quantity <div class="Popup-body-line-btnL">
                                {{-- <div class="Popup-btn reduce bgcolor"></div>
                                <div class="van-cell van-field Popup-input">
                                    <div class="van-cell__value van-field__value">
                                        <div class="van-field__body">
                                            <input type="text" inputmode="numeric" class="van-field__control">
                                        </div>
                                    </div>
                                </div>
                                <div class="Popup-btn bgcolor"></div> --}}
                                <button class="Popup-btn reduce bgcolor" data-decrease>-</button>
                                <input data-value type="text" value="1" id="final_quantity" disabled
                                    class="van-field__control" />
                                <button class="Popup-btn bgcolor" data-increase>+</button>
                            </div>
                        </div>
                        <div class="Popup-body-line">
                            <div></div>
                            <div class="Popup-body-line-list">
                                {{-- <div class="Popup-body-line-item bgcolor"> X1</div>
                                <div class="Popup-body-line-item"> X5</div>
                                <div class="Popup-body-line-item"> X10</div>
                                <div class="Popup-body-line-item"> X20</div>
                                <div class="Popup-body-line-item"> X50</div>
                                <div class="Popup-body-line-item"> X100</div> --}}
                                <div class="Betting__C-multiple-r">
                                    <input type="radio" class="btn-check" name="final_qty_select" value="1"
                                        id="final_qty_select1" autocomplete="off" onclick="changeQty('1')">
                                    <label class="btn btn-secondary" for="final_qty_select1">X1</label>

                                    <input type="radio" class="btn-check" name="final_qty_select" value="5"
                                        id="final_qty_select5" autocomplete="off" onclick="changeQty('5')">
                                    <label class="btn btn-secondary" for="final_qty_select5">X5</label>

                                    <input type="radio" class="btn-check" name="final_qty_select" value="10"
                                        id="final_qty_select10" autocomplete="off" onclick="changeQty('10')">
                                    <label class="btn btn-secondary" for="final_qty_select10">X10</label>

                                    <input type="radio" class="btn-check" name="final_qty_select" value="20"
                                        id="final_qty_select20" autocomplete="off" onclick="changeQty('20')">
                                    <label class="btn btn-secondary" for="final_qty_select20">X20</label>

                                    <input type="radio" class="btn-check" name="final_qty_select" value="50"
                                        id="final_qty_select50" autocomplete="off" onclick="changeQty('50')">
                                    <label class="btn btn-secondary" for="final_qty_select50">X50</label>

                                    <input type="radio" class="btn-check" name="final_qty_select" value="100"
                                        id="final_qty_select100" autocomplete="off" onclick="changeQty('100')">
                                    <label class="btn btn-secondary" for="final_qty_select100">X100</label>

                                    <input type="radio" class="btn-check" name="final_qty_select" value="1000"
                                        id="final_qty_select1000" autocomplete="off" onclick="changeQty('1000')">
                                    <label class="btn btn-secondary" for="final_qty_select1000">X1000</label>
                                </div>
                            </div>
                        </div>
                        <div class="Popup-body-line"><span class="Popup-agree active">I agree</span><span
                                class="Popup-preSaleShow">《Pre-sale rules》</span>
                        </div>
                    </div>
                    <div class="Popup-foot">
                        <div class="Popup-foot-c" onclick="resetFinalData()">Cancel</div>
                        <div class="Popup-foot-s bgcolor" onclick="finalSubmit()">Total amount ₹ <span
                                id="final_amount"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Modal End --}}

{{-- Start Winning Model --}}
<div class="modals fade" id="winning_modal" tabindex="-1" aria-labelledby="winning_modal_label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-contents">
            <div class="modal-body">
                @if (optional($last_game_participation)->is_win == '1')
                    <div class="WinningTip__C">
                        <div class="WinningTip__C-body">
                            <div class="WinningTip__C-body-l1">Congratulations</div>
                            <div class="WinningTip__C-body-l2 type1">Lottery results
                                <div class="colorW">
                                    {{ optional(optional($last_game_participation)->startGame)->winning_color }}</div>
                                <div class="WinningNum">
                                    {{ optional(optional($last_game_participation)->startGame)->winning_number }}</div>
                                <div class="colorW">
                                    {{ optional(optional($last_game_participation)->startGame)->winning_size }}</div>
                            </div>
                            <div class="WinningTip__C-body-l3">
                                <div class="head">Bonus</div>
                                <div class="bonus">₹ {{ optional($last_game_participation)->win_amount }}</div>
                                <div class="gameDetail">
                                    Period:{{ optional(optional($last_game_participation)->startGame)->duration }}
                                    minute {{ optional(optional($last_game_participation)->startGame)->start_game_id }}
                                </div>
                            </div>
                            <div data-bs-dismiss="modal" class="closeBtn"></div>
                        </div>
                    </div>
                @else
                    <div class="WinningTip__C">
                        <div class="WinningTip__C-body isL">
                            <div class="WinningTip__C-body-l1">Sorry</div>
                            <div class="WinningTip__C-body-l2 type1">Lottery results
                                <div class="colorW">
                                    {{ optional(optional($last_game_participation)->startGame)->winning_color }}</div>
                                <div class="WinningNum">
                                    {{ optional(optional($last_game_participation)->startGame)->winning_number }}</div>
                                <div class="colorW">
                                    {{ optional(optional($last_game_participation)->startGame)->winning_size }}</div>
                            </div>
                            <div class="WinningTip__C-body-l3"><br>
                                <div class="bonus">Lose</div>
                                <div class="gameDetail">
                                    Period:{{ optional(optional($last_game_participation)->startGame)->duration }}
                                    minute {{ optional(optional($last_game_participation)->startGame)->start_game_id }}
                                </div>
                            </div>
                            <div data-bs-dismiss="modal" class="closeBtn"></div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
{{-- End Winning Model --}}

<script>
    var timer2 = "{{ $remaining_time }}";
    clearInterval(interval);
    var interval = setInterval(function() {
        var timer = timer2.split(':');
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        if (minutes < 0) clearInterval(interval);
        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        $('.countdown').html(minutes + ':' + seconds);
        timer2 = minutes + ':' + seconds;
        if (minutes == 0 && seconds == 06) {
            resetFinalData();
            $('#audio_div').removeClass('d-none');
        }
        if (minutes == 0 && seconds == 05) {
            resetFinalData();
            $('#audio_div').removeClass('d-none');
            $('#5min_loader').removeClass('d-none');
            $('#timer_image').attr('src', '{{ asset('frontend/assets/images/timer/05.png') }}');
        }
        if (minutes == 0 && seconds == 04) {
            resetFinalData();
            $('#audio_div').removeClass('d-none');
            $('#5min_loader').removeClass('d-none');
            $('#timer_image').attr('src', '{{ asset('frontend/assets/images/timer/04.png') }}');
        }
        if (minutes == 0 && seconds == 03) {
            resetFinalData();
            $('#audio_div').removeClass('d-none');
            $('#5min_loader').removeClass('d-none');
            $('#timer_image').attr('src', '{{ asset('frontend/assets/images/timer/03.png') }}');
        }
        if (minutes == 0 && seconds == 02) {
            resetFinalData();
            $('#audio_div').removeClass('d-none');
            $('#5min_loader').removeClass('d-none');
            $('#timer_image').attr('src', '{{ asset('frontend/assets/images/timer/02.png') }}');
        }
        if (minutes == 0 && seconds == 01) {
            resetFinalData();
            $('#audio_div').removeClass('d-none');
            $('#5min_loader').removeClass('d-none');
            $('#timer_image').attr('src', '{{ asset('frontend/assets/images/timer/01.png') }}');
        }
        if (minutes == 0 && seconds == 0) {
            resetFinalData();
            $('#audio_div').removeClass('d-none');
            $('#5min_loader').removeClass('d-none');
            $('#timer_image').attr('src', '{{ asset('frontend/assets/images/timer/00.png') }}');
            clearInterval(interval);
            getGameDetail('{{ $game->id }}');
        }
    }, 1000);

    @if ($last_game_participation)
        $('#winning_modal').modal('show');
    @endif

    function getSelectedData(type, data) {
        var quantity = $("input[name=quantity]:checked").val();
        $("input[name=final_qty_select]").prop('checked', false);
        $("input[name=final_qty_select][value=" + quantity + "]").prop('checked', true);
        $('#selection').text(data);
        $('#final_quantity').val(quantity);
        $('#final_type').val(type);
        $('#final_data').val(data);
        calculateFinalAmount();
        $('#final_form').modal('show');
    }

    function finalSubmit() {
        var balance = $("input[name=balance]:checked").val();
        var quantity = $("#final_quantity").val();
        var type = $("#final_type").val();
        var data = $("#final_data").val();

        $.ajax({
            type: 'POST',
            url: "{{ route('user.game.participation') }}",
            data: {
                _token: "{{ csrf_token() }}",
                start_game_id: "{{ $start_game->id }}",
                balance: balance,
                type: type,
                data: data,
                quantity: quantity
            },
            success: function(data) {
                resetFinalData();
                refreshWalletSection();
            },
            error: function(request, status, error) {
                resetFinalData();
                $('.preloader').show();
                $('#loader_text').text(request.responseJSON.message);
            }
        });
    }

    function resetFinalData() {
        $("input[name=balance]").prop('checked', false);
        $("#balance1").prop('checked', true);
        $("input[name=final_qty_select]").prop('checked', false);
        $("#final_quantity").val(null);
        $("#final_type").val(null);
        $("#final_data").val(null);
        $('#final_form').modal('hide');
        setTimeout(function() {
            $('.preloader').hide();
            $('#loader_text').text('Loading...');
        }, 2000);
    }
</script>

<script>
    $(function() {
        $('[data-decrease]').click(decrease);
        $('[data-increase]').click(increase);
    });

    function decrease() {
        var value = $(this).parent().find('[data-value]').val();
        if (value > 1) {
            value--;
            $(this).parent().find('[data-value]').val(value);
        }
        calculateFinalAmount();
    }

    function increase() {
        var value = $(this).parent().find('[data-value]').val();
        if (value < 100) {
            value++;
            $(this).parent().find('[data-value]').val(value);
        }
        calculateFinalAmount();
    }

    function changeQty(qty) {
        $("#final_quantity").val(qty);
        calculateFinalAmount();
    }

    function calculateFinalAmount() {
        var balance = $("input[name=balance]:checked").val();
        var quantity = $("#final_quantity").val();

        var final_amount = parseInt(balance) * parseInt(quantity);
        $('#final_amount').text(final_amount);
    }
</script>

<script>
    function getGameHistory(game_id) {
        $('.preloader').show();
        $.ajax({
            type: 'GET',
            url: "{{ route('get.game.history', '') }}/" + game_id,
            success: function(data) {
                $('#history_div').html(data.view)
                $('.preloader').hide();
            }
        });
    }

    function getUserGameHistory(game_id) {
        $('.preloader').show();
        $.ajax({
            type: 'GET',
            url: "{{ route('get.user.game.history', '') }}/" + game_id,
            success: function(data) {
                $('#history_div').html(data.view)
                $('.preloader').hide();
            }
        });
    }

    function getGameChart(game_id) {
        $('.preloader').show();
        $.ajax({
            type: 'GET',
            url: "{{ route('get.game.chart', '') }}/" + game_id,
            success: function(data) {
                $('#history_div').html(data.view)
                $('.preloader').hide();
            }
        });
    }
</script>
