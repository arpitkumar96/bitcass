@foreach ($channels as $ch_key=>$channel)
    <div class="Recharge__content-quickInfo__item">
        <div class="other">
            <input type="radio" name="channel" class="btn-check" value="{{$channel->id}}" @if($ch_key == 0) checked @endif  id="option00{{$ch_key}}" autocomplete="off">
            <label for="option00{{$ch_key}}" class="btns btn-secondary">{{$channel->name}} </label>
        </div>
    </div>
@endforeach
