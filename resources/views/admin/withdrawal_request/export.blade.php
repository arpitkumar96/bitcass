<table class="table table-striped">
    <thead>
    <tr>
        <th class="text-center"><b>Request Id</b></th>
        <th class="text-center"><b>User</b></th>
        <th class="text-center"><b>Amount</b></th>
        <th class="text-center"><b>Date</b></th>
        <th class="text-center"><b>Status</b></th>
    </tr>
    </thead>
    <tbody class="tbody">
        @foreach ($withdrawal_requests as $key=>$withdrawal_request)
            <tr>
                <td class="text-center">{{$withdrawal_request->withdrawal_request_id}}</td>
                <td>{{$withdrawal_request->user->user_id}} ({{$withdrawal_request->user->phone_number}})
                </td>
                <td class="text-center">{{$withdrawal_request->amount}}</td>
                <td class="text-center">{{$withdrawal_request->created_at->format('d-m-Y h:i A')}}</td>
                <td class="text-center">
                    @if($withdrawal_request->status == 'pending')
                        Pending
                    @elseif($withdrawal_request->status == 'success')
                        Confirm
                    @elseif($withdrawal_request->status == 'cancel')
                        Cancel
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
