<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'commission_setting_id',
        'level',
        'tier',
        'commission'
    ];
}
