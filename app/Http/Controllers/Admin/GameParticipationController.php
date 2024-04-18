<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Game;
use App\Models\StartGame;
use Illuminate\Http\Request;
use App\Models\GameParticipation;
use App\Http\Controllers\Controller;

class GameParticipationController extends Controller
{
    function __construct(){
        $this->middleware('permission:game-played-participant', ['only'=>['index']]);
        $this->middleware('permission:game-played-set-result', ['only'=>['store']]);
    }

    public function index(Request $request,$start_game_id){
        $search_win_lose = $request->search_win_lose;
        $search_key = $request->search_key;

        $start_game = StartGame::where('start_game_id',$start_game_id)->first();
        $game = Game::where('id',$start_game->game_id)->first();
        $game_participants = GameParticipation::where('start_game_id',$start_game->id);

        if($search_win_lose != ''){
            $game_participants = $game_participants->where('is_win',$search_win_lose);
        }

        if($search_key){
            $game_participants = $game_participants->whereHas('user',function($query) use ($search_key){
                $query->where('phone_number',$search_key)->orWhere('user_id',$search_key);
            });
        }

        $game_participants = $game_participants->with('user')->latest()->paginate(10);

        if($request->ajax()){
            return view('admin.game_participation.table',compact('start_game','game','game_participants','search_key','search_win_lose'));
        }

        return view('admin.game_participation.index',compact('start_game','game','game_participants','search_key','search_win_lose'));
    }

    public function store(Request $request,$start_game_id){
        $this->validate($request,[
            'result_number'=>'required|numeric|between:0,9'
        ]);

        $start_game = StartGame::where('start_game_id',$start_game_id)->where('is_running','1')->first();
        if($start_game){
            $winning_number = $request->result_number;

            if($winning_number >= 5){
                $winning_size = 'big';
            }else{
                $winning_size = 'small';
            }

            switch ($winning_number) {
                case 0:
                    $winning_color = 'red-violet';
                    break;
                case 1:
                    $winning_color = 'green';
                    break;
                case 2:
                    $winning_color = 'red';
                    break;
                case 3:
                    $winning_color = 'green';
                    break;
                case 4:
                    $winning_color = 'red';
                    break;
                case 5:
                    $winning_color = 'green-violet';
                    break;
                case 6:
                    $winning_color = 'red';
                    break;
                case 7:
                    $winning_color = 'green';
                    break;
                case 8:
                    $winning_color = 'red';
                    break;
                case 9:
                    $winning_color = 'green';
                    break;
                default:
                    break;
            }

            $start_game->winning_number = $winning_number;
            $start_game->winning_color = $winning_color;
            $start_game->winning_size = $winning_size;
            $start_game->result_declare_by = Auth::guard('admin')->user()->id;
            $start_game->save();

            return response()->json(['message'=>'Result Set Successfully!']);
        }else{
            return response()->json(['errors'=>['message'=>'Game is no longer Active!']],422);
        }
    }

}
