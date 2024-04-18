<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Amount</th>
            <th class="text-center">Type</th>
            <th class="text-center">Transaction Type</th>
            <th class="text-center">Date</th>
        </tr>
        </thead>
        <tbody class="tbody">
            @forelse ($wallets as $key=>$wallet)
                <tr>
                    <td class="text-center">{{ $key + 1 + ($wallets->currentPage() - 1) * $wallets->perPage() }}</td>
                    <td class="text-center">₹ {{$wallet->amount}}</td>
                    <td class="text-center">{{ucwords(str_replace('_',' ',$wallet->type))}}</td>
                    <td class="text-center">{{ucwords($wallet->transaction_type)}}</td>
                    <td class="text-center">{{$wallet->created_at->format('d-m-Y h:i A')}}</td>
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
            <b>Showing {{ ($wallets->currentpage() - 1) * $wallets->perpage() + 1 }} to {{ ($wallets->currentpage() - 1) * $wallets->perpage() + $wallets->count() }} of {{ $wallets->total() }} Wallet Recharge Requests</b>
        </p>
    </div>
    <div class="col-md-8">
        <div class="float-right">
            {!! $wallets->appends(['search_start_date'=>$search_start_date,'search_end_date'=>$search_end_date,'search_amount'=>$search_amount,'search_type'=>$search_type,'search_transaction_type'=>$search_transaction_type,'search_key'=>$search_key])->links() !!}
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
