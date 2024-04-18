<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Gift;
use App\Models\User;
use App\Models\Wallet;
use App\Models\RedeemGift;
use Illuminate\Http\Request;

class RedeemGiftController extends Controller
{

    public function index(){
        $redeem_gifts = RedeemGift::where('user_id',Auth::guard('web')->user()->id)->latest()->get();

        return view('frontend.redeemgift',compact('redeem_gifts'));
    }

    public function store(Request $request){
        $gift = Gift::where('is_active','1')->where('code',$request->redeem_gift)->whereDate('start_date','<=',date('Y-m-d'))->whereDate('end_date','>=',date('Y-m-d'))->first();

        if(!$gift){
            return back()->with('error','Invalid Code!');
        }
        $redeem_gift = RedeemGift::where('user_id',Auth::guard('web')->user()->id)->where('gift_id',$gift->id)->first();
        if($redeem_gift){
            return back()->with('error','You Have Already Redeemed this Gift!');
        }
        if($gift->usage_limitation == 'limited'){
            if($gift->usaged >= $gift->number_of_usage){
                return back()->with('error','This Code Limit Reacheds!');
            }
        }

        $redeem_gift = new RedeemGift;
        $redeem_gift->user_id = Auth::guard('web')->user()->id;
        $redeem_gift->gift_id = $gift->id;
        $redeem_gift->gift_detail = $gift;
        $redeem_gift->amount = $gift->amount;
        $redeem_gift->save();

        $gift->usaged = $gift->usaged+1;
        $gift->save();

        $wallet = new Wallet;
        $wallet->user_id = Auth::guard('web')->user()->id;
        $wallet->type_id = $redeem_gift->id;
        $wallet->amount = $redeem_gift->amount;
        $wallet->transaction_type = 'credit';
        $wallet->type = 'gift';
        $wallet->save();

        $user = User::find(Auth::guard('web')->user()->id);
        $user->total_wallet_amount = $user->total_wallet_amount + $redeem_gift->amount;
        $user->save();

        return back()->with('success','Code Redeemed Successfully!');
    }

}
