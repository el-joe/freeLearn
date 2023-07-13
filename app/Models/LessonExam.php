<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id','source','type','answer'
    ];


    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function file()
    {
        return $this->morphOne(File::class, 'model')->where('type', 'question');
    }

    public function options()
    {
        return $this->hasMany(LessonExamOption::class);
    }
}
