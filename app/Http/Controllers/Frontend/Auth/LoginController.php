<?php

namespace App\Http\Controllers\Frontend\Auth;

use Auth;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct() {
        $this->middleware('guest:web', ['except' => ['logout']]);
    }

    public function loginShow(){
        if(!Session::get('previous_url')){
            Session::put('previous_url',url()->previous());
        }
        return view('frontend.auth.login');
    }

    public function login(Request $request){
        $this->validate($request,[
            'phone_number'=>'required|exists:users,phone_number',
            'password'=>'required|min:8'
        ]);

        $user  = User::where('phone_number',$request->phone_number)->first();
        if($user){
            if (Hash::check($request->password,$user->password)){
                Auth::guard('web')->login($user);
                $url = Session::get('previous_url');
                Session::forget('previous_url');

                $existingSession = DB::table('sessions')
                ->where('user_id', Auth::guard('web')->user()->id)
                ->where('id', '!=', session()->getId())
                ->delete();

                return response()->json(['url'=>$url,'message'=>'Login Successfull!','status'=>200],200);
            }else{
                return response()->json(['errors'=>['password'=>'Incorrect Password!']],422);
            }
        }
    }

    public function logout(){
        DB::table('sessions')
        ->where('user_id', Auth::guard('web')->user()->id)
        ->update(['user_id' => null]);
        Auth::guard('web')->logout();

        return redirect()->route('index');
    }

}
