<?php

namespace App\Http\Controllers\Frontend\Auth;

use Auth;
use Session;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Models\CommissionSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Admin\SubordinateJoinningCommissionController;

class RegisterController extends Controller
{
    public function __construct() {
        $this->middleware('guest:web');
    }

    public function registerShow(Request $request){
        if(!Session::get('previous_url')){
            Session::put('previous_url',url()->previous());
        }

        $invitation_code = $request->invitation_code;
        return view('frontend.auth.register',compact('invitation_code'));
    }

    public function register(Request $request){
        $this->validate($request,[
            'phone_number'=>'required|digits:10|unique:users,phone_number',
            'password'=>'required|min:8|confirmed',
            'invite_code'=>'nullable|exists:users,user_id'
        ]);

        if($request->invite_code){
            $invite_code = $request->invite_code;
        }else{
            $invite_code = optional(User::first())->user_id;
        }

        $user_id = optional(User::latest('user_id')->first())->user_id;
        if(!$user_id){
            $user_id = 1000001;
        }else{
            $user_id = $user_id+1;
        }

        $user = new User;
        $user->user_id = $user_id;
        $user->phone_number = $request->phone_number;
        $user->invite_code = $invite_code;
        $user->password = Hash::make($request->password);
        $user->save();

        Auth::guard('web')->login($user);

        $url = Session::get('previous_url');
        Session::forget('previous_url');

        $joinning_bonus_setting = CommissionSetting::where('type','joinning')->where('status','1')->first();
        if($joinning_bonus_setting){
            $wallet = new Wallet;
            $wallet->user_id = $user->id;
            $wallet->type_id = $user->id;
            $wallet->amount = $joinning_bonus_setting->commission;
            $wallet->transaction_type = 'credit';
            $wallet->type = 'joinning_bonus';
            $wallet->save();

            $user = User::find($user->id);
            $user->total_wallet_amount = $user->total_wallet_amount + $wallet->amount;
            $user->save();
        }

        $commission_distribution = new SubordinateJoinningCommissionController;
        $commission_distribution->commissionDistribution($invite_code,$user->id);

        return response()->json(['url'=>$url,'message'=>'Registration Successfull!','status'=>200],200);
    }

}
