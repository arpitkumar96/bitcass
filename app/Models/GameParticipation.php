<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameParticipation extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_game_id',
        'user_id',
        'type',
        'data',
        'amount',
        'handling_fee',
        'final_amount',
        'quantity',
        'win_amount',
        'is_win',
    ];

    public function startGame(){
        return $this->belongsTo(StartGame::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
