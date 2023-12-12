<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Instructor;
use App\Models\Subject;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors = Instructor::with('image')->latest()->get();

        return view('admin.instructors.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('admin.instructors.store');
        $method = 'POST';
        return view('admin.instructors.form', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $instructor = Instructor::create($request->only(['name']));

        if ($request->hasFile('image')) {
            $instructor->image()->create(['file' => $request->file('image'),'type' => 'image']);
        }

        return redirect()->route('admin.instructors.index')->with('success','instructor created successfully!');
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
        $action = route('admin.instructors.update',$id);
        $method = 'PUT';
        $instructor = Instructor::with('image')->findOrFail($id);
        return view('admin.instructors.form', get_defined_vars());
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
        $instructor = Instructor::findOrFail($id);
        $instructor->update($request->only(['name','description']));

        if ($request->hasFile('image')) {
            $instructor->image()->delete();
            $instructor->image()->create(['file' => $request->file('image'),'type' => 'image']);
        }

        return redirect()->route('admin.instructors.index')->with('success','instructor updated successfully!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Instructor::findOrFail($id)->delete();
        return redirect()->route('admin.instructors.index')->with('success','instructor deleted successfully!');;
    }
}
