<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletRechargeRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'user_id',
        'amount',
        'payment_type_detail',
        'channel_detail',
        'utr_number',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
