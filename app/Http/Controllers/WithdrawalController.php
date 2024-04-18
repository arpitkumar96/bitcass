<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Models\WithdrawalRequest;

class WithdrawalController extends Controller
{

    public function index(){
        $available_balance = Auth::guard('web')->user()->total_wallet_amount;
        $withdrawal_requests = WithdrawalRequest::where('user_id',Auth::guard('web')->user()->id)->latest('id')->get();

        return view('frontend.withdrawl',compact('available_balance','withdrawal_requests'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'withdrawal_amount'=>'required|integer'
        ]);
        $available_balance = Auth::guard('web')->user()->total_wallet_amount;
        if(Auth::guard('web')->user()->block_status == '1'){
            return back()->withErrors(['withdrawal_amount'=>'You can not withdrawal!']);
        }
        if($request->withdrawal_amount <= $available_balance){
            $previous_request = WithdrawalRequest::where('user_id',Auth::guard('web')->user()->id)->latest('id')->first();
            if($previous_request){
                if($previous_request->status == 'pending'){
                    return back()->withErrors(['withdrawal_amount'=>'Your Previous Request is Pending!']);
                }
            }
            if(!Auth::guard('web')->user()->bankDetail){
                return back()->withErrors(['withdrawal_amount'=>'Please Add Bank Detail First!']);
            }
            $withdrawal_request = new WithdrawalRequest;
            $withdrawal_request->withdrawal_request_id = time().rand(1111,9999);
            $withdrawal_request->user_id = Auth::guard('web')->user()->id;
            $withdrawal_request->amount = $request->withdrawal_amount;
            $withdrawal_request->status = 'pending';
            $withdrawal_request->save();

            return back();
        }else{
            return back()->withErrors(['withdrawal_amount'=>'Insufficiant Balance!']);
        }
    }

}
