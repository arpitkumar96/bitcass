<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\BankDetail;
use Illuminate\Http\Request;

class BankDetailController extends Controller
{

    public function index(){
        return view('frontend.bank_detail');
    }

    public function store(Request $request){
        $this->validate($request,[
            'bank_name'=>'required',
            'account_number'=>'required',
            'phone_number'=>'required|digits:10',
            'email'=>'required|email',
            'ifsc_code'=>'required',
        ]);
        $bank_detail = BankDetail::where('user_id',Auth::guard('web')->user()->id)->first();
        if(!$bank_detail){
            $bank_detail = new BankDetail;
            $bank_detail->user_id = Auth::guard('web')->user()->id;
        }
        $bank_detail->bank_name = $request->bank_name;
        $bank_detail->account_number = $request->account_number;
        $bank_detail->phone_number = $request->phone_number;
        $bank_detail->email = $request->email;
        $bank_detail->ifsc_code = $request->ifsc_code;
        $bank_detail->save();

        return redirect()->route('user.withdrawl');

    }

}
