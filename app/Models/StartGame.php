<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartGame extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_game_id',
        'game_id',
        'duration',
        'winning_number',
        'winning_color',
        'winning_size',
        'result_declare_by',
        'is_running',
    ];

    public function game(){
        return $this->belongsTo(Game::class);
    }

    public function gameParticipation(){
        return $this->hasMany(GameParticipation::class);
    }
}
