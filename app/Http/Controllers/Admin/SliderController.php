<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    function __construct(){
        $this->middleware('permission:slider', ['only'=>['index','store','edit','update','destroy']]);
    }

    public function index(){
        $sliders = Slider::latest()->get();

        return view('admin.slider.index',compact('sliders'),['page_title'=>'Sliders']);
    }

    public function store(Request $request){
        $this->validate($request,[
            'image'=>'required|mimes:png,jpg,jpeg,webp',
            'url'=>'nullable|url'
        ]);

        $slider = new Slider;
        $slider->image = imageUpload($request->file('image'),'backend/assets/image/sliders');
        $slider->url = $request->url;
        $slider->save();

        return back()->with('success','Slider Added Successfully!');
    }

    public function edit($id){
        $edit_slider = Slider::where('id',$id)->first();
        $sliders = Slider::latest()->get();

        return view('admin.slider.index',compact('edit_slider','sliders'),['page_title'=>'Sliders']);
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'image'=>'nullable|mimes:png,jpg,jpeg,webp',
            'url'=>'nullable|url'
        ]);

        $slider = Slider::where('id',$id)->first();
        if($request->has('image')){
            $slider->image = imageUpload($request->file('image'),'backend/assets/image/sliders');
        }
        $slider->url = $request->url;
        $slider->save();

        return redirect()->route('admin.slider.index')->with('success','Slider Updated Successfully!');
    }

    public function destroy($id){
        Slider::where('id',$id)->delete();

        return back()->with('error','Slider Deleted Successfully!');
    }

}
