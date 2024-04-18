<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Category</th>
            <th class="text-center">Sub Category</th>
            <th class="text-center">Name</th>
            <th class="text-center">Image</th>
            <th class="text-center">Duration (in min.)</th>
            <th class="text-center">Number of Played game</th>
            <th class="text-center">Is Active</th>
            @canany(['game-played','game-edit', 'game-delete'])
                <th class="text-center">Action</th>
            @endcanany
        </tr>
        </thead>
        <tbody>
            @forelse ($games as $key=>$game)
                <tr>
                    <td class="text-center">{{ $key + 1 + ($games->currentPage() - 1) * $games->perPage() }}</td>
                    <td class="text-center">{{$game->category->name}}</td>
                    <td class="text-center">{{$game->subCategory->name}}</td>
                    <td class="text-center">{{$game->name}}</td>
                    <td class="text-center">
                        <img src="{{asset('backend/assets/image/games/'.$game->image)}}" height="50px" width="50px" onerror="this.onerror=null;this.src='{{asset('backend/assets/image/no-image.png')}}';" >
                    </td>
                    <td class="text-center">{{$game->duration}}</td>
                    <td class="text-center">{{$game->start_game_count}}</td>
                    <td class="text-center">
                        @if($game->is_active == '1')
                        @can('game-status')
                            <a href="{{route('admin.game.status',[$game->id,'0'])}}">
                                <span class="badge badge-primary">Active</span>
                            </a>
                        @else
                            <span class="badge badge-primary">Active</span>
                        @endcan
                        @else
                            @can('game-status')
                                <a href="{{route('admin.game.status',[$game->id,'1'])}}">
                                    <span class="badge badge-danger">Inactive</span>
                                </a>
                            @else
                            <span class="badge badge-danger">Inactive</span>
                            @endcan
                        @endif
                    </td>
                    @canany(['game-played','game-edit', 'game-delete'])
                        <td class="text-center">
                            @can('game-played')
                                <a class="btn btn-warning dim text-white pt-2" href="{{route('admin.played.games',$game->slug)}}" data-toggle="tooltip" data-placement="top" title="Played Games"><i class="fa fa-gamepad"></i></a>
                            @endcan
                            @can('game-edit')
                                <x-admin.edit-button route="{{route('admin.game.edit', $game->id)}}" />
                            @endcan
                            @can('game-delete')
                                <x-admin.delete-button route="{{route('admin.game.destroy', $game->id)}}" id="{{$game->id}}" />
                            @endcan
                        </td>
                    @endcanany
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
            <b>Showing {{ ($games->currentpage() - 1) * $games->perpage() + 1 }} to {{ ($games->currentpage() - 1) * $games->perpage() + $games->count() }} of {{ $games->total() }} Games</b>
        </p>
    </div>
    <div class="col-md-8">
        <div class="float-right">
            {!! $games->appends(['search_category'=>$search_category,'search_subcategory'=>$search_subcategory,'search_status'=>$search_status,'search_duration'=>$search_duration,'search_key'=>$search_key])->links() !!}
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
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        });
    });

</script>
