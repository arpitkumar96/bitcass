<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class RechargeExport implements FromView
{
    public function __construct($wallet_recharge_requests){
        $this->wallet_recharge_requests=$wallet_recharge_requests;
    }

    public function view():View{
        return view('admin.wallet_recharge_request.export',['wallet_recharge_requests'=>$this->wallet_recharge_requests]);
    }
}
