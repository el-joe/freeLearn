<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_num','subtotal','vat','total','user_id','paid','payment_data'
    ];

    protected $casts = [
        'payment_data'=>'array'
    ];

    function user() {
        return $this->belongsTo(User::class);
    }
}
