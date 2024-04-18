<?php

namespace App\Http\Controllers\Admin;

use App\Models\Support;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupportController extends Controller
{
    function __construct(){
        $this->middleware('permission:support', ['only'=>['index','store','edit','update','destroy']]);
    }

    public function index(){
        $supports = Support::latest()->get();

        return view('admin.support.index',compact('supports'),['page_title'=>'Supports']);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'image'=>'required|mimes:png,jpg,jpeg,webp',
            'url'=>'required|url'
        ]);

        $support = new Support;
        $support->name = $request->name;
        $support->image = imageUpload($request->file('image'),'backend/assets/image/supports');
        $support->url = $request->url;
        $support->save();

        return back()->with('success','Support Added Successfully!');
    }

    public function edit($id){
        $edit_support = Support::where('id',$id)->first();
        $supports = Support::latest()->get();

        return view('admin.support.index',compact('edit_support','supports'),['page_title'=>'Supports']);
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'name'=>'required',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp',
            'url'=>'required|url'
        ]);

        $support = Support::where('id',$id)->first();
        if($request->has('image')){
            $support->image = imageUpload($request->file('image'),'backend/assets/image/supports');
        }
        $support->url = $request->url;
        $support->save();

        return redirect()->route('admin.support.index')->with('success','Support Updated Successfully!');
    }

    public function destroy($id){
        Support::where('id',$id)->delete();

        return back()->with('error','Support Deleted Successfully!');
    }

}
