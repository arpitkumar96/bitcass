<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Transaction Id</th>
            <th class="text-center">User</th>
            <th class="text-center">Amount</th>
            <th class="text-center">UTR Number</th>
            <th class="text-center">Channel Detail</th>
            <th class="text-center">Date</th>
            <th class="text-center">Status</th>
        </tr>
        </thead>
        <tbody class="tbody">
            @forelse ($wallet_recharge_requests as $key=>$wallet_recharge_request)
                <tr>
                    <td class="text-center">{{ $key + 1 + ($wallet_recharge_requests->currentPage() - 1) * $wallet_recharge_requests->perPage() }}</td>
                    <td class="text-center">{{$wallet_recharge_request->transaction_id}}</td>
                    <td>
                        <b>ID: </b>{{$wallet_recharge_request->user->user_id}} <br>
                        <b>Phone: </b>{{$wallet_recharge_request->user->phone_number}}
                    </td>
                    <td class="text-center">₹ {{$wallet_recharge_request->amount}}</td>
                    <td class="text-center">{{$wallet_recharge_request->utr_number}}</td>
                    <td>
                        <b>Name: </b>{{json_decode($wallet_recharge_request->channel_detail)->name}} <br>
                        <b>UPI Id: </b>{{json_decode($wallet_recharge_request->channel_detail)->upi_id}}
                    </td>
                    <td class="text-center">{{$wallet_recharge_request->created_at->format('d-m-Y h:i A')}}</td>
                    <td class="text-center">
                        @if($wallet_recharge_request->status == 'pending')
                        @can('recharge_request-approval')
                            <select id="status_{{$wallet_recharge_request->id}}" class="form-control" onchange="changeStatus('{{$wallet_recharge_request->id}}')">
                                <option value="">Select Status</option>
                                <option value="confirm">Confirm</option>
                                <option value="cancel">Cancel</option>
                            </select>
                        @else
                            <span class="badge badge-warning">Pending</span>
                        @endcan
                        @elseif($wallet_recharge_request->status == 'initiated')
                            <span class="badge badge-info">Initiated</span>
                        @elseif($wallet_recharge_request->status == 'confirm')
                            <span class="badge badge-primary">Confirm</span>
                        @elseif($wallet_recharge_request->status == 'cancel')
                            <span class="badge badge-danger">Cancel</span>
                        @elseif($wallet_recharge_request->status == 'timeout')
                            <span class="badge badge-warning">Timeout</span>
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
            <b>Showing {{ ($wallet_recharge_requests->currentpage() - 1) * $wallet_recharge_requests->perpage() + 1 }} to {{ ($wallet_recharge_requests->currentpage() - 1) * $wallet_recharge_requests->perpage() + $wallet_recharge_requests->count() }} of {{ $wallet_recharge_requests->total() }} Wallet Recharge Requests</b>
        </p>
    </div>
    <div class="col-md-8">
        <div class="float-right">
            {!! $wallet_recharge_requests->links() !!}
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
