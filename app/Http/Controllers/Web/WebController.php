<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Lesson;
use App\Models\Subject;

class WebController extends Controller
{
    public function home()
    {
        return view('web.home');
    }

    public function subjects()
    {
        $subjects = Subject::all();

        return view('web.subjects',get_defined_vars());
    }

    public function years($subjectId)
    {
        $years = AcademicYear::whereHas('lessons',function ($query) use ($subjectId){
            $query->where('subject_id',$subjectId);
        })->get();

        return view('web.years',get_defined_vars());
    }

    public function playlist($yearId,$subjectId,$semester)
    {
        $lessons = AcademicYear::find($yearId)->lessons()->where('subject_id',$subjectId)->whereSemester($semester)->get();

        return view('web.playlist',get_defined_vars());
    }

    public function video($lessonId)
    {
        $lesson = Lesson::find($lessonId);

        return view('web.video',get_defined_vars());
    }
}
