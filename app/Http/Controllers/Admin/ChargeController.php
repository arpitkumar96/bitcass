<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ChargeSetting;
use App\Http\Controllers\Controller;

class ChargeController extends Controller
{
    function __construct(){
        $this->middleware('permission:charges', ['only'=>['index','store']]);
    }

    public function index(){
        $charge_settings = ChargeSetting::pluck('amount','type');

        return view('admin.charge_setting.index',compact('charge_settings'),['page_title'=>'Charge Setting']);
    }

    public function store(Request $request){
        $this->validate($request,[
            'withdrawal_tds'        =>  'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'withdrawal_service'    =>  'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        ChargeSetting::updateorCreate([
            'type'=>'withdrawal_tds'
        ],[
            'amount'=>$request->withdrawal_tds
        ]);

        ChargeSetting::updateorCreate([
            'type'=>'withdrawal_service'
        ],[
            'amount'=>$request->withdrawal_service
        ]);

        return back()->with('success','Charges Updated Successfully!');
    }

}
