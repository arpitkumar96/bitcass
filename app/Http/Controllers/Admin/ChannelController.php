<?php

namespace App\Http\Controllers\Admin;

use App\Models\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChannelController extends Controller
{
    function __construct(){
        $this->middleware('permission:payment_channel-list', ['only'=>['index']]);
        $this->middleware('permission:payment_channel-create', ['only'=>['store']]);
        $this->middleware('permission:payment_channel-edit', ['only'=>['edit','update']]);
        $this->middleware('permission:payment_channel-status', ['only'=>['show']]);
    }

    public function index(){
        $channels = Channel::latest()->get();

        return view('admin.channel.index',compact('channels'),['page_title'=>'Channel List']);
    }

    public function store(Request $request){
        $this->validate($request,[
            'payment_type_id'=>'required|integer|exists:payment_types,id',
            'name'=>'required|max:100',
            'image'=>'required|mimes:png,jpg,jpeg,webp',
            'upi_id'=>'required',
        ]);

        $channel = new Channel;
        $channel->payment_type_id = $request->payment_type_id;
        $channel->name = $request->name;
        $channel->image = imageUpload($request->file('image'),'backend/assets/image/channels');
        $channel->upi_id = $request->upi_id;
        $channel->save();

        return back()->with('success','Channel Added Successfully!');
    }

    public function show(Request $request,$id){
        $channel = Channel::where('id',$id)->first();
        $channel->status = $request->status;
        $channel->save();

        return back()->with('success','Status Changed Successfully!');
    }

    public function edit($id){
        $edit_channel = Channel::where('id',$id)->first();
        $channels = Channel::latest()->get();

        return view('admin.channel.index',compact('edit_channel','channels'),['page_title'=>'Channel List']);
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'payment_type_id'=>'required|integer|exists:payment_types,id',
            'name'=>'required|max:100',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp',
            'upi_id'=>'required',
        ]);

        $channel = Channel::where('id',$id)->first();
        $channel->payment_type_id = $request->payment_type_id;
        $channel->name = $request->name;
        if($request->has('image')){
            $channel->image = imageUpload($request->file('image'),'backend/assets/image/channels');
        }
        $channel->upi_id = $request->upi_id;
        $channel->save();

        return redirect()->route('admin.channel.index')->with('success','Channel Updated Successfully!');
    }

}
