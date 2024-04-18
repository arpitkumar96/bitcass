<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Slider;
use App\Models\WebsiteData;
use App\Models\GameCategory;
use Illuminate\Http\Request;
use App\Models\GameSubCategory;

class HomeController extends Controller
{

    public function index(){
        $sliders = Slider::latest()->get();
        $game_categories = GameCategory::all();
        $startup_notification = WebsiteData::where('status','1')->where('type','startup_notification')->first();

        return view('frontend.home.index',compact('sliders','game_categories','startup_notification'));
    }

    public function gameListByCategory(Request $request){
        $game_category = GameCategory::where('id',$request->game_category_id)->with('game','gameSubcategory.game')->first();

        return response()->json(['view'=>view('frontend.home.game_list',compact('game_category'))->render()]);
    }

    public function gameListByCategorySubcategory(Request $request){
        $game_category = GameCategory::where('id',$request->category_id)->first();
        $game_sub_category = GameSubCategory::where('id',$request->sub_category_id)->first();
        if($request->sub_category_id){
            $games = Game::where('game_sub_category_id',$game_sub_category->id)->get();
        }else{
            $games = Game::where('game_category_id',$game_category->id)->get();
        }
        return response()->json(['view'=>view('frontend.home.game_list_data',compact('game_category','games'))->render()]);
    }
}
