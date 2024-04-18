<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Game;
use App\Models\StartGame;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlayedGameController extends Controller
{
    function __construct(){
        $this->middleware('permission:game-played', ['only'=>['index']]);
    }

    public function index(Request $request,$game_slug){
        $search_key = $request->search_key;
        $search_start_date = $request->search_start_date;
        $search_end_date = $request->search_end_date;
        $game = Game::where('slug',$game_slug)->first();

        $played_games = StartGame::where('game_id',$game->id);

        if($search_start_date){
            $d1=strtotime($search_start_date);
            $d2=strtotime($search_end_date);
            $da1=date('Y-m-d',$d1);
            $da2=date('Y-m-d',$d2);
            $startDate = Carbon::createFromFormat('Y-m-d', $da1)->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $da2)->endOfDay();

            $played_games = $played_games->whereBetween('created_at', [$startDate, $endDate]);
        }

        if($search_key){
            $played_games = $played_games->where('start_game_id',$search_key);
        }

        $played_games = $played_games->withCount('gameParticipation')->withSum('gameParticipation','amount')->withSum('gameParticipation','win_amount')->latest()->paginate(10);

        if($request->ajax()){
            return view('admin.played_game.table',compact('game','search_key','played_games','search_start_date','search_end_date'));
        }

        return view('admin.played_game.index',compact('game','search_key','played_games','search_start_date','search_end_date'),['page_title'=>'Played Game']);
    }

}
