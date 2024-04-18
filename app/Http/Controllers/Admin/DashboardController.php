<?php

namespace App\Http\Controllers\Admin;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\StartGame;
use Illuminate\Http\Request;
use App\Models\WithdrawalRequest;
use App\Http\Controllers\Controller;
use App\Models\WalletRechargeRequest;

class DashboardController extends Controller
{
    function __construct(){
        $this->middleware('permission:dashboard', ['only'=>['index']]);
    }

    public function index(){
        $total_played_games = StartGame::count();
        $total_deposite_amount = WalletRechargeRequest::where('status','confirm')->sum('amount');
        $total_withdrawal_amount = WithdrawalRequest::where('status','success')->sum('amount');
        $total_current_wallet_amount = User::sum('total_wallet_amount');
        $total_registered_users = User::count();

        $last_seven_dates = [];
        foreach( range( -6, 0 ) AS $i ) {
            $date = Carbon::now()->addDays( $i )->format( 'Y-m-d' );
            array_push($last_seven_dates,$date);
        }

        $last_seven_date_deposite_amounts=[];
        foreach($last_seven_dates as $last_seven_date){
            $last_seven_date_deposite_amount = WalletRechargeRequest::where('status','confirm')->whereDate('created_at',$last_seven_date )->sum('amount');
            $last_seven_date_deposite_amounts[]=$last_seven_date_deposite_amount;
        }

        $last_seven_date_withdrawal_amounts=[];
        foreach($last_seven_dates as $last_seven_date){
            $last_seven_date_withdrawal_amount = WithdrawalRequest::where('status','success')->whereDate('created_at',$last_seven_date )->sum('amount');
            $last_seven_date_withdrawal_amounts[]=$last_seven_date_withdrawal_amount;
        }

        return view('admin.dashboard',compact('total_played_games','total_deposite_amount','total_withdrawal_amount','total_registered_users','total_current_wallet_amount','last_seven_dates','last_seven_date_deposite_amounts','last_seven_date_withdrawal_amounts'),['page_title'=>'Dashboard']);
    }

}
