<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_id',
        'amount',
        'transaction_type',
        'type'
    ];

    public function deposite(){
        return $this->belongsTo(WalletRechargeRequest::class,'type_id');
    }

    public function withdrawal(){
        return $this->belongsTo(WithdrawalRequest::class,'type_id');
    }

    public function bet(){
        return $this->belongsTo(GameParticipation::class,'type_id');
    }

    public function reward(){
        return $this->belongsTo(GameParticipation::class,'type_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
