<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\AcademicYear;
use App\Models\Contact;
use App\Models\Lesson;
use App\Models\Setting;
use App\Models\Subject;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class WebController extends Controller
{
    public function home()
    {
        $subjects = Subject::take(3)->inRandomOrder()->get();

        $views = Setting::whereColumnName('home_views')->first()->value;

        return view('web.home',get_defined_vars());
    }

    function loginView() {
        return view('web.loginView',get_defined_vars());
    }

    function loginPost(Request $request) {
        $request->validate([
            'email'=>[
                'required','email',
                Rule::exists('users','email')->where(fn($q)=>$q->where('role','user'))
            ],
            'password'=>'required'
        ]);

        if (auth()->guard('user')->attempt($request->only('email','password'))) {
            return redirect('/')->with('success','Welcome Back!');
        }

        return redirect()->back()->withErrors(['message'=> 'Invalid credentials']);

    }

    function registerView() {
        return view('web.registerView',get_defined_vars());
    }

    function registerPost(Request $request) {
        $request->validate([
            'email'=>[
                'required','email',
                Rule::unique('users','email')
            ],
            'password'=>'required',
            'name'=>'required'
        ]);

        $user = User::create($request->only('name','email','password'));

        auth()->guard('user')->login($user);

        return redirect('/')->with('success','Registered Successfully');
    }


    public function subjects($type,$yearId,$semester)
    {
        $subjects = Subject::whereHas('lessons',function ($q)use($yearId,$semester,$type) {
            $q->whereAcademicYearIdAndSemesterAndType($yearId,$semester,$type)->whereActive(1);
        })->get();

        return view('web.subjects',get_defined_vars());
    }

    public function years($type)
    {
        $years = AcademicYear::whereHas('lessons',function ($query) use ($type){
            $query->whereType($type)->whereActive(1);
        })->get();

        return view('web.years',get_defined_vars());
    }

    public function playlist($data)
    {
        try{
            $data = base64_decode($data);
            $data = json_decode($data);
        }catch(Exception $e){
            return redirect('/')->with('error','something went wronge!');
        }

        if(!$data){
            return redirect('/')->with('error','something went wronge!');
        }

        // dd($data);

        $lessons = Lesson::whereActiveAndSubjectIdAndSemesterAndTypeAndAcademicYearId(1,$data->subjectId,$data->semester,$data->type,$data->yearId)->get();

        return view('web.playlist',get_defined_vars());
    }

    public function video($lessonId)
    {
        $lessonId = base64_decode($lessonId);
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

    function updateViews(){
        Setting::whereColumnName('home_views')->increment('value',1);

        return response()->json(['success'=>true]);
    }

    function courseSubjects() {
        $subjects = Subject::whereHas('lessons',function ($q) {
            $q->whereActive(1)->whereType('course');
        })->get();

        $type = 'course';
        $yearId = 0;
        $semester = 0;

        return view('web.subjects',get_defined_vars());
    }
}
