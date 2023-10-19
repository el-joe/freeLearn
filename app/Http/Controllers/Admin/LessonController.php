<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Lesson;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::withCount('subscriptions')->with('thumb','video','academicYear','subject')->get();
        return view('admin.lessons.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('admin.lessons.store');
        $method = 'POST';
        $subjects = Subject::select('name','id')->get();
        $academicYears = AcademicYear::select('name','id')->get();
        return view('admin.lessons.form', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reqData = [
            'type'=>'required|in:course,international,national',
            'subject_id'=>'required|exists:subjects,id',
            'name'=>'required|string',
            'description'=>'required|string',
            'thumb'=>'required|mimes:jpg,jpeg,png',
            'video'=>'required|mimes:mp4,ogx,oga,ogv,ogg,webm',
            'expire_hours'=>'required|numeric',
            'examAnswer'=>'nullable|mimes:pdf,doc,docx',
        ];

        if($request->type == 'course'){
            $reqData = array_merge([
                'academic_year_id'=>'nullable',
                'semester'=>'nullable',
            ],$reqData);
        }else{
            $reqData = array_merge([
                'academic_year_id'=>'required|exists:academic_years,id',
                'semester'=>'required|in:1,2',
            ],$reqData);
        }

        $request->validate($reqData);

        $inputs = $request->except('thumb','video','active');

        if($request->type == 'course'){
            $inputs['academic_year_id'] = $inputs['semester'] = 0;
        }

        $inputs['active'] = $request->has("active") && $request->active == 'on' ? 1 : 0;
        $lesson = Lesson::create($inputs);

        if ($request->hasFile('thumb')) {
            $lesson->thumb()->create(['file' => $request->file('thumb'),'type' => 'thumb']);
        }

        if ($request->hasFile('examAnswer')) {
            $lesson->examAnswer()->create(['file' => $request->file('examAnswer'),'type' => 'examAnswer']);
        }

        if ($request->hasFile('video')) {
            $lesson->video()->create(['file' => $request->file('video'),'type' => 'video']);
        }


        return redirect()->route('admin.lessons.index')->with('success','Lesson created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $action = route('admin.lessons.update',$id);
        $method = 'PUT';
        $lesson = Lesson::findOrFail($id);
        $subjects = Subject::select('name','id')->get();
        $academicYears = AcademicYear::select('name','id')->get();
        return view('admin.lessons.form', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            'video'=>'nullable|mimes:mp4,ogx,oga,ogv,ogg,webm',
            'examAnswer'=>'nullable|mimes:pdf,doc,docx',
        ]);
        if ($validation->fails()) {
            return back()->with('error',$validation->errors()->first());
        }
        $lesson = Lesson::findOrFail($id);

        $inputs = $request->except('thumb','video','active');

        if($request->type == 'course'){
            $inputs['academic_year_id'] = $inputs['semester'] = 0;
        }

        $inputs['active'] = $request->has("active") && $request->active == 'on' ? 1 : 0;



        $lesson->update($inputs);

        if ($request->hasFile('thumb')) {
            $lesson->thumb()->delete();
            $lesson->thumb()->create(['file' => $request->file('thumb'),'type' => 'thumb']);
        }

        if ($request->hasFile('examAnswer')) {
            $lesson->examAnswer()->delete();
            $lesson->examAnswer()->create(['file' => $request->file('examAnswer'),'type' => 'examAnswer']);
        }

        if ($request->has('video')) {
            $lesson->video()->delete();
            $lesson->video()->create(['file' => $request->file('video'),'type' => 'video']);
        }

        return redirect()->route('admin.lessons.index')->with('success','Lesson updated successfully!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Lesson::findOrFail($id)->delete();
        return redirect()->route('admin.lessons.index')->with('success','Lesson deleted successfully!');;
    }

    public function exam(Lesson $lesson)
    {
        $action = route('admin.lesson.examUpdate',$lesson->id);
        $questions = $lesson->questions()->with('options.file','file')->get()
            ->map(function ($question){
                return [
                    'type'=>$question->type,
                    'answer'=>$question->answer,
                    'source'=>$question->type == 'image' ? $question->file?->file_path :$question->source,
                    'options'=>$question->options->map(function ($option){
                        return [
                            'type'=>$option->type,
                            'source'=>$option->type == 'image' ? $option->file->file_path :$option->source,
                        ];
                    }),
                ];
            });
        return view('admin.lessons.exam', get_defined_vars());
    }

    public function examUpdate(Lesson $lesson,Request $request)
    {
        $lesson->questions()->delete();

        foreach ($request->question as $question) {

            $questionParams = collect($question)->only(['type','source','answer'])->toArray();

            if($question['type'] == 'image'){
                $questionParams['source'] = null;
            }

            $questionObj = $lesson->questions()->create($questionParams);

            if ($question['type'] == 'image') {
                $questionObj->file()->create(['file' => $question['source'],'type' => 'question']);
            }

            foreach ($question['selection'] as $selection) {
                $optionParams = collect($selection)->only(['type','source'])->toArray();
                if($selection['type'] == 'image'){
                    $optionParams['source'] = null;
                }
                $option = $questionObj->options()->create($selection);

                if ($selection['type'] == 'image') {
                    $option->file()->create(['file' => $selection['source'],'type' => 'option']);
                }

            }
        }

        return back()->with('success','Exam Updated successfully!');
    }
}
