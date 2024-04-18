<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class WithdrawalExport implements FromView
{
    public function __construct($withdrawal_requests){
        $this->withdrawal_requests=$withdrawal_requests;
    }

    public function view():View{
        return view('admin.withdrawal_request.export',['withdrawal_requests'=>$this->withdrawal_requests]);
    }
}
