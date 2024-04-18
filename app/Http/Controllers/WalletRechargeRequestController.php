<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\Channel;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use App\Models\WalletRechargeRequest;

class WalletRechargeRequestController extends Controller
{

    public function index(){
        $payment_types = PaymentType::where('status','1')->with('channel',function($query){
            $query->where('status','1');
        })->get();

        $wallet_recharge_requests = WalletRechargeRequest::where('user_id',Auth::guard('web')->user()->id)->latest('id')->get();

        return view('frontend.payment.wallet_recharge',compact('payment_types','wallet_recharge_requests'));
    }

    public function getChannelByPaymentType(Request $request){
        $channels = Channel::where('status','1')->where('payment_type_id',$request->payment_type_id)->get();

        return response()->json(['view'=>view('frontend.payment.channel',compact('channels'))->render()]);
    }

    public function getQr(Request $request){
        $payment_type = PaymentType::where('status','1')->where('id',$request->payment_type_id)->first();
        if($payment_type){
            $channel = Channel::where('status','1')->where('payment_type_id',$payment_type->id)->where('id',$request->channel_id)->first();
            if($channel){
                if($request->final_amount >= 100){
                    $wallet_recharge_request = new WalletRechargeRequest;
                    $wallet_recharge_request->transaction_id = time().rand();
                    $wallet_recharge_request->user_id = Auth::guard('web')->user()->id;
                    $wallet_recharge_request->amount = $request->final_amount;
                    $wallet_recharge_request->payment_type_detail = $payment_type;
                    $wallet_recharge_request->channel_detail = $channel;
                    $wallet_recharge_request->status = 'initiated';
                    $wallet_recharge_request->save();

                    return route('user.payment',$wallet_recharge_request->transaction_id);
                }else{
                    return response()->json(['message'=>'Amount must be greater then 100!'],422);
                }
            }else{
                return response()->json(['message'=>'Channel Not Found!'],422);
            }
        }else{
            return response()->json(['message'=>'Payment Type Not Found!'],422);
        }
    }

    public function payment($transaction_id){
        $wallet_recharge_request = WalletRechargeRequest::where('transaction_id',$transaction_id)->where('status','initiated')->first();

        if($wallet_recharge_request){
            $minute = $wallet_recharge_request->created_at->diffInMinutes(Carbon::now());
            if($minute <= 4){
                $remaining_time = gmdate("i:s", (5*60)-$wallet_recharge_request->created_at->diffInSeconds(Carbon::now()));
                return view('frontend.payment.payment',compact('wallet_recharge_request','minute','remaining_time'));
            }else{
                $wallet_recharge_request->status = 'timeout';
                $wallet_recharge_request->save();

                return redirect()->route('user.payment.timeout');
            }
        }else{
            return redirect()->route('user.payment.invalid');
        }
    }

    public function timeout(){
        return view('frontend.payment.timeout');
    }

    public function invalid(){
        return view('frontend.payment.invalid');
    }

    public function success(){
        return view('frontend.payment.success');
    }

    public function updateUtr(Request $request,$transaction_id){
        $wallet_recharge_request = WalletRechargeRequest::where('transaction_id',$transaction_id)->first();

        if($wallet_recharge_request){
            $minute = $wallet_recharge_request->created_at->diffInMinutes(Carbon::now());
            if($minute <= 5){
                $this->validate($request,[
                    'utr_number'=>'required|digits:12'
                ]);
                $wallet_recharge_request->utr_number = $request->utr_number;
                $wallet_recharge_request->status = 'pending';
                $wallet_recharge_request->save();

                return redirect()->route('user.payment.success');
            }else{
                return redirect()->route('user.payment.timeout');
            }
        }else{
            return redirect()->route('user.payment.invalid');
        }
    }

}
