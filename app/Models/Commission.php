<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_id',
        'commission',
        'level',
        'tier',
        'type',
    ];
}
