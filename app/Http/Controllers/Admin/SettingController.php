<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Lesson;
use App\Models\Setting;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::selectRaw('DISTINCT slug,COUNT(*) as count')
            ->groupBy('slug')->get();
        return view('admin.settings.index', get_defined_vars());
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
        $action = route('admin.settings.update',$id);
        $method = 'PUT';
        $settings = Setting::whereSlug($id)->get();
        return view('admin.settings.form', get_defined_vars());
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
        $inputs = $request->except('_token','_method');

        foreach ($inputs as $key => $value) {
            if($request->hasFile($key)){
                $value = Storage::disk(env('FILESYSTEM_DISK','public'))->put('settings', $value);
            }
            Setting::whereColumnName($key)->update(['value'=>$value]);
        }

        return redirect()->route('admin.settings.index')->with('success','Settings Updated Successfully!');;
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
                    'source'=>$question->type == 'image' ? $question->file->file_path :$question->source,
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
