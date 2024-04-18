<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityBanner;

class ActivityController extends Controller
{

    public function index(){
        $activity_banners = ActivityBanner::latest()->get();

        return view('frontend.activity',compact('activity_banners'));
    }

}
