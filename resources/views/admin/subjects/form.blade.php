@extends('admin.layout.index')

@section('title', 'Subjects')

@section('content')
    <form action="{{$action}}" method="POST" class="form-panel" enctype="multipart/form-data">
        @csrf
        @if($method == 'PUT')
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" name="name" id="name" value="{{isset($subject->name) ? $subject->name : ''}}" class="form-control" placeholder="Enter subject name">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Enter subject description">{{isset($subject->description) ? $subject->description : ''}}</textarea>
        </div>
        <div class="form-group imageInputWithPreviosImage">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @isset($subject)
                <img src="{{$subject->image->file_path}}" alt="" class="previosImage" width="100" height="100px">
            @endisset
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
@endsection
