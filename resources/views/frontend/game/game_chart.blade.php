

<div class="col-12">
    <div data-v-28738ead="" class="Trends__C">
        <div class="Trends__C-head">
            <div class="van-row">
                <div class="van-col van-col--8">Period</div>
                <div class="van-col van-col--16">Number</div>
            </div>
        </div>
        <div class="Trends__C-body1">
            <div class="Trends__C-body1-line">Statistic (last 100 Periods)</div>
            <div class="Trends__C-body1-line lottery">
                <div>Winning number</div>
                <div class="Trends__C-body1-line-num">
                    <div>0</div>
                    <div>1</div>
                    <div>2</div>
                    <div>3</div>
                    <div>4</div>
                    <div>5</div>
                    <div>6</div>
                    <div>7</div>
                    <div>8</div>
                    <div>9</div>
                </div>
            </div>
            <div class="Trends__C-body1-line">
                <div>Missing</div>
                <div class="Trends__C-body1-line-num">
                    <div>7</div>
                    <div>13</div>
                    <div>11</div>
                    <div>4</div>
                    <div>3</div>
                    <div>1</div>
                    <div>9</div>
                    <div>5</div>
                    <div>0</div>
                    <div>2</div>
                </div>
            </div>
            <div class="Trends__C-body1-line">
                <div>Avg missing</div>
                <div class="Trends__C-body1-line-num">
                    <div>8</div>
                    <div>7</div>
                    <div>15</div>
                    <div>7</div>
                    <div>6</div>
                    <div>10</div>
                    <div>11</div>
                    <div>11</div>
                    <div>9</div>
                    <div>8</div>
                </div>
            </div>
            <div class="Trends__C-body1-line">
                <div>Frequency</div>
                <div class="Trends__C-body1-line-num">
                    <div>12</div>
                    <div>13</div>
                    <div>6</div>
                    <div>11</div>
                    <div>14</div>
                    <div>8</div>
                    <div>8</div>
                    <div>8</div>
                    <div>10</div>
                    <div>10</div>
                </div>
            </div>
            <div class="Trends__C-body1-line">
                <div>Max consecutive</div>
                <div class="Trends__C-body1-line-num">
                    <div>3</div>
                    <div>2</div>
                    <div>2</div>
                    <div>1</div>
                    <div>2</div>
                    <div>1</div>
                    <div>1</div>
                    <div>2</div>
                    <div>1</div>
                    <div>1</div>
                </div>
            </div>
        </div>
        <div class="Trends__C-body2">
            @foreach ($old_start_games as $old_start_game)
                <div issuenumber="20240409010965" number="8" colour="red"
                    rowid="0">
                    <div class="van-row">
                        <div class="van-col van-col--8">
                            <div class="Trends__C-body2-IssueNumber">{{$old_start_game->start_game_id }}</div>
                        </div>
                        <div class="van-col van-col--16">
                            <div class="Trends__C-body2-Num"><canvas
                                    canvas="" id="myCanvas0" class="line-canvas"></canvas>
                                <div class="Trends__C-body2-Num-item @if($old_start_game->winning_number == 0) @if($old_start_game->winning_color == 'red') action4 @elseif($old_start_game->winning_color == 'green') action3 @elseif($old_start_game->winning_color == 'violet') action3 @elseif($old_start_game->winning_color == 'green-violet') action0 @elseif($old_start_game->winning_color == 'red-violet') action5 @endif @endif">0</div>
                                <div class="Trends__C-body2-Num-item @if($old_start_game->winning_number == 1) @if($old_start_game->winning_color == 'red') action4 @elseif($old_start_game->winning_color == 'green') action3 @elseif($old_start_game->winning_color == 'violet') action3 @elseif($old_start_game->winning_color == 'green-violet') action0 @elseif($old_start_game->winning_color == 'red-violet') action5 @endif @endif">1</div>
                                <div class="Trends__C-body2-Num-item @if($old_start_game->winning_number == 2) @if($old_start_game->winning_color == 'red') action4 @elseif($old_start_game->winning_color == 'green') action3 @elseif($old_start_game->winning_color == 'violet') action3 @elseif($old_start_game->winning_color == 'green-violet') action0 @elseif($old_start_game->winning_color == 'red-violet') action5 @endif @endif">2</div>
                                <div class="Trends__C-body2-Num-item @if($old_start_game->winning_number == 3) @if($old_start_game->winning_color == 'red') action4 @elseif($old_start_game->winning_color == 'green') action3 @elseif($old_start_game->winning_color == 'violet') action3 @elseif($old_start_game->winning_color == 'green-violet') action0 @elseif($old_start_game->winning_color == 'red-violet') action5 @endif @endif">3</div>
                                <div class="Trends__C-body2-Num-item @if($old_start_game->winning_number == 4) @if($old_start_game->winning_color == 'red') action4 @elseif($old_start_game->winning_color == 'green') action3 @elseif($old_start_game->winning_color == 'violet') action3 @elseif($old_start_game->winning_color == 'green-violet') action0 @elseif($old_start_game->winning_color == 'red-violet') action5 @endif @endif">4</div>
                                <div class="Trends__C-body2-Num-item @if($old_start_game->winning_number == 5) @if($old_start_game->winning_color == 'red') action4 @elseif($old_start_game->winning_color == 'green') action3 @elseif($old_start_game->winning_color == 'violet') action3 @elseif($old_start_game->winning_color == 'green-violet') action0 @elseif($old_start_game->winning_color == 'red-violet') action5 @endif @endif">5</div>
                                <div class="Trends__C-body2-Num-item @if($old_start_game->winning_number == 6) @if($old_start_game->winning_color == 'red') action4 @elseif($old_start_game->winning_color == 'green') action3 @elseif($old_start_game->winning_color == 'violet') action3 @elseif($old_start_game->winning_color == 'green-violet') action0 @elseif($old_start_game->winning_color == 'red-violet') action5 @endif @endif">6</div>
                                <div class="Trends__C-body2-Num-item @if($old_start_game->winning_number == 7) @if($old_start_game->winning_color == 'red') action4 @elseif($old_start_game->winning_color == 'green') action3 @elseif($old_start_game->winning_color == 'violet') action3 @elseif($old_start_game->winning_color == 'green-violet') action0 @elseif($old_start_game->winning_color == 'red-violet') action5 @endif @endif">7</div>
                                <div class="Trends__C-body2-Num-item @if($old_start_game->winning_number == 8) @if($old_start_game->winning_color == 'red') action4 @elseif($old_start_game->winning_color == 'green') action3 @elseif($old_start_game->winning_color == 'violet') action3 @elseif($old_start_game->winning_color == 'green-violet') action0 @elseif($old_start_game->winning_color == 'red-violet') action5 @endif @endif">8</div>
                                <div class="Trends__C-body2-Num-item @if($old_start_game->winning_number == 9) @if($old_start_game->winning_color == 'red') action4 @elseif($old_start_game->winning_color == 'green') action3 @elseif($old_start_game->winning_color == 'violet') action3 @elseif($old_start_game->winning_color == 'green-violet') action0 @elseif($old_start_game->winning_color == 'red-violet') action5 @endif @endif">9</div>
                                <div class="Trends__C-body2-Num-BS isB @if($old_start_game->winning_number == 10) @if($old_start_game->winning_color == 'red') action4 @elseif($old_start_game->winning_color == 'green') action3 @elseif($old_start_game->winning_color == 'violet') action3 @elseif($old_start_game->winning_color == 'green-violet') action0 @elseif($old_start_game->winning_color == 'red-violet') action5 @endif @endif">@if($old_start_game->winning_size == 'big') B @else S @endif</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
{!! $old_start_games->links() !!}

<script>
    $(function() {
        $('a.page-link').on('click', function(event) {
            //$('tbody').addClass('loading')
            event.preventDefault()
            var url = $(this).attr('href');
            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    //console.log(data);
                    //window.history.pushState("", "", url);
                    //$('tbody').removeClass('loading')
                    $('#history_div').html(data.view)
                }
            });
        });
    });
</script>
