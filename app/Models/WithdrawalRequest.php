<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'withdrawal_request_id',
        'user_id',
        'amount',
        'tds_charge',
        'service_charge',
        'final_amount',
        'remark',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
