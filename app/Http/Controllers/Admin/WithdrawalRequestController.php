<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Models\ChargeSetting;
use App\Exports\WithdrawalExport;
use App\Models\WithdrawalRequest;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class WithdrawalRequestController extends Controller
{
    function __construct(){
        $this->middleware('permission:withdrawal_request-list', ['only'=>['index']]);
        $this->middleware('permission:withdrawal_request-approval', ['only'=>['status']]);
    }

    public function index(Request $request){
        $search_start_date = $request->search_start_date;
        $search_end_date = $request->search_end_date;
        $search_amount = $request->search_amount;
        $search_status = $request->search_status;
        $search_key = $request->search_key;

        $withdrawal_requests = WithdrawalRequest::latest('id');

        if($search_start_date){
            $d1=strtotime($search_start_date);
            $d2=strtotime($search_end_date);
            $da1=date('Y-m-d',$d1);
            $da2=date('Y-m-d',$d2);
            $startDate = Carbon::createFromFormat('Y-m-d', $da1)->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $da2)->endOfDay();

            $withdrawal_requests = $withdrawal_requests->whereBetween('created_at', [$startDate, $endDate]);
        }

        if($search_amount){
            $withdrawal_requests = $withdrawal_requests->where('amount','>=',$search_amount);
        }

        if($search_status){
            $withdrawal_requests = $withdrawal_requests->where('status',$search_status);
        }

        if($search_key){
            $withdrawal_requests = $withdrawal_requests->whereHas('user',function($q) use ($search_key){
                $q->where('user_id',$search_key)->orWhere('phone_number',$search_key);
            })->orWhere(function($query) use ($search_key){
                $query->where('withdrawal_request_id',$search_key);
            });
        }
        if($request->has('export')){
            $withdrawal_requests = $withdrawal_requests->with('user')->get();

            return Excel::download(new WithdrawalExport($withdrawal_requests), 'withdrawals.xlsx');
        }
        $withdrawal_requests = $withdrawal_requests->with('user.bankDetail')->paginate(10);

        if($request->ajax()){
            return view('admin.withdrawal_request.table',compact('withdrawal_requests','search_start_date','search_end_date','search_amount','search_status','search_key'));
        }

        return view('admin.withdrawal_request.index',compact('withdrawal_requests','search_start_date','search_end_date','search_amount','search_status','search_key'),['page_title'=>'Withdrawal Request']);
    }

    public function status(Request $request,$id){
        $this->validate($request,[
            'status'=>'required|in:success,cancel'
        ]);


        $withdrawal_request = WithdrawalRequest::where('status','pending')->where('id',$id)->first();

        $user = User::where('id',$withdrawal_request->user_id)->first();

        $available_balance = $user->total_wallet_amount;
        if($user->block_status == '1'){
            return back()->with('error','User is Blocked');
        }
        if($withdrawal_request){
            if($request->status == 'success'){
                if($available_balance < $withdrawal_request->amount){
                    return back()->with('error','User Have Insufficiant Balance!');
                }

                $charge_settings = ChargeSetting::pluck('amount','type');

                if(isset($charge_settings['withdrawal_tds'])){
                    $tds_charge_percent = $charge_settings['withdrawal_tds'];
                }else{
                    $tds_charge_percent = 0;
                }

                if(isset($charge_settings['withdrawal_service'])){
                    $service_charge_percent = $charge_settings['withdrawal_service'];
                }else{
                    $service_charge_percent = 0;
                }

                $service_charge = ($service_charge_percent*$withdrawal_request->amount)/100;
                $after_service_deduction = $withdrawal_request->amount-$service_charge;
                $tds_charge = ($tds_charge_percent*$after_service_deduction)/100;
                $final_amount =  ($withdrawal_request->amount - $service_charge) - $tds_charge;

                $withdrawal_request->tds_charge = $tds_charge;
                $withdrawal_request->service_charge = $service_charge;
                $withdrawal_request->final_amount = $final_amount;
                $withdrawal_request->remark = $request->remark;
                $withdrawal_request->save();

                $wallet = new Wallet;
                $wallet->user_id = $withdrawal_request->user_id;
                $wallet->type_id = $withdrawal_request->id;
                $wallet->amount = $final_amount;
                $wallet->transaction_type = 'debit';
                $wallet->type = 'withdrawal';
                $wallet->save();

                $user->total_wallet_amount = $user->total_wallet_amount - $final_amount;
                $user->save();
            }
            $withdrawal_request->status = $request->status;
            $withdrawal_request->remark = $request->remark;
            $withdrawal_request->save();

            return back()->with('success','Status Changed Successfully!');
        }else{
            return back()->with('error','Request Not Found!');
        }
    }

    public function detail(Request $request){
        $status = $request->status;
        $withdrawal_request = WithdrawalRequest::where('status','pending')->where('id',$request->id)->first();
        if($withdrawal_request){
            return response()->json(['view'=>view('admin.withdrawal_request.modal_detail',compact('withdrawal_request','status'))->render()]);
        }else{
            return response()->json(['message'=>'Invalid withdrawal Request!'],422);
        }
    }

}
