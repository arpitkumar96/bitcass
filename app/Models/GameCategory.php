<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GameCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'slug',
        'name',
        'image',
        'is_active'
    ];

    public function gameSubcategory(){
        return $this->hasMany(GameSubCategory::class,'game_category_id');
    }

    public function game(){
        return $this->hasMany(Game::class,'game_category_id');
    }
}
