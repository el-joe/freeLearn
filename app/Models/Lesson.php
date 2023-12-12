<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id','academic_year_id','name','description','price','semester','expire_hours','active','instructor_id'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function questions()
    {
        return $this->hasMany(LessonExam::class,'lesson_id');
    }

    public function thumb()
    {
        return $this->morphOne(File::class, 'model')->where('type', 'thumb');
    }

    public function examAnswer()
    {
        return $this->morphOne(File::class, 'model')->where('type', 'examAnswer');
    }

    public function video()
    {
        return $this->morphOne(File::class, 'model')->where('type', 'video');
    }

    function subscriptions() {
        return $this->hasMany(Subscription::class,'lesson_id');
    }

    function instructor() {
        return $this->belongsTo(Instructor::class);
    }
}
