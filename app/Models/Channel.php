<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_type_id',
        'name',
        'image',
        'upi_id',
        'status'
    ];

    public function paymentType(){
        return $this->belongsTo(PaymentType::Class);
    }
}
