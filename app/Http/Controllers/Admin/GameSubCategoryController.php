<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\GameCategory;
use Illuminate\Http\Request;
use App\Models\GameSubCategory;
use App\Http\Controllers\Controller;

class GameSubCategoryController extends Controller
{
    function __construct(){
        $this->middleware('permission:game_subcategory-list', ['only'=>['index']]);
        $this->middleware('permission:game_subcategory-create', ['only'=>['store']]);
        $this->middleware('permission:game_subcategory-edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:game_subcategory-delete', ['only'=>['destroy']]);
    }

    public function index(){
        $game_categories = GameCategory::latest()->get();
        $game_sub_categories = GameSubCategory::with('category')->latest()->get();

        return view('admin.game_sub_category.index',compact('game_categories','game_sub_categories'),['page_title'=>'Game Sub Category List']);
    }

    public function store(Request $request){
        $game_categories = GameCategory::pluck('id')->toArray();
        $this->validate($request,[
            'game_category_id'=>'required|in:'.implode(',',$game_categories),
            'name'=>'required|in:Win Go,K3,5D,Trx Win|unique:game_sub_categories,name',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp'
        ]);

        $game_sub_category = new GameSubCategory;
        $game_sub_category->slug = Str::slug($request->name).rand(111,999);
        $game_sub_category->game_category_id = $request->game_category_id;
        $game_sub_category->name = $request->name;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time().rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('backend/assets/image/game_sub_categories'),$image_name);
            $game_sub_category->image = $image_name;
        }
        $game_sub_category->save();

        return redirect()->route('admin.game-sub-category.index')->with('success','Game Sub Category Added Successfully!');
    }

    public function edit($id){
        $edit_game_sub_category = GameSubCategory::where('id',$id)->first();
        $game_categories = GameCategory::latest()->get();
        $game_sub_categories = GameSubCategory::latest()->get();

        return view('admin.game_sub_category.index',compact('edit_game_sub_category','game_categories','game_sub_categories'),['page_title'=>'Game Sub Category List']);
    }

    public function update(Request $request,$id){
        $game_categories = GameCategory::pluck('id')->toArray();
        $this->validate($request,[
            'game_category_id'=>'required|in:'.implode(',',$game_categories),
            'name'=>'required|in:Win Go,K3,5D,Trx Win|unique:game_sub_categories,name,'.$id.',id',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp'
        ]);

        $game_sub_category = GameSubCategory::where('id',$id)->first();
        $game_sub_category->game_category_id = $request->game_category_id;
        $game_sub_category->name = $request->name;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time().rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('backend/assets/image/game_sub_categories'),$image_name);
            $game_sub_category->image = $image_name;
        }
        $game_sub_category->save();

        return redirect()->route('admin.game-sub-category.index')->with('success','Game Sub Category Updated Successfully!');
    }

    public function destroy($id){
        GameSubCategory::where('id',$id)->delete();

        return back()->with('error','Game Sub Category Deleted Successfully!');
    }

    public function getSubcategoryByCategoryid(Request $request){
        $category = GameCategory::where('id',$request->game_category_id)->first();
        if($category){
            if($category->name == 'Lottery'){
                $subcategories = ['Win Go','K3','5D','Trx Win'];

                return response()->json(['subcategories'=>$subcategories],200);
            }elseif($category->name == 'Original'){
                $subcategories = [];

                return response()->json(['subcategories'=>$subcategories],200);
            }elseif($category->name == 'Slot'){
                $subcategories = [];

                return response()->json(['subcategories'=>$subcategories],200);
            }else{
                return response()->json(['message'=>'Invalid Category Selected!'],422);
            }
        }else{
            return response()->json(['message'=>'Invalid Category Selected!'],422);
        }
    }

}
