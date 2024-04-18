<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'slug',
        'game_category_id',
        'game_sub_category_id',
        'name',
        'image',
        'duration',
        'how_to_play',
        'is_active',
    ];

    public function category(){
        return $this->belongsTo(GameCategory::class,'game_category_id');
    }

    public function subCategory(){
        return $this->belongsTo(GameSubCategory::class,'game_sub_category_id');
    }

    public function startGame(){
        return $this->hasMany(StartGame::class);
    }
}
