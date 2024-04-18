<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromView
{

    public function __construct($users){
        $this->users=$users;
    }

    public function view():View{
        return view('admin.user.export',['users'=>$this->users]);
    }
}
