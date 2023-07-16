<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::latest()->get();

        return view('admin.subjects.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('admin.subjects.store');
        $method = 'POST';
        return view('admin.subjects.form', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subject = Subject::create($request->only(['name','description']));

        if ($request->hasFile('image')) {
            $subject->image()->create(['file' => $request->file('image'),'type' => 'image']);
        }

        return redirect()->route('admin.subjects.index')->with('success','Subject created successfully!');
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
        $action = route('admin.subjects.update',$id);
        $method = 'PUT';
        $subject = Subject::findOrFail($id);
        return view('admin.subjects.form', get_defined_vars());
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
        $subject = Subject::findOrFail($id);
        $subject->update($request->only(['name','description']));

        if ($request->hasFile('image')) {
            $subject->image()->delete();
            $subject->image()->create(['file' => $request->file('image'),'type' => 'image']);
        }

        return redirect()->route('admin.subjects.index')->with('success','Subject updated successfully!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subject::findOrFail($id)->delete();
        return redirect()->route('admin.subjects.index')->with('success','Subject deleted successfully!');;
    }

    public function contacts()
    {
        $contacts = Contact::latest()->get();

        return view('admin.contacts.index', get_defined_vars());
    }
}
