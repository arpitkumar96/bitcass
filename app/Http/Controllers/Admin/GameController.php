<?php

namespace App\Http\Controllers\Admin;

use App\Models\Game;
use Illuminate\Support\Str;
use App\Models\GameCategory;
use Illuminate\Http\Request;
use App\Models\GameSubCategory;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
    function __construct(){
        $this->middleware('permission:game-list', ['only'=>['index']]);
        $this->middleware('permission:game-create', ['only'=>['create','store']]);
        $this->middleware('permission:game-edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:game-delete', ['only'=>['destroy']]);
        $this->middleware('permission:game-status', ['only'=>['gameStatus']]);
    }

    public function index(Request $request){
        $search_category = $request->search_category;
        $search_subcategory = $request->search_subcategory;
        $search_duration = $request->search_duration;
        $search_status = $request->search_status;
        $search_key = $request->search_key;

        $categories = GameCategory::oldest('name')->get();
        $subcategories = [];
        $games = Game::with('category','subCategory')->withCount('startGame');

        if($search_category){
            $subcategories = GameSubCategory::where('game_category_id',$request->search_category)->get();
            $games = $games->where('game_category_id',$search_category);
        }
        if($search_subcategory){
            $games = $games->where('game_sub_category_id',$search_subcategory);
        }
        if($search_duration){
            $games = $games->where('duration',$search_duration);
        }
        if($search_status != ""){
            $games = $games->where('is_active',$search_status);
        }
        if($search_key){
            $games = $games->where('name','like','%'.$search_key.'%');
        }

        $games = $games->latest()->paginate(10);

        if($request->ajax()){
            return view('admin.game.table',compact('games','categories','subcategories','search_category','search_subcategory','search_duration','search_status','search_key'));
        }

        return view('admin.game.index',compact('games','categories','subcategories','search_category','search_subcategory','search_duration','search_status','search_key'),['page_title'=>'Game List']);
    }

    public function create(){
        $categories = GameCategory::latest()->get();

        return view('admin.game.create',compact('categories'),['page_title'=>'Add Game']);
    }

    public function store(Request $request){
        $game_categories = GameCategory::pluck('id')->toArray();
        $game_sub_categories = GameSubCategory::where('game_category_id',$request->game_category_id)->pluck('id')->toArray();
        $this->validate($request,[
            'game_category_id'=>'required|in:'.implode(',',$game_categories),
            'game_sub_category_id'=>'nullable|in:'.implode(',',$game_sub_categories),
            'name'=>'required',
            'duration'=>'required|integer|in:1,3,5,10',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp'
        ]);

        $check_game = Game::where('game_category_id',$request->game_category_id)->where('game_sub_category_id',$request->game_sub_category_id)->where('duration',$request->duration)->first();

        if($check_game){
            return redirect()->back()->withErrors(['duration'=>'This Game Already Exists!']);
        }

        $game = new Game;
        $game->slug = Str::slug($request->name).rand(111,999);
        $game->game_category_id = $request->game_category_id;
        $game->game_sub_category_id = $request->game_sub_category_id;
        $game->name = $request->name;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time().rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('backend/assets/image/games'),$image_name);
            $game->image = $image_name;
        }
        $game->duration = $request->duration;
        $game->how_to_play = $request->how_to_play;
        $game->save();

        return redirect()->route('admin.game.index')->with('success','Game Added Successfully!');
    }

    public function edit(Game $game){
        $categories = GameCategory::latest()->get();

        return view('admin.game.edit',compact('categories','game'),['page_title'=>'Edit Game']);
    }

    public function update(Request $request,Game $game){
        $game_categories = GameCategory::pluck('id')->toArray();
        $game_sub_categories = GameSubCategory::where('game_category_id',$request->game_category_id)->pluck('id')->toArray();
        $this->validate($request,[
            'game_category_id'=>'required|in:'.implode(',',$game_categories),
            'game_sub_category_id'=>'nullable|in:'.implode(',',$game_sub_categories),
            'name'=>'required',
            'duration'=>'required|integer|in:1,3,5,10',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp'
        ]);

        $check_game = Game::where('game_category_id',$request->game_category_id)->where('game_sub_category_id',$request->game_sub_category_id)->where('duration',$request->duration)->whereNot('id',$game->id)->first();

        if($check_game){
            return redirect()->back()->withErrors(['duration'=>'This Game Already Exists!']);
        }

        $game->game_category_id = $request->game_category_id;
        $game->game_sub_category_id = $request->game_sub_category_id;
        $game->name = $request->name;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time().rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('backend/assets/image/games'),$image_name);
            $game->image = $image_name;
        }
        $game->duration = $request->duration;
        $game->how_to_play = $request->how_to_play;
        $game->save();

        return redirect()->route('admin.game.index')->with('success','Game Updated Successfully!');
    }

    public function destroy(Game $game){
        $game->delete();

        return back()->with('error','Game Deleted Successfully!');
    }

    public function gameStatus($id,$status){
        $game = Game::find($id);
        $game->is_active = $status;
        $game->save();

        if($status == '0'){
            return back()->with('error','Game Deactivated Successfully!');
        }else{
            return back()->with('success','Game Activated Successfully!');
        }
    }

    public function getSubCategoryByCategory(Request $request){
        $sub_categories = GameSubCategory::where('game_category_id',$request->category_id)->get();

        return response()->json(['sub_categories'=>$sub_categories]);
    }

}
