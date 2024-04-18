
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">User Id</th>
            <th class="text-center">Name</th>
            <th class="text-center">Phone</th>
            <th class="text-center">Invite Code</th>
            <th class="text-center">Wallet Amount</th>
            <th class="text-center">Date</th>
            <th class="text-center">Status</th>
            @can('user-wallet')
                <th class="text-center">Action</th>
            @endcan
        </tr>
        </thead>
        <tbody class="tbody">
            @forelse ($users as $key=>$user)
                <tr>
                    <td class="text-center">{{ $key + 1 + ($users->currentPage() - 1) * $users->perPage() }}</td>
                    <td class="text-center">{{$user->user_id}}</td>
                    <td class="text-center">{{$user->name??'---'}}</td>
                    <td class="text-center">{{$user->phone_number}}</td>
                    <td class="text-center">{{$user->invite_code}} @if($user->invite) ({{optional($user->invite)->phone_number}}) @endif</td>
                    <td class="text-center"><i class="fa fa-inr"></i> {{$user->total_wallet_amount}}</td>
                    <td class="text-center">{{$user->created_at->format('d-m-Y h:i A')}}</td>
                    <td class="text-center">
                        @if($user->block_status == '1')
                            @can('user-block')
                                <a href="{{route('admin.block.status',[$user->id,'0'])}}">
                                    <span class="badge badge-danger">Unblock</span>
                                </a>
                            @else
                                <span class="badge badge-danger">Unblock</span>
                            @endcan
                        @else
                            @can('user-block')
                                <a href="{{route('admin.block.status',[$user->id,'1'])}}">
                                    <span class="badge badge-primary">Block</span>
                                </a>
                            @else
                                <span class="badge badge-primary">Block</span>
                            @endcan
                        @endif
                    </td>
                    @can('user-wallet')
                        <td class="text-center">
                            <a class="btn btn-primary dim text-white pt-2" href="{{route('admin.wallet.transaction',$user->id)}}" data-toggle="tooltip" data-placement="top" data-original-title="Wallet Transaction"><i class="fa fa-wallet"></i></a>
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
            <b>Showing {{ ($users->currentpage() - 1) * $users->perpage() + 1 }} to {{ ($users->currentpage() - 1) * $users->perpage() + $users->count() }} of {{ $users->total() }} Users</b>
        </p>
    </div>
    <div class="col-md-8">
        <div class="float-right">
            {!! $users->links() !!}
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
