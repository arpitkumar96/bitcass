<?php

namespace App\Http\Controllers\Admin;

use App\Models\PaymentType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentTypeController extends Controller
{
    function __construct(){
        $this->middleware('permission:payment_type-list', ['only'=>['index']]);
        $this->middleware('permission:payment_type-create', ['only'=>['store']]);
        $this->middleware('permission:payment_type-edit', ['only'=>['edit','update']]);
        $this->middleware('permission:payment_type-status', ['only'=>['show']]);
    }

    public function index(){
        $payment_types = PaymentType::latest()->get();

        return view('admin.payment_type.index',compact('payment_types'),['page_title'=>'Payment Type List']);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|max:100',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp',
        ]);

        $payment_type = new PaymentType;
        $payment_type->name = $request->name;
        $payment_type->image = imageUpload($request->file('image'),'backend/assets/image/payment_types');
        $payment_type->save();

        return back()->with('success','Payment Type Added Successfully!');
    }

    public function show(Request $request,$id){
        $payment_type = PaymentType::where('id',$id)->first();
        $payment_type->status = $request->status;
        $payment_type->save();

        return back()->with('success','Payment Type Status Changed Successfully!');
    }

    public function edit($id){
        $edit_payment_type = PaymentType::where('id',$id)->first();
        $payment_types = PaymentType::latest()->get();

        return view('admin.payment_type.index',compact('edit_payment_type','payment_types'),['page_title'=>'Payment Type List']);
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'name'=>'required|max:100',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp',
        ]);

        $payment_type = PaymentType::where('id',$id)->first();
        $payment_type->name = $request->name;
        if($request->has('image')){
            $payment_type->image = imageUpload($request->file('image'),'backend/assets/image/payment_types');
        }
        $payment_type->save();

        return redirect()->route('admin.payment-type.index')->with('success','Payment Type Updated Successfully!');
    }

}
