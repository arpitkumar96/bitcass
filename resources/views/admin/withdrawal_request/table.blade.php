<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Request Id</th>
            <th class="text-center">User</th>
            <th class="text-center">Bank Detail</th>
            <th class="text-center">Amount</th>
            <th class="text-center">Date</th>
            <th class="text-center">Remark</th>
            <th class="text-center">Status</th>
        </tr>
        </thead>
        <tbody class="tbody">
            @forelse ($withdrawal_requests as $key=>$withdrawal_request)
                <tr>
                    <td class="text-center">{{ $key + 1 + ($withdrawal_requests->currentPage() - 1) * $withdrawal_requests->perPage() }}</td>
                    <td class="text-center">{{$withdrawal_request->withdrawal_request_id}}</td>
                    <td>
                        <b>ID: </b>{{$withdrawal_request->user->user_id}} <br>
                        <b>Phone: </b>{{$withdrawal_request->user->phone_number}}
                    </td>
                    <td>
                        <b>Bank Name: </b>{{$withdrawal_request->user->bankDetail->bank_name}} <br>
                        <b>A/C number: </b>{{$withdrawal_request->user->bankDetail->account_number}} <br>
                        <b>IFSC Code: </b>{{$withdrawal_request->user->bankDetail->ifsc_code}} <br>
                        <b>Phone: </b>{{$withdrawal_request->user->bankDetail->phone_number}} <br>
                        <b>Email: </b>{{$withdrawal_request->user->bankDetail->email}}
                    </td>
                    <td class="text-center">₹ {{$withdrawal_request->amount}}</td>
                    <td class="text-center">{{$withdrawal_request->created_at->format('d-m-Y h:i A')}}</td>
                    <td class="text-center">{{$withdrawal_request->remark}}</td>
                    <td class="text-center">
                        @if($withdrawal_request->status == 'pending')
                        @can('withdrawal_request-approval')
                            <select id="status_{{$withdrawal_request->id}}" class="form-control" onchange="changeStatus('{{$withdrawal_request->id}}')">
                                <option value="">Select Status</option>
                                <option value="success">Confirm</option>
                                <option value="cancel">Cancel</option>
                            </select>
                        @else
                            <span class="badge badge-warning">Pending</span>
                        @endcan
                        @elseif($withdrawal_request->status == 'success')
                            <span class="badge badge-primary">Confirm</span>
                        @elseif($withdrawal_request->status == 'cancel')
                            <span class="badge badge-danger">Cancel</span>
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
            <b>Showing {{ ($withdrawal_requests->currentpage() - 1) * $withdrawal_requests->perpage() + 1 }} to {{ ($withdrawal_requests->currentpage() - 1) * $withdrawal_requests->perpage() + $withdrawal_requests->count() }} of {{ $withdrawal_requests->total() }} Wallet Recharge Requests</b>
        </p>
    </div>
    <div class="col-md-8">
        <div class="float-right">
            {!! $withdrawal_requests->links() !!}
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
