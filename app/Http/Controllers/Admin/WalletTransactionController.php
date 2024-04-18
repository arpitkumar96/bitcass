<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WalletTransactionController extends Controller
{
    function __construct(){
        $this->middleware('permission:user-wallet', ['only'=>['index']]);
    }

    public function index(Request $request,$user_id){
        $user = User::find($user_id);

        $search_start_date = $request->search_start_date;
        $search_end_date = $request->search_end_date;
        $search_amount = $request->search_amount;
        $search_type = $request->search_type;
        $search_transaction_type = $request->search_transaction_type;
        $search_key = $request->search_key;

        $wallets = Wallet::where('user_id',$user->id);

        if($search_start_date){
            $d1=strtotime($search_start_date);
            $d2=strtotime($search_end_date);
            $da1=date('Y-m-d',$d1);
            $da2=date('Y-m-d',$d2);
            $startDate = Carbon::createFromFormat('Y-m-d', $da1)->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $da2)->endOfDay();

            $wallets = $wallets->whereBetween('created_at', [$startDate, $endDate]);
        }

        if($search_amount){
            $wallets = $wallets->where('amount','>=',$search_amount);
        }

        if($search_type){
            $wallets = $wallets->where('type',$search_type);
        }

        if($search_transaction_type){
            $wallets = $wallets->where('transaction_type',$search_transaction_type);
        }

        if($search_key){
            $wallets = $wallets->whereHas('user',function($q) use ($search_key){
                $q->where('user_id',$search_key)->orWhere('phone_number',$search_key);
            });
        }
        if($request->has('export')){
            $wallets = $wallets->get();

            return Excel::download(new RechargeExport($wallets), 'wallet.xlsx');
        }
        $wallets = $wallets->latest()->paginate(10);

        if($request->ajax()){
            return view('admin.wallet.table',compact('wallets','search_start_date','search_end_date','search_amount','search_type','search_transaction_type','search_key','user'));
        }

        return view('admin.wallet.index',compact('wallets','search_start_date','search_end_date','search_amount','search_type','search_transaction_type','search_key','user'),['page_title'=>'Wallet Transaction List']);
    }

}
