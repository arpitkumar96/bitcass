
<table class="table table-striped">
    <thead>
    <tr>
        <th class="text-center"><b>User Id</b></th>
        <th class="text-center"><b>Name</b></th>
        <th class="text-center"><b>Phone</b></th>
        <th class="text-center"><b>Invite Code</b></th>
        <th class="text-center"><b>Wallet Amount</b></th>
        <th class="text-center"><b>Date</b></th>
        <th class="text-center"><b>Status</b></th>
    </tr>
    </thead>
    <tbody class="tbody">
        @foreach ($users as $key=>$user)
            <tr>
                <td class="text-center">{{$user->user_id}}</td>
                <td class="text-center">{{$user->name??'---'}}</td>
                <td class="text-center">{{$user->phone_number}}</td>
                <td class="text-center">{{$user->invite_code}} @if($user->invite) ({{optional($user->invite)->phone_number}}) @endif</td>
                <td class="text-center">{{$user->total_wallet_amount}}</td>
                <td class="text-center">{{$user->created_at->format('d-m-Y')}}</td>
                <td class="text-center">
                    @if($user->block_status == '1')
                        Unblock
                    @else
                        Block
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
