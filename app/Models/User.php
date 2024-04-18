<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'name',
        'phone_number',
        'invite_code',
        'total_wallet_amount',
        'level',
        'password',
        'block_status'
    ];

    public function invite(){
        return $this->belongsTo(User::class,'invite_code','user_id');
    }

    public function bankDetail(){
        return $this->hasOne(BankDetail::class);
    }

    public function deposite(){
        return $this->hasMany(WalletRechargeRequest::class);
    }

    public function firstDeposite(){
        return $this->hasOne(WalletRechargeRequest::class,'user_id','id')->oldest();
    }

    public function commission(){
        return $this->hasMany(Commission::class);
    }

    public function gameParticipation(){
        return $this->hasMany(GameParticipation::class);
    }

    public function subordinate(){
        return $this->hasMany(User::class,'invite_code','user_id');
    }

}
