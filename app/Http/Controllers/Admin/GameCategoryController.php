<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\GameCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameCategoryController extends Controller
{
    function __construct(){
        $this->middleware('permission:game_category-list', ['only'=>['index']]);
        $this->middleware('permission:game_category-create', ['only'=>['store']]);
        $this->middleware('permission:game_category-edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:game_category-delete', ['only'=>['destroy']]);
    }

    public function index(){
        $game_categories = GameCategory::latest()->get();

        return view('admin.game_category.index',compact('game_categories'),['page_title'=>'Game Category List']);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|in:Lottery,Slot,Original|unique:game_categories,name',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp'
        ]);

        $game_category = new GameCategory;
        $game_category->slug = Str::slug($request->name).rand(111,999);
        $game_category->name = $request->name;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time().rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('backend/assets/image/game_categories'),$image_name);
            $game_category->image = $image_name;
        }
        $game_category->save();

        return redirect()->route('admin.game-category.index')->with('success','Game Category Added Successfully!');
    }

    public function edit($id){
        $edit_game_category = GameCategory::where('id',$id)->first();
        $game_categories = GameCategory::latest()->get();

        return view('admin.game_category.index',compact('edit_game_category','game_categories'),['page_title'=>'Game Category List']);
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'name'=>'required|in:Lottery,Slot,Original|unique:game_categories,name,'.$id.',id',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp'
        ]);

        $game_category = GameCategory::where('id',$id)->first();
        $game_category->name = $request->name;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time().rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('backend/assets/image/game_categories'),$image_name);
            $game_category->image = $image_name;
        }
        $game_category->save();

        return redirect()->route('admin.game-category.index')->with('success','Game Category Added Successfully!');
    }

    public function destroy($id){
        GameCategory::where('id',$id)->delete();

        return back()->with('error','Game Category Deleted Successfully!');
    }

}
