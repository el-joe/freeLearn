<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\AcademicYear;
use App\Models\Contact;
use App\Models\Lesson;
use App\Models\Setting;
use App\Models\Subject;
use App\Models\Subscription;
use App\Models\User;
use App\Traits\Fawry;
use Carbon\Carbon;
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
            'phone'=>[
                'required',
                Rule::exists('users','phone')->where(fn($q)=>$q->where('role','user'))
            ],
            'password'=>'required'
        ]);

        if (auth()->guard('user')->attempt($request->only('phone','password'))) {
            return redirect('/')->with('success','Welcome Back!');
        }

        return redirect()->back()->withErrors(['message'=> 'Invalid credentials']);

    }

    function registerView() {
        return view('web.registerView',get_defined_vars());
    }

    function registerPost(Request $request) {
        $request->validate([
            'password'=>'required',
            'name'=>'required',
            'phone'=>'required|unique:users,phone',
        ]);

        $user = User::create($request->only('name','phone','password'));

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
        $_lessonId = base64_decode($lessonId);
        $lesson = Lesson::findOrFail($_lessonId);

        $now = now()->format('Y-m-d H:i');

        $subscription = auth('user')->user()->subscriptions()
            ->whereLessonId($_lessonId)
            ->whereRaw('((DATE(start_date) <= "'. $now .'" AND DATE_ADD(start_date, INTERVAL '. $lesson->expire_hours .' HOUR) >= "'. $now.'") OR start_date is null)')
            ->first();

        if($subscription){
            $expireDate = Carbon::parse($subscription->start_date)->addHours($lesson->expire_hours);
            if($subscription->start_date == null){
                $subscriptionId = base64_encode($subscription->id);
                return redirect()->route('exam',$subscriptionId);
            }else{
                if($expireDate->isPast()){
                    return redirect()->route('checkout');
                }

                $examPassCount = $subscription->subscriptionExam()->whereScore(1)->count();
                $examAllCount = $subscription->subscriptionExam()->count();
            }
        }

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

    public function exam($subId)
    {
        $_subId = base64_decode($subId);

        $subscription = auth('user')->user()->subscriptions()->find($_subId);
        $lesson = Lesson::find($subscription->lesson_id)->load('questions.options');

        return view('web.exam',get_defined_vars());
    }

    function submitExam(Request $request,$subId) {

        $_subId = base64_decode($subId);

        $subscription = auth('user')->user()->subscriptions()->find($_subId);

        $lesson = Lesson::find($subscription->lesson_id);

        foreach ($request->question as $questionId => $answerNum) {
            $question = $lesson->questions()->find($questionId);

            $score = $question->answer == $answerNum ? 1 : 0;

            $subscription->subscriptionExam()->create([
                'lesson_exam_id'=>$questionId,
                'answer'=>$answerNum,
                'score'=>$score
            ]);
        }

        $subscription->update([
            'start_date'=>now()
        ]);

        return redirect()->route('video',base64_encode($lesson->id));
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

    function checkout() {
        return view('web.checkout');
    }

    function postCheckout(Request $request) {
        $request->validate([
            'video_num'=>'required|numeric'
        ]);

        $price = Setting::whereColumnName('lesson_price')->first()->value;

        $subtotal = $price * $request->video_num;

        $vat = 2 + ($subtotal * .025);

        $total = $subtotal + $vat;

        $fawry = new Fawry();

        $orderId = now()->format('YmdHis') . rand(1000,9999);

        $response = $fawry->checkout($orderId,$total,[
            'name'=>auth('user')->user()->name,
            'phone'=>auth('user')->user()->phone,
            'email'=>auth('user')->user()->email,
            'id'=>auth('user')->user()->id,
        ]);

        if($response == null){
            return response()->json(['ref_num'=>'something went wronge!']);
        }


        auth('user')->user()->orders()->create([
            'video_num'=>$request->video_num,
            'subtotal'=>$subtotal,
            'vat'=>$vat,
            'total'=> $total,
            'paid'=>0,
            'payment_data'=>$response
        ]);


        return response()->json([
            'ref_num'=>$response['referenceNumber']
        ]);
    }

    function previousCarts() {
        $orders = auth('user')->user()->orders()->latest()->get();
        return view('web.previous-carts',get_defined_vars());
    }

    function buyNow($lessonId) {
        $user = auth('user')->user();
        $videosNum = $user->videos;

        if($videosNum > 0){
            $subscription = $user->subscriptions()->create([
                'lesson_id'=>$lessonId,
                'ip'=> request()->ip()
            ]);

            $user->decrement('videos',1);

            return response()->json([
                'url'=> route('video',base64_encode($lessonId))
            ]);
        }

        return response()->json([
            'url'=> route('checkout')
        ]);
    }

    function terms() {
        $setting = Setting::where('column_name','terms_content')->first()->value;
        return view('web.terms',get_defined_vars());
    }

    function policy() {
        $setting = Setting::where('column_name','policy')->first()->value;
        return view('web.policy',get_defined_vars());
    }
}
