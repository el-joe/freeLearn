<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id','lesson_exam_id','answer','score'
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function lessonExam()
    {
        return $this->belongsTo(LessonExam::class);
    }
}
