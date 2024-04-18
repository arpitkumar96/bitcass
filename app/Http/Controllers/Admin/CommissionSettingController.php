<?php

namespace App\Http\Controllers\Admin;

use App\Models\LevelSetting;
use Illuminate\Http\Request;
use App\Models\CommissionValue;
use App\Models\CommissionSetting;
use App\Http\Controllers\Controller;

class CommissionSettingController extends Controller
{
    function __construct(){
        $this->middleware('permission:joinning-bonus', ['only'=>['joinningSetting','joinningSettingStore']]);
        $this->middleware('permission:subordinate_joinning-bonus', ['only'=>['subordinateJoinningSetting','subordinateJoinningTable','subordinateJoinningSettingStore']]);
        $this->middleware('permission:first_recharge_self-bonus', ['only'=>['firstRechargeSelfSetting','firstRechargeSelfSettingStore']]);
        $this->middleware('permission:first_recharge-commission', ['only'=>['firstRechargeSetting','firstRechargeTable','firstRechargeSettingStore']]);
        $this->middleware('permission:recharge-commission', ['only'=>['rechargeSetting','rechargeTable','rechargeSettingStore']]);
        $this->middleware('permission:game_play-commission', ['only'=>['gamePlaySetting','gamePlayTable','gamePlaySettingStore']]);
    }

    public function joinningSetting(){
        $joinning = CommissionSetting::where('type','joinning')->first();

        return view('admin.commission_setting.joinning',compact('joinning'),['page_title'=>'Joinning Bonus']);
    }

    public function joinningSettingStore(Request $request){
        $this->validate($request,[
            'commission'=>'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'status'=>'required|in:1,0'
        ]);

        CommissionSetting::updateOrCreate([
            'type'=>'joinning'
        ],[
            'commission'=>$request->commission,
            'method'=>'amount',
            'status'=>$request->status,
        ]);

        return back()->with('success','Joinning Bonus Updated Successfully!');
    }

    public function subordinateJoinningSetting(){
        $subordinate_joinning = CommissionSetting::where('type','subordinate_joinning')->first();
        $levels = LevelSetting::all();

        return view('admin.commission_setting.subordinate.index',compact('subordinate_joinning','levels'),['page_title'=>'Subordinate Joinning Bonus']);
    }

    public function subordinateJoinningTable(Request $request){
        $number_of_level = $request->number_of_level;
        $number_of_tier = $request->number_of_tier;

        $commission_setting = CommissionSetting::where('type','subordinate_joinning')->first();
        $commission_values = CommissionValue::where('commission_setting_id',optional($commission_setting)->id)->get();

        $final_array = array_chunk($commission_values->toArray(),$commission_setting?$commission_setting->tier:1);

        return response()->json(['view'=>view('admin.commission_setting.subordinate.table',compact('number_of_level','number_of_tier','commission_setting','commission_values','final_array'))->render()]);
    }

    public function subordinateJoinningSettingStore(Request $request){
        $this->validate($request,[
            'level'=>'required|integer',
            'tier'=>'required|integer',
            'status'=>'required|in:1,0',
        ]);

        $commission_setting = CommissionSetting::updateOrCreate([
            'type'=>'subordinate_joinning'
        ],[
            'level'=>$request->level,
            'tier'=>$request->tier,
            'method'=>'amount',
            'status'=>$request->status,
        ]);
        CommissionValue::where('commission_setting_id',$commission_setting->id)->delete();
        for ($i=0; $i <= $request->level; $i++) {
            for ($j=1; $j <= $request->tier; $j++) {
                $commission_value = CommissionValue::where('commission_setting_id',$commission_setting->id)->where('level',$i)->where('tier',$j)->first();
                if(!$commission_value){
                    $commission_value = new CommissionValue;
                    $commission_value->commission_setting_id = $commission_setting->id;
                    $commission_value->level = $i;
                    $commission_value->tier = $j;
                }
                $tier = 'tier_'.$j;
                $commission_value->commission = $request->$tier[$i]??0;
                $commission_value->save();
            }
        }

        return back()->with('success','Subordinate Joinning Commission Updated Successfully!');
    }

    public function firstRechargeSetting(){
        $first_recharge = CommissionSetting::where('type','first_recharge')->first();
        $levels = LevelSetting::all();

        return view('admin.commission_setting.first_recharge.index',compact('first_recharge','levels'),['page_title'=>'First Recharge Bonus']);
    }

    public function firstRechargeTable(Request $request){
        $number_of_level = $request->number_of_level;
        $number_of_tier = $request->number_of_tier;

        $commission_setting = CommissionSetting::where('type','first_recharge')->first();
        $commission_values = CommissionValue::where('commission_setting_id',optional($commission_setting)->id)->get();

        $final_array = array_chunk($commission_values->toArray(),$commission_setting?$commission_setting->tier:1);

        return response()->json(['view'=>view('admin.commission_setting.first_recharge.table',compact('number_of_level','number_of_tier','commission_setting','commission_values','final_array'))->render()]);
    }

