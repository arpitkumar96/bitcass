<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Commission;
use Illuminate\Http\Request;
use App\Models\CommissionValue;
use App\Models\CommissionSetting;
use App\Http\Controllers\Controller;

class SubordinateJoinningCommissionController extends Controller
{

    public function commissionDistribution($commission_user_id,$user_id){
        $subordinate_joinning_bonus_setting = CommissionSetting::where('type','subordinate_joinning')->where('status','1')->first();
        if($subordinate_joinning_bonus_setting){
            for ($i=1; $i <= $subordinate_joinning_bonus_setting->tier; $i++) {
                if($commission_user_id){
                    $commission_user = User::where('user_id',$commission_user_id)->first();
                }else{
                    $commission_user = User::first();
                }

                $commission_value = CommissionValue::where('commission_setting_id',$subordinate_joinning_bonus_setting->id)->where('level',$commission_user->level)->where('tier',$i)->first();

                $commission = new Commission;
                $commission->user_id = $commission_user->id;
                $commission->type_id = $user_id;
                $commission->commission = $commission_value->commission;
                $commission->level = $commission_user->level;
                $commission->tier = $i;
                $commission->type = 'subordinate_joinning';
                $commission->save();

                $wallet = new Wallet;
                $wallet->user_id = $commission_user->id;
                $wallet->type_id = $commission->id;
                $wallet->amount = $commission_value->commission;
                $wallet->transaction_type = 'credit';
                $wallet->type = 'subordinate_joinning_bonus';
                $wallet->save();

                $commission_user->total_wallet_amount = $commission_user->total_wallet_amount + $commission_value->commission;
                $commission_user->save();

                $commission_user_id = $commission_user->invite_code;
            }
        }
    }

}
