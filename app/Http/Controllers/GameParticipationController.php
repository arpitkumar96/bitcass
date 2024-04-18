<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Models\GameParticipation;

class GameParticipationController extends Controller
{

    public function store(Request $request){
        $bet_amount = $request->balance * $request->quantity;
        $total_wallet_amount = Auth::guard('web')->user()->total_wallet_amount;
        if($bet_amount <= $total_wallet_amount){
            $game_participation = new GameParticipation;
            $game_participation->start_game_id = $request->start_game_id;
            $game_participation->user_id = Auth::guard('web')->user()->id;
            $game_participation->type = $request->type;
            $game_participation->data = $request->data;
            $game_participation->amount = $bet_amount;
            $game_participation->handling_fee = (($request->balance*2)/100) * $request->quantity;
            $game_participation->final_amount = ($request->balance - ($request->balance*2)/100) * $request->quantity;
            $game_participation->quantity = $request->quantity;
            $game_participation->save();

            $wallet = new Wallet;
            $wallet->user_id = Auth::guard('web')->user()->id;
            $wallet->type_id = $game_participation->id;
            $wallet->amount = $bet_amount;
            $wallet->transaction_type = 'debit';
            $wallet->type = 'bet';
            $wallet->save();

            $user = User::where('id',Auth::guard('web')->user()->id)->first();
            $user->total_wallet_amount = $user->total_wallet_amount - $bet_amount;
            $user->save();
        }else{
            return response()->json(['message'=>'You Have Insufficiant Balance!'],422);
        }

    }

}
