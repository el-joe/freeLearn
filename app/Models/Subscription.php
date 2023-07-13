<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip','lesson_id','transaction_details','amount','status'
    ];

    protected $casts = [
        'transaction_details' => 'array'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function subscriptionExam()
    {
        return $this->hasMany(SubscriptionExam::class, 'subscription_id');
    }
}
