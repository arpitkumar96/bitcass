<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GiftController extends Controller
{
    function __construct(){
        $this->middleware('permission:gift-list', ['only'=>['index']]);
        $this->middleware('permission:gift-create', ['only'=>['create','store']]);
        $this->middleware('permission:gift-edit', ['only'=>['edit','update']]);
        $this->middleware('permission:gift-delete', ['only'=>['destroy']]);
        $this->middleware('permission:gift-status', ['only'=>['show']]);
    }

    public function index(Request $request){
        $gifts = Gift::latest()->paginate(10);

        return view('admin.gift.index',compact('gifts'),['page_title'=>'Gift List']);
    }

    public function create(){
        return view('admin.gift.create',['page_title'=>'Add Gift']);
    }

    public function store(Request $request){
        $input = $request;
        $input['start_date'] = date('Y-m-d',strtotime($request->start_date));
        $input['end_date'] = date('Y-m-d',strtotime($request->end_date));

        $this->validate($input,[
            'code'=>'required|unique:gifts,code',
            'name'=>'required',
            'start_date'=>'required|date_format:Y-m-d',
            'end_date'=>'required|date_format:Y-m-d',
            'amount'=>'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp',
            'usage_limitation'=>'required|in:limited,unlimited',
            'number_of_usage'=>'nullable|required_if:usage_limitation,limited|numeric',
        ]);

        $gift = new Gift;
        $gift->code = $request->code;
        $gift->name = $request->name;
        $gift->start_date = $request->start_date;
        $gift->end_date = $request->end_date;
        $gift->amount = $request->amount;
        $gift->image = imageUpload($request->image,'backend/assets/image/gifts');
        $gift->usage_limitation = $request->usage_limitation;
        $gift->number_of_usage = $request->number_of_usage;
        $gift->save();

        return redirect()->route('admin.gift.index')->with('success','Gift Added Successfully!');
    }

    public function show(Request $request,Gift $gift){
        $gift->is_active = $request->status;
        $gift->save();

        return back()->with('success','Gift Status Changed Successfully!');
    }

    public function edit(Gift $gift){
        return view('admin.gift.edit',compact('gift'),['page_title'=>'Edit Gift']);
    }

    public function update(Request $request,Gift $gift){
        $input = $request;
        $input['start_date'] = date('Y-m-d',strtotime($request->start_date));
        $input['end_date'] = date('Y-m-d',strtotime($request->end_date));

        $this->validate($input,[
            'name'=>'required',
            'start_date'=>'required|date_format:Y-m-d',
            'end_date'=>'required|date_format:Y-m-d',
            'amount'=>'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp',
        ]);

        $gift->name = $request->name;
        $gift->start_date = $request->start_date;
        $gift->end_date = $request->end_date;
        $gift->amount = $request->amount;
        if($request->has('image')){
            $gift->image = imageUpload($request->image,'backend/assets/image/gifts');
        }
        $gift->save();

        return redirect()->route('admin.gift.index')->with('success','Gift Updated Successfully!');
    }

    public function destroy(Gift $gift){
        $gift->delete();

        return back()->with('error','Gift Deleted Successfully!');
    }

}
