<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ActivityBanner;
use App\Http\Controllers\Controller;

class ActivityBannerController extends Controller
{
    function __construct(){
        $this->middleware('permission:activity_banner-list', ['only'=>['index']]);
        $this->middleware('permission:activity_banner-create', ['only'=>['create','store']]);
        $this->middleware('permission:activity_banner-edit', ['only'=>['edit','update']]);
        $this->middleware('permission:activity_banner-delete', ['only'=>['destroy']]);
    }

    public function index(Request $request){
        $activity_banners = ActivityBanner::latest()->paginate(10);

        if($request->ajax()){
            return view('admin.activity_banner.table',compact('activity_banners'));
        }

        return view('admin.activity_banner.index',compact('activity_banners'),['page_title'=>'Activity Banner List']);
    }

    public function create(){
        return view('admin.activity_banner.create',['page_title'=>'Add Activity Banner']);
    }

    public function store(Request $request){
        $request->validate([
            'image'=>'required|mimes:png,jpg,jpeg,webp',
            'name'=>'required',
            'url'=>'nullable|url'
        ]);

        $activity_banner = new ActivityBanner;
        $activity_banner->image = imageUpload($request->image,'backend/assets/image/activity_banners');
        $activity_banner->name = $request->name;
        $activity_banner->url = $request->url;
        $activity_banner->save();

        return redirect()->route('admin.activity-banner.index')->with('success','Activity Banner Added Successfully!');
    }

    public function edit(ActivityBanner $activity_banner){
        return view('admin.activity_banner.edit',compact('activity_banner'),['page_title'=>'Edit Activity Banner']);
    }

    public function update(Request $request,ActivityBanner $activity_banner){
        $request->validate([
            'image'=>'nullable|mimes:png,jpg,jpeg,webp',
            'name'=>'required',
            'url'=>'nullable|url'
        ]);

        if($request->has('image')){
            $activity_banner->image = imageUpload($request->image,'backend/assets/image/activity_banners');
        }
        $activity_banner->name = $request->name;
        $activity_banner->url = $request->url;
        $activity_banner->save();

        return redirect()->route('admin.activity-banner.index')->with('success','Activity Banner Updated Successfully!');
    }

    public function destroy(ActivityBanner $activity_banner){
        $activity_banner->delete();

        return back()->with('error','Activity Banner Deleted Successfully!');
    }

}