    public function firstRechargeSettingStore(Request $request){
        $this->validate($request,[
            'level'=>'required|integer',
            'tier'=>'required|integer',
            'status'=>'required|in:1,0',
        ]);

        $commission_setting = CommissionSetting::updateOrCreate([
            'type'=>'first_recharge'
        ],[
            'level'=>$request->level,
            'tier'=>$request->tier,
            'method'=>'percent',
            'status'=>$request->status,
        ]);
        CommissionValue::where('commission_setting_id',$commission_setting->id)->delete();
        for ($i=0; $i <= $request->level; $i++) {
            for ($j=1; $j <= $request->tier; $j++) {
                $commission_value = CommissionValue::where('commission_setting_id',$commission_setting->id)->where('level',$i)->where('tier',$j)->first();
                if(!$commission_value){
                    $commission_value = new CommissionValue;
                    $commission_value->commission_setting_id = $commission_setting->id;
                    $commission_value->level = $i;
                    $commission_value->tier = $j;
                }
                $tier = 'tier_'.$j;
                $commission_value->commission = $request->$tier[$i]??0;
                $commission_value->save();
            }
        }

        return back()->with('success','First Recharge Commission Updated Successfully!');
    }

    public function firstRechargeSelfSetting(){
        $first_recharge_self = CommissionSetting::where('type','first_recharge_self')->first();

        return view('admin.commission_setting.first_recharge_self',compact('first_recharge_self'),['page_title'=>'First Recharge Self']);
    }

    public function firstRechargeSelfSettingStore(Request $request){
        $this->validate($request,[
            'commission'=>'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'status'=>'required|in:1,0'
        ]);

        CommissionSetting::updateOrCreate([
            'type'=>'first_recharge_self'
        ],[
            'commission'=>$request->commission,
            'method'=>$request->method,
            'status'=>$request->status,
        ]);

        return back()->with('success','First Recharge Self Updated Successfully!');
    }

    public function rechargeSetting(){
        $recharge = CommissionSetting::where('type','recharge')->first();
        $levels = LevelSetting::all();

        return view('admin.commission_setting.recharge.index',compact('recharge','levels'),['page_title'=>'Recharge Bonus']);
    }

    public function rechargeTable(Request $request){
        $number_of_level = $request->number_of_level;
        $number_of_tier = $request->number_of_tier;

        $commission_setting = CommissionSetting::where('type','recharge')->first();
        $commission_values = CommissionValue::where('commission_setting_id',optional($commission_setting)->id)->get();

        $final_array = array_chunk($commission_values->toArray(),$commission_setting?$commission_setting->tier:1);

        return response()->json(['view'=>view('admin.commission_setting.recharge.table',compact('number_of_level','number_of_tier','commission_setting','commission_values','final_array'))->render()]);
    }

    public function rechargeSettingStore(Request $request){
        $this->validate($request,[
            'level'=>'required|integer',
            'tier'=>'required|integer',
            'status'=>'required|in:1,0',
        ]);

        $commission_setting = CommissionSetting::updateOrCreate([
            'type'=>'recharge'
        ],[
            'level'=>$request->level,
            'tier'=>$request->tier,
            'method'=>'percent',
            'status'=>$request->status,
        ]);
        CommissionValue::where('commission_setting_id',$commission_setting->id)->delete();
        for ($i=0; $i <= $request->level; $i++) {
            for ($j=1; $j <= $request->tier; $j++) {
                $commission_value = CommissionValue::where('commission_setting_id',$commission_setting->id)->where('level',$i)->where('tier',$j)->first();
                if(!$commission_value){
                    $commission_value = new CommissionValue;
                    $commission_value->commission_setting_id = $commission_setting->id;
                    $commission_value->level = $i;
                    $commission_value->tier = $j;
                }
                $tier = 'tier_'.$j;
                $commission_value->commission = $request->$tier[$i]??0;
                $commission_value->save();
            }
        }

        return back()->with('success','Recharge Commission Updated Successfully!');
    }

    public function gamePlaySetting(){
        $game_play = CommissionSetting::where('type','game_play')->first();
        $levels = LevelSetting::all();

        return view('admin.commission_setting.game_play.index',compact('game_play','levels'),['page_title'=>'Game Play Bonus']);
    }

    public function gamePlayTable(Request $request){
        $number_of_level = $request->number_of_level;
        $number_of_tier = $request->number_of_tier;

        $commission_setting = CommissionSetting::where('type','game_play')->first();
        $commission_values = CommissionValue::where('commission_setting_id',optional($commission_setting)->id)->get();

        $final_array = array_chunk($commission_values->toArray(),$commission_setting?$commission_setting->tier:1);

        return response()->json(['view'=>view('admin.commission_setting.game_play.table',compact('number_of_level','number_of_tier','commission_setting','commission_values','final_array'))->render()]);
    }

    public function gamePlaySettingStore(Request $request){
        $this->validate($request,[
            'level'=>'required|integer',
            'tier'=>'required|integer',
            'status'=>'required|in:1,0',
        ]);

        $commission_setting = CommissionSetting::updateOrCreate([
            'type'=>'game_play'
        ],[
            'level'=>$request->level,
            'tier'=>$request->tier,
            'method'=>'percent',
            'status'=>$request->status,
        ]);
        CommissionValue::where('commission_setting_id',$commission_setting->id)->delete();
        for ($i=0; $i <= $request->level; $i++) {
            for ($j=1; $j <= $request->tier; $j++) {
                $commission_value = CommissionValue::where('commission_setting_id',$commission_setting->id)->where('level',$i)->where('tier',$j)->first();
                if(!$commission_value){
                    $commission_value = new CommissionValue;
                    $commission_value->commission_setting_id = $commission_setting->id;
                    $commission_value->level = $i;
                    $commission_value->tier = $j;
                }
                $tier = 'tier_'.$j;
                $commission_value->commission = $request->$tier[$i]??0;
                $commission_value->save();
            }
        }

        return back()->with('success','Game Play Updated Successfully!');
    }

}
