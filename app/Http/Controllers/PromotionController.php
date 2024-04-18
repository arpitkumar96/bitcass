<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Commission;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    public function index(){
        $total_direct_subordinate = User::where('invite_code',Auth::guard('web')->user()->user_id)->count();
        $total_yesterday_commission = Commission::where('user_id',Auth::guard('web')->user()->id)->whereDate('created_at',Carbon::yesterday())->sum('commission');

        $sub_ordinates = User::where('invite_code',Auth::guard('web')->user()->user_id)->withCount('subordinate')->get();
        $users = User::where('invite_code',Auth::guard('web')->user()->user_id)->withCount('commission')->withSum('commission','commission')->get();

        $total_indirect_subordinate = $sub_ordinates->sum(function ($sub_ordinates) {
            return $sub_ordinates->subordinate_count;
        });

        $total_direct_deposite_amount = $users->sum(function ($users) {
            return $users->commission_sum_commission;
        });

        $total_direct_deposite_count = $users->sum(function ($users) {
            return $users->commission_count;
        });

        return view('frontend.pramotion',compact('total_direct_subordinate','total_yesterday_commission','total_indirect_subordinate','total_direct_deposite_amount','total_direct_deposite_count'));
    }

    public function teamReport(Request $request){
        $teams = User::where('invite_code',Auth::guard('web')->user()->user_id)->withSum(['deposite'=>function($query){
            $query->where('status','confirm');
        }],'amount')->withCount(['deposite'=>function($query){
            $query->where('status','confirm');
        }])->withSum('gameParticipation','amount')->withCount('gameParticipation')->withSum('commission','commission')->get();

        $deposite_sum = $teams->sum(function ($teams) {
            return $teams->deposite_sum_amount;
        });

        $deposite_count = $teams->count(function ($teams) {
            return $teams->deposite_count;
        });

        $game_participation_sum = $teams->sum(function ($teams) {
            return $teams->game_participation_sum_amount;
        });

        $game_participation_count = $teams->count(function ($teams) {
            return $teams->game_participation_count;
        });

        return view('frontend.team_report',compact('teams','deposite_sum','deposite_count','game_participation_sum','game_participation_count'));
    }

    public function pramotionShare(){
        return view('frontend.pramotion_share');
    }
}
