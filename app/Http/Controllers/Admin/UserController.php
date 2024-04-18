<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    function __construct(){
        $this->middleware('permission:user-list', ['only'=>['index']]);
        $this->middleware('permission:user-block', ['only'=>['blockStatus']]);
    }

    public function index(Request $request){
        $search_start_date = $request->search_start_date;
        $search_end_date = $request->search_end_date;
        $search_invite_code = $request->search_invite_code;
        $search_key = $request->search_key;

        $users = User::with('invite');

        if($search_start_date){
            $d1=strtotime($search_start_date);
            $d2=strtotime($search_end_date);
            $da1=date('Y-m-d',$d1);
            $da2=date('Y-m-d',$d2);
            $startDate = Carbon::createFromFormat('Y-m-d', $da1)->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $da2)->endOfDay();

            $users = $users->whereBetween('created_at', [$startDate, $endDate]);
        }

        if($search_invite_code){
            $users = $users->where('invite_code',$search_invite_code);
        }

        if($search_key){
            $users = $users->where(function($query) use ($search_key){
                $query->where('name','LIKE','%'.$search_key.'%')->orWhere('phone_number',$search_key)->orWhere('user_id',$search_key);
            });
        }

        if($request->has('export')){
            $users = $users->latest()->get();

            return Excel::download(new UsersExport($users), 'users.xlsx');
        }
        $users = $users->latest()->paginate(10);

        if($request->ajax()){
            return view('admin.user.table',compact('users','search_start_date','search_end_date','search_key','search_invite_code'));
        }

        return view('admin.user.index',compact('users','search_start_date','search_end_date','search_key','search_invite_code'),['page_title'=>'User List']);
    }

    public function blockStatus($id,$status){
        $user = User::find($id);
        if($user){
            if($status == '1'){
                $user->block_status = '1';
                $user->save();

                return back()->with('error','User Blocked Successfully!');
            }elseif($status == '0'){
                $user->block_status = '0';
                $user->save();

                return back()->with('success','User Unblocked Successfully!');
            }
        }

        return back()->with('error','User Not Found!');
    }

}
