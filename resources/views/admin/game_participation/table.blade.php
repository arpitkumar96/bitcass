
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">User</th>
            <th class="text-center">Bet Data</th>
            <th class="text-center">Bet Amount</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Win Amount</th>
            <th class="text-center">Win/Lose</th>
        </tr>
        </thead>
        <tbody>
            @forelse ($game_participants as $key=>$game_participant)
                <tr>
                    <td class="text-center">{{ $key + 1 + ($game_participants->currentPage() - 1) * $game_participants->perPage() }}</td>
                    <td>
                        <b>Phone: </b>{{$game_participant->user->phone_number}} <br>
                        <b>User Id: </b>{{$game_participant->user->user_id}}
                    </td>
                    <td>
                        <b>Type: </b> {{$game_participant->type}} <br>
                        <b>Data: </b> {{$game_participant->data}}
                    </td>
                    <td>
                        <b>Amount: </b>₹ {{$game_participant->amount}} <br>
                        <b>Handling Fee: </b>₹ {{$game_participant->handling_fee}} <br>
                        <b>Final Amount: </b>₹ {{$game_participant->final_amount}}
                    </td>
                    <td class="text-center">{{$game_participant->quantity}}</td>
                    <td class="text-center">₹ {{$game_participant->win_amount}}</td>
                    <td class="text-center">
                        @if($game_participant->is_win == '1')
                            <span class="badge badge-primary">Win</span>
                        @else
                            <span class="badge badge-danger">Lose</span>
                        @endif
                    </td>
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
            <b>Showing {{ ($game_participants->currentpage() - 1) * $game_participants->perpage() + 1 }} to {{ ($game_participants->currentpage() - 1) * $game_participants->perpage() + $game_participants->count() }} of {{ $game_participants->total() }} Game Participants</b>
        </p>
    </div>
    <div class="col-md-8">
        <div class="float-right">
            {!! $game_participants->links() !!}
        </div>
    </div>
</div>

<script>

    $(function() {
        $('a.page-link').on('click', function(event) {
            $('tbody').addClass('loading')
            event.preventDefault()
            var url = $(this).attr('href');
            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    window.history.pushState("", "", url);
                    $('tbody').removeClass('loading');
                    $('#table_div').html(data);
                }
            });
        });
    });

</script>
