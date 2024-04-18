@extends('admin.layouts.app')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-6">
            <ol class="breadcrumb mt-4">
                <li class="breadcrumb-item">
                    <a href="{{route('admin.dashboard')}}">Dashboard</a>
                </li>
                @isset($page_title)
                    <li class="breadcrumb-item active">
                        <strong>{{$page_title}}</strong>
                    </li>
                @endisset
            </ol>
        </div>
        <div class="col-6 text-right">
            <b>User Id: </b> {{$user->user_id}} <br>
            <b>Phone: </b> {{$user->phone_number}} <br>
            <b>Total Wallet Balance: </b><i class="fa fa-rupee"></i> {{$user->total_wallet_amount}}
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <form action="{{route('admin.wallet.transaction',$user->id)}}" id="search_form">
                            <div class="row">
                                <div class="col-sm-3 m-b-xs">
                                    <label for="search_transaction_type">Transaction Type</label>
                                    <select name="search_transaction_type" class="form-control" onchange="fillter()">
                                        <option value="">All</option>
                                        <option value="credit">Credit</option>
                                        <option value="debit">Debit</option>
                                    </select>
                                </div>
                                <div class="col-sm-3 m-b-xs">
                                    <label for="search_type">Type</label>
                                    <select name="search_type" class="form-control select2" onchange="fillter()">
                                        <option value="">All</option>
                                        <option value="deposite">Deposite</option>
                                        <option value="withdrawal">Withdrawal</option>
                                        <option value="bet">Bet</option>
                                        <option value="reward">Reward</option>
                                        <option value="joinning_bonus">Joinning Bonus</option>
                                        <option value="subordinate_joinning_bonus">Subordinate Joinning Bonus</option>
                                        <option value="first_recharge_commission">First Recharge Commission</option>
                                        <option value="recharge_commission">Recharge Commission</option>
                                        <option value="game_play_commission">Game Play Commission</option>
                                        <option value="first_recharge_self_commission">First Recharge Self Commission</option>
                                        <option value="gift">Gift</option>
                                    </select>
                                </div>
                                <div class="col-sm-3 m-b-xs">
                                    <div class="form-group date_range">
                                        <label class="font-normal">Date</label>
                                        <div class="input-daterange input-group" id="datepicker">
                                            <input type="text" class="form-control-sm form-control" name="search_start_date" placeholder="--/--/----" value="{{$search_start_date}}" onchange="fillter()">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control-sm form-control" name="search_end_date" placeholder="--/--/----" value="{{$search_end_date}}" onchange="fillter()">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 m-b-xs">
                                    <label for="search_amount">Amount</label>
                                    <div class="input-group">
                                        <input placeholder="Amount" type="text" name="search_amount" id="search_amount" value="{{$search_amount}}" class="form-control form-control-sm" onkeyup="fillter()">
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-sm btn-primary dim">Search</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div id="table_div">
                            @include('admin.wallet.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')

        <script>

            function fillter(){
                $('.tbody').addClass('loading')
                var route = "{{route('admin.wallet.transaction',$user->id)}}";
                var form = $('#search_form').serialize();
                $.ajax({
                    type: 'GET',
                    url: "{{route('admin.wallet.transaction',$user->id)}}",
                    data: $('#search_form').serialize(),
                    success: function(data) {
                        window.history.pushState("", "", route+'?'+form);
                        $('.tbody').removeClass('loading');
                        $('#table_div').html(data);
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }

        </script>

    @endpush

@endsection
