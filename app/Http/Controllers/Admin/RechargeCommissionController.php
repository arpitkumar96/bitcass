<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Commission;
use Illuminate\Http\Request;
use App\Models\CommissionValue;
use App\Models\CommissionSetting;
use App\Http\Controllers\Controller;
use App\Models\WalletRechargeRequest;

class RechargeCommissionController extends Controller
{

    public function commissionDistribution($user_id,$amount,$wallet_recharge_request_id){

        $first_recharge = WalletRechargeRequest::where('user_id',$user_id)->where('status','confirm')->latest()->first();
        if(!$first_recharge){
            $user = User::find($user_id);
            if($user){
                $first_recharge_commission_setting = CommissionSetting::where('type','first_recharge')->where('status','1')->first();
                if($first_recharge_commission_setting){
                    $commission_user_id = $user->invite_code;
                    for ($i=1; $i <= $first_recharge_commission_setting->tier; $i++) {
                        if($commission_user_id){
                            $commission_user = User::where('user_id',$commission_user_id)->first();
                        }else{
                            $commission_user = User::first();
                        }

                        $commission_value = CommissionValue::where('commission_setting_id',$first_recharge_commission_setting->id)->where('level',$commission_user->level)->where('tier',$i)->first();

                        $commission_amount = ($commission_value->commission*$amount)/100;

                        $commission = new Commission;
                        $commission->user_id = $commission_user->id;
                        $commission->type_id = $wallet_recharge_request_id;
                        $commission->commission = $commission_amount;
                        $commission->level = $commission_user->level;
                        $commission->tier = $i;
                        $commission->type = 'first_recharge';
                        $commission->save();

                        $wallet = new Wallet;
                        $wallet->user_id = $commission_user->id;
                        $wallet->type_id = $commission->id;
                        $wallet->amount = $commission_amount;
                        $wallet->transaction_type = 'credit';
                        $wallet->type = 'first_recharge_commission';
                        $wallet->save();

                        $commission_user->total_wallet_amount = $commission_user->total_wallet_amount + $commission_amount;
                        $commission_user->save();

                        $commission_user_id = $commission_user->invite_code;
                    }
                }

                $first_recharge_self_commission_setting = CommissionSetting::where('type','first_recharge_self')->where('status','1')->first();
                if($first_recharge_self_commission_setting){
                    $wallet = new Wallet;
                    $wallet->user_id = $user->id;
                    $wallet->type_id = $user->id;
                    if($first_recharge_self_commission_setting->method == 'percent'){
                        $commission_amount = ($amount*$first_recharge_self_commission_setting->commission)/100;
                    }else{
                        $commission_amount = $first_recharge_self_commission_setting->commission;
                    }
                    $wallet->amount = $commission_amount;
                    $wallet->transaction_type = 'credit';
                    $wallet->type = 'first_recharge_self_commission';
                    $wallet->save();

                    $user->total_wallet_amount = $user->total_wallet_amount + $commission_amount;
                    $user->save();
                }

                return ;
            }else{
                return ;
            }
        }

        $recharge_commission_setting = CommissionSetting::where('type','recharge')->where('status','1')->first();
        if($recharge_commission_setting){
            $user = User::find($user_id);
            if($user){
                $commission_user_id = $user->invite_code;
                for ($i=1; $i <= $recharge_commission_setting->tier; $i++) {
                    if($commission_user_id){
                        $commission_user = User::where('user_id',$commission_user_id)->first();
                    }else{
                        $commission_user = User::first();
                    }

                    $commission_value = CommissionValue::where('commission_setting_id',$recharge_commission_setting->id)->where('level',$commission_user->level)->where('tier',$i)->first();

                    $commission_amount = ($commission_value->commission*$amount)/100;

                    $commission = new Commission;
                    $commission->user_id = $commission_user->id;
                    $commission->type_id = $wallet_recharge_request_id;
                    $commission->commission = $commission_amount;
                    $commission->level = $commission_user->level;
                    $commission->tier = $i;
                    $commission->type = 'recharge';
                    $commission->save();

                    $wallet = new Wallet;
                    $wallet->user_id = $commission_user->id;
                    $wallet->type_id = $commission->id;
                    $wallet->amount = $commission_amount;
                    $wallet->transaction_type = 'credit';
                    $wallet->type = 'recharge_commission';
                    $wallet->save();

                    $commission_user->total_wallet_amount = $commission_user->total_wallet_amount + $commission_amount;
                    $commission_user->save();

                    $commission_user_id = $commission_user->invite_code;
                }

                return ;
            }else{
                return ;
            }
        }
    }

}
