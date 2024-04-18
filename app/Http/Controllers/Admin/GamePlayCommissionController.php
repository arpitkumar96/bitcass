<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Commission;
use Illuminate\Http\Request;
use App\Models\CommissionValue;
use App\Models\CommissionSetting;
use App\Http\Controllers\Controller;

class GamePlayCommissionController extends Controller
{

    public function commissionDistribution($commission_user_id,$final_game_participant_id,$amount){
        $game_play_commission_setting = CommissionSetting::where('type','game_play')->where('status','1')->first();
        if($game_play_commission_setting){
            for ($i=1; $i <= $game_play_commission_setting->tier; $i++) {
                if($commission_user_id){
                    $commission_user = User::where('user_id',$commission_user_id)->first();
                }else{
                    $commission_user = User::first();
                }

                $commission_value = CommissionValue::where('commission_setting_id',$game_play_commission_setting->id)->where('level',$commission_user->level)->where('tier',$i)->first();

                $commission_amount = ($commission_value->commission*$amount)/100;

                $commission = new Commission;
                $commission->user_id = $commission_user->id;
                $commission->type_id = $final_game_participant_id;
                $commission->commission = $commission_amount;
                $commission->level = $commission_user->level;
                $commission->tier = $i;
                $commission->type = 'game_play';
                $commission->save();

                $wallet = new Wallet;
                $wallet->user_id = $commission_user->id;
                $wallet->type_id = $commission->id;
                $wallet->amount = $commission_amount;
                $wallet->transaction_type = 'credit';
                $wallet->type = 'game_play_commission';
                $wallet->save();

                $commission_user->total_wallet_amount = $commission_user->total_wallet_amount + $commission_amount;
                $commission_user->save();

                $commission_user_id = $commission_user->invite_code;
            }
        }
    }

}
