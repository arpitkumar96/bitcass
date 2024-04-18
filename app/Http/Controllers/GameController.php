<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\Game;
use App\Models\StartGame;
use Illuminate\Http\Request;
use App\Models\GameParticipation;

class GameController extends Controller
{

    public function index(Request $request,$game_slug){

        $game = Game::where('is_active','1')->where('slug',$game_slug)->with('subCategory.game')->first();

        $start_game = StartGame::where('is_running','1')->where('game_id',$game->id)->latest()->first();
        if($start_game){
            $last_game = StartGame::where('is_running','0')->where('game_id',$game->id)->latest()->first();
            $last_game_participation = GameParticipation::where('start_game_id',optional($last_game)->id)->where('user_id',Auth::guard('web')->user()->id)->with('startGame')->first();

            $remaining_time = gmdate("i:s", ($start_game->duration*60)-$start_game->created_at->diffInSeconds(Carbon::now()));

            $old_start_games = StartGame::where('is_running','0')->where('game_id',$game->id)->where('duration',$start_game->duration)->latest('id')->simplePaginate(10);
            if($request->ajax()){
                return response()->json(['view'=>view('frontend.game.game_history',compact('old_start_games'))->render()]);
            }
            return view('frontend.game.game',compact('game','start_game','remaining_time','old_start_games','last_game','last_game_participation'));
        }else{
            return redirect()->route('index');
        }

    }

    public function detail($game_id){
        $game = Game::where('is_active','1')->where('id',$game_id)->with('subCategory.game')->first();

        $start_game = StartGame::where('is_running','1')->where('game_id',$game->id)->latest()->first();

        $last_game = StartGame::where('is_running','0')->where('game_id',$game->id)->latest()->first();
        $last_game_participation = GameParticipation::where('start_game_id',optional($last_game)->id)->where('user_id',Auth::guard('web')->user()->id)->with('startGame')->first();

        $remaining_time = gmdate("i:s", ($start_game->duration*60)-$start_game->created_at->diffInSeconds(Carbon::now()));

        $old_start_games = StartGame::where('is_running','0')->where('game_id',$game->id)->where('duration',$start_game->duration)->latest('id')->simplePaginate(10);

        return response()->json(['view'=>view('frontend.game.running_game',compact('game','start_game','remaining_time','old_start_games','last_game','last_game_participation'))->render(),'remaining_time'=>$remaining_time]);
    }

    public function gameHistory($game_id){
        $old_start_games = StartGame::where('is_running','0')->where('game_id',$game_id)->latest('id')->simplePaginate(10);

        return response()->json(['view'=>view('frontend.game.game_history',compact('old_start_games'))->render()]);
    }

    public function gameChart($game_id){
        $old_start_games = StartGame::where('is_running','0')->where('game_id',$game_id)->latest('id')->take(100)->simplePaginate(10);

        return response()->json(['view'=>view('frontend.game.game_chart',compact('old_start_games'))->render()]);
    }

    public function userGameHistory($game_id){
        $game_participations = GameParticipation::where('user_id',Auth::guard('web')->user()->id)->whereHas('startGame',function($query) use ($game_id){
            $query->where('game_id',$game_id);
        })->with('startGame')->latest('id')->simplePaginate(10);

        return response()->json(['view'=>view('frontend.game.user_game_history',compact('game_participations'))->render()]);
    }

    public function getGameWalletSection(){
        return response()->json(['view'=>view('frontend.game.wallet_section')->render()]);
    }

    public function getCurrentWalletAmount(){
        return response()->json(['current_wallet_amount'=>Auth::guard('web')->user()->total_wallet_amount]);
    }

}
