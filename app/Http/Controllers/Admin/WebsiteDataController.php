<?php

namespace App\Http\Controllers\Admin;

use App\Models\WebsiteData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebsiteDataController extends Controller
{
    function __construct(){
        $this->middleware('permission:website-data', ['only'=>['index','store']]);
        $this->middleware('permission:startup-notification', ['only'=>['startupNotification','startupNotificationStore']]);
    }

    public function index(){
        $website_data = WebsiteData::pluck('data','type');

        return view('admin.website_data.index',compact('website_data'),['page_title'=>'Website Data']);
    }

    public function store(Request $request){
        if($request->has('logo')){
            WebsiteData::updateOrCreate([
                'type'=>'logo'
            ],[
                'data'=>imageUpload($request->logo,'backend/assets/image/website_data')
            ]);
        }

        if($request->has('small_logo')){
            WebsiteData::updateOrCreate([
                'type'=>'small_logo'
            ],[
                'data'=>imageUpload($request->small_logo,'backend/assets/image/website_data')
            ]);
        }

        if($request->has('favicon')){
            WebsiteData::updateOrCreate([
                'type'=>'favicon'
            ],[
                'data'=>imageUpload($request->favicon,'backend/assets/image/website_data')
            ]);
        }

        return back()->with('success','Data Updated Successfully!');
    }

    public function startupNotification(){
        $notification = WebsiteData::where('type','startup_notification')->first();

        return view('admin.website_data.startup_notification',compact('notification'),['page_title'=>'Startup Notification']);
    }

    public function startupNotificationStore(Request $request){
        WebsiteData::updateOrCreate([
            'type'=>'startup_notification'
        ],[
            'data'=>$request->startup_notification,
            'status'=>$request->status_val,
        ]);

        return back()->with('success','Data Updated Successfully!');
    }

}
