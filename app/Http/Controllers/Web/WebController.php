<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\AcademicYear;
use App\Models\Contact;
use App\Models\Lesson;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WebController extends Controller
{
    public function home()
    {
        $subjects = Subject::take(3)->inRandomOrder()->get();

        return view('web.home',get_defined_vars());
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

    public function contactUs()
    {
        return view('web.contact-us');
    }

    public function contactUsPost(Request $request)
    {
        // Mail::to('eljoe1717@gmail.com')->send(new ContactMail($request->all()));
        Contact::create($request->all());

        return back()->with('success','Message sent successfully');
    }

    public function exam($lessonId)
    {
        $lesson = Lesson::find($lessonId)->load('questions.options');

        return view('web.exam',get_defined_vars());
    }
}
