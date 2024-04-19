@forelse ($bet_histories as $bet_history)
    <div class="record__main-info">
        <div class="record__main-info__title flex_between">
            <div class="recharge_text">Trade History</div>
            <div class="flex_between">
                @if($bet_history->is_win == '0')
                    <div class="fail">Lose</div>
                @else
                    <div class="text--success">Win</div>
                @endif
            </div>
        </div>
        <div class="record__main-info__money item flex_between">
            <span>Amount</span><span>₹{{$bet_history->final_amount}}</span>
        </div>

        <div class="record__main-info__time item flex_between">
            <span>Time</span><span>{{$bet_history->created_at->format('d-m-Y h:i A')}}</span>
        </div>
        <div class="record__main-info__orderNumber item flex_between"><span>Order Id</span>
            <div>
                <span>{{$bet_history->startGame->start_game_id}}</span>

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
