<table class="table">
    <thead>
        <tr>
            <th>Period</th>
            <th>Number</th>
            <th>Up / Down</th>
            <th>Color</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($old_start_games as $old_start_game)
            <tr>
                <td>{{$old_start_game->start_game_id}}</td>
                <td>
                    <div class="{{$old_start_game->winning_color}}-number-clr">{{$old_start_game->winning_number}}</div>
                </td>
                <td>
                    @if ($old_start_game->winning_size == 'small')
                        Down
                    @else
                        Up
                    @endif
                </td>
                <td>
                    @if($old_start_game->winning_number == 0 || $old_start_game->winning_number == 5)
                        <div class="{{explode('-',$old_start_game->winning_color)[0]}}-boll"></div>
                        <div class="{{explode('-',$old_start_game->winning_color)[1]}}-boll"></div>
                    @else
                        <div class="{{$old_start_game->winning_color}}-boll"></div>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
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
