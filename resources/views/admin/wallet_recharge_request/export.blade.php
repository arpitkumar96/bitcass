<table class="table table-striped">
    <thead>
    <tr>
        <th class="text-center"><b>Transaction Id</b></th>
        <th class="text-center"><b>User</b></th>
        <th class="text-center"><b>Amount</b></th>
        <th class="text-center"><b>UTR Number</b></th>
        <th class="text-center"><b>Date</b></th>
        <th class="text-center"><b>Status</b></th>
    </tr>
    </thead>
    <tbody class="tbody">
        @foreach ($wallet_recharge_requests as $key=>$wallet_recharge_request)
            <tr>
                <td class="text-center">{{$wallet_recharge_request->transaction_id}}</td>
                <td>
                    {{$wallet_recharge_request->user->user_id}} ({{$wallet_recharge_request->user->phone_number}})
                </td>
                <td class="text-center">{{$wallet_recharge_request->amount}}</td>
                <td class="text-center">{{$wallet_recharge_request->utr_number}}</td>
                <td class="text-center">{{$wallet_recharge_request->created_at->format('d-m-Y h:i A')}}</td>
                <td class="text-center">
                    @if($wallet_recharge_request->status == 'pending')
                        Pending
                    @elseif($wallet_recharge_request->status == 'initiated')
                        Initiated
                    @elseif($wallet_recharge_request->status == 'confirm')
                        Confirm
                    @elseif($wallet_recharge_request->status == 'cancel')
                        Cancel
                    @elseif($wallet_recharge_request->status == 'timeout')
                        Timeout
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
