<?php

namespace App\Http\Controllers\Admin;

use App\Models\LevelSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LevelSettingController extends Controller
{
    function __construct(){
        $this->middleware('permission:level-setting', ['only'=>['levelSetting','levelSettingStore','levelSettingEdit','levelSettingUpdate','levelSettingDelete']]);
    }

    public function levelSetting(){
        $level_settings = LevelSetting::all();

        return view('admin.commission_setting.level_setting',compact('level_settings'),['page_title'=>'Level Setting']);
    }

    public function levelSettingStore(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp',
            'team_number'=>'required|integer',
            'team_betting'=>'required|integer',
            'team_deposite'=>'required|integer',
        ]);
        $level_setting_count = LevelSetting::count();

        if($level_setting_count == 0){
            $current_level = 0;
        }else{
            $current_level = $level_setting_count;
        }

        $level_setting = new LevelSetting;
        $level_setting->level = $current_level;
        $level_setting->name = $request->name;
        $level_setting->image = imageUpload($request->file('image'),'backend/assets/image/level_settings');
        $level_setting->team_number = $request->team_number;
        $level_setting->team_betting = $request->team_betting;
        $level_setting->team_deposite = $request->team_deposite;
        $level_setting->save();

        return back()->with('success','Level Added Successfully!');
    }

    public function levelSettingEdit($id){
        $level_settings = LevelSetting::all();
        $edit_level_setting = LevelSetting::where('id',$id)->first();

        return view('admin.commission_setting.level_setting',compact('level_settings','edit_level_setting'),['page_title'=>'Level Setting']);
    }

    public function levelSettingUpdate(Request $request,$id){
        $level_setting_count = LevelSetting::count();

        $level_setting = LevelSetting::where('id',$id)->first();
        $level_setting->name = $request->name;
        if($request->has('image')){
            $level_setting->image = imageUpload($request->file('image'),'backend/assets/image/level_settings');
        }
        $level_setting->team_number = $request->team_number;
        $level_setting->team_betting = $request->team_betting;
        $level_setting->team_deposite = $request->team_deposite;
        $level_setting->save();

        return redirect()->route('admin.level.setting')->with('success','Level Updated Successfully!');
    }

    public function levelSettingDelete($id){
        return back()->with('error','You can not delete!');
    }

}
