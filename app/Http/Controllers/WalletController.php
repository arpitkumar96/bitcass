<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{

    public function index(){
        $wallets = Wallet::where('user_id',Auth::guard('web')->user()->id)->latest()->get();

        return view('frontend.wallet',compact('wallets'));
    }

}
