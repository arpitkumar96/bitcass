<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GameSubCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'slug',
        'game_category_id',
        'name',
        'image',
        'is_active'
    ];

    public function category(){
        return $this->belongsTo(GameCategory::class,'game_category_id');
    }

    public function game(){
        return $this->hasMany(Game::class,'game_sub_category_id');
    }
}
