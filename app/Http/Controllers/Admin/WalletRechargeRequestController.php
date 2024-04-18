<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Exports\RechargeExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\WalletRechargeRequest;
use App\Http\Controllers\Admin\RechargeCommissionController;

class WalletRechargeRequestController extends Controller
{
    function __construct(){
        $this->middleware('permission:recharge_request-list', ['only'=>['index']]);
        $this->middleware('permission:recharge_request-approval', ['only'=>['status']]);
    }

    public function index(Request $request){
        $search_start_date = $request->search_start_date;
        $search_end_date = $request->search_end_date;
        $search_amount = $request->search_amount;
        $search_status = $request->search_status;
        $search_key = $request->search_key;

        $wallet_recharge_requests = WalletRechargeRequest::latest();

        if($search_start_date){
            $d1=strtotime($search_start_date);
            $d2=strtotime($search_end_date);
            $da1=date('Y-m-d',$d1);
            $da2=date('Y-m-d',$d2);
            $startDate = Carbon::createFromFormat('Y-m-d', $da1)->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $da2)->endOfDay();

            $wallet_recharge_requests = $wallet_recharge_requests->whereBetween('created_at', [$startDate, $endDate]);
        }

        if($search_amount){
            $wallet_recharge_requests = $wallet_recharge_requests->where('amount','>=',$search_amount);
        }

        if($search_status){
            $wallet_recharge_requests = $wallet_recharge_requests->where('status',$search_status);
        }

        if($search_key){
            $wallet_recharge_requests = $wallet_recharge_requests->whereHas('user',function($q) use ($search_key){
                $q->where('user_id',$search_key)->orWhere('phone_number',$search_key);
            })->orWhere(function($query) use ($search_key){
                $query->where('transaction_id',$search_key)->orWhere('utr_number',$search_key);
            });
        }
        if($request->has('export')){
            $wallet_recharge_requests = $wallet_recharge_requests->get();

            return Excel::download(new RechargeExport($wallet_recharge_requests), 'wallet_recharge.xlsx');
        }
        $wallet_recharge_requests = $wallet_recharge_requests->with('user')->paginate(10);

        if($request->ajax()){
            return view('admin.wallet_recharge_request.table',compact('wallet_recharge_requests','search_start_date','search_end_date','search_amount','search_status','search_key'));
        }

        return view('admin.wallet_recharge_request.index',compact('wallet_recharge_requests','search_start_date','search_end_date','search_amount','search_status','search_key'),['page_title'=>'Wallet Recharge Request']);
    }

    public function status(Request $request){
        $this->validate($request,[
            'status'=>'required|in:confirm,cancel'
        ]);

        $wallet_recharge_request = WalletRechargeRequest::where('status','pending')->where('id',$request->id)->first();
        if($wallet_recharge_request){
            if($request->status == 'confirm'){
                $wallet = new Wallet;
                $wallet->user_id = $wallet_recharge_request->user_id;
                $wallet->type_id = $wallet_recharge_request->id;
                $wallet->amount = $wallet_recharge_request->amount;
                $wallet->transaction_type = 'credit';
                $wallet->type = 'deposite';
                $wallet->save();

                $user = User::where('id',$wallet_recharge_request->user_id)->first();
                $user->total_wallet_amount = $user->total_wallet_amount + $wallet_recharge_request->amount;
                $user->save();

                $commission_distribution = new RechargeCommissionController;
                $commission_distribution->commissionDistribution($wallet_recharge_request->user_id,$wallet_recharge_request->amount,$wallet_recharge_request->id);
            }
            $wallet_recharge_request->status = $request->status;
            $wallet_recharge_request->save();

            return back()->with('success','Status Changed Successfully!');
        }else{
            return back()->with('error','Requerst Not Found!');
        }
    }

}
