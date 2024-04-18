<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Game;
use App\Models\GameCategory;
use Illuminate\Http\Request;
use App\Models\GameParticipation;

class BetHistoryController extends Controller
{

    public function index(Request $request){
        $search_game_category = $request->search_game_category;
        $search_game_id = $request->search_game_id;
        $search_date = $request->search_date;

        $game_categories = GameCategory::where('is_active','1')->get();

        $bet_histories = GameParticipation::where('user_id',Auth::guard('web')->user()->id);

        if($search_game_category){
            $bet_histories = $bet_histories->whereHas('startGame',function($query) use ($search_game_category){
                $query->whereHas('game',function($q) use ($search_game_category){
                    $q->where('game_category_id',$search_game_category);
                });
            });
        }

        if($search_game_id){
            $bet_histories = $bet_histories->whereHas('startGame',function($query) use ($search_game_id){
                $query->where('game_id',$search_game_id);
            });
        }

        if($search_date){
            $bet_histories = $bet_histories->whereDate('created_at',$search_date);
        }

        $bet_histories = $bet_histories->latest()->get();

        if($request->ajax()){
            return view('frontend.user.bet_history_table',compact('game_categories','bet_histories'));
        }

        return view('frontend.user.bet_history',compact('game_categories'));
    }

    public function getGameByCategory(Request $request){
        return Game::where('game_category_id',$request->search_game_category)->get();
    }

}
