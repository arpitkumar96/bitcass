<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{

    public function index(){
        $supports = Support::latest()->get();

        return view('frontend.support',compact('supports'));
    }

}
