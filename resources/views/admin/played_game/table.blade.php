
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Game Id</th>
            <th class="text-center">Winning Number</th>
            <th class="text-center">Winning Color</th>
            <th class="text-center">Winning Size</th>
            <th class="text-center">Number of Participant</th>
            <th class="text-center">Total Bet Amount</th>
            @can('game-played-company-profit')
                <th class="text-center">Total Company Profit</th>
            @endcan
            <th class="text-center">Date</th>
            @can('game-played-participant')
                <th class="text-center">Action</th>
            @endcan
        </tr>
        </thead>
        <tbody class="tbody">
            @forelse ($played_games as $key=>$played_game)
                <tr>
                    <td class="text-center">{{ $key + 1 + ($played_games->currentPage() - 1) * $played_games->perPage() }}</td>
                    <td class="text-center">{{$played_game->start_game_id}}</td>
                    <td class="text-center">{{$played_game->winning_number}}</td>
                    <td class="text-center">{{$played_game->winning_color}}</td>
                    <td class="text-center">{{$played_game->winning_size}}</td>
                    <td class="text-center">{{$played_game->game_participation_count}}</td>
                    <td class="text-center">₹ {{$played_game->game_participation_sum_amount??0}}</td>
                    @can('game-played-company-profit')
                        <td class="text-center">₹ {{($played_game->game_participation_sum_amount??0) - ($played_game->game_participation_sum_win_amount??0)}}</td>
                    @endcan
                    <td class="text-center">{{$played_game->created_at}}</td>
                    @can('game-played-participant')
                        <td class="text-center">
                            <a class="btn btn-primary dim text-white pt-2" href="{{route('admin.game.participant',$played_game->start_game_id)}}" data-toggle="tooltip" data-placement="top" title="Participants"><i class="fa fa-users"></i></a>
                        </td>
                    @endcan
                </tr>
            @empty
                <x-admin.empty-table />
            @endforelse
        </tbody>
    </table>
</div>
<hr>
<div class="row">
    <div class="col-md-4">
        <p>
            <b>Showing {{ ($played_games->currentpage() - 1) * $played_games->perpage() + 1 }} to {{ ($played_games->currentpage() - 1) * $played_games->perpage() + $played_games->count() }} of {{ $played_games->total() }} Games</b>
        </p>
    </div>
    <div class="col-md-8">
        <div class="float-right">
            {!! $played_games->links() !!}
        </div>
    </div>
</div>

<script>

    $(function() {
        $('a.page-link').on('click', function(event) {
            $('.tbody').addClass('loading')
            event.preventDefault()
            var url = $(this).attr('href');
            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    window.history.pushState("", "", url);
                    $('.tbody').removeClass('loading');
                    $('#table_div').html(data);
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        });
    });

</script>
