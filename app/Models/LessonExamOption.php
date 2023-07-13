<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonExamOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_exam_id','source','type'
    ];

    public function lessonExam()
    {
        return $this->belongsTo(LessonExam::class);
    }

    public function file()
    {
        return $this->morphOne(File::class, 'model')->where('type', 'option');
    }
}
