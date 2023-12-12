@extends('admin.layout.index')

@section('title', 'Lessons')

@section('content')
    <form action="{{$action}}" method="POST" class="form-panel" enctype="multipart/form-data">
        @csrf
        @if($method == 'PUT')
            @method('PUT')
        @endif
        <div class="form-group col-sm-12">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control">
                <option value="national" {{isset($lesson) && $lesson->type == 'national' ? 'selected' : ''}}>National</option>
                <option value="international" {{isset($lesson) && $lesson->type == 'international' ? 'selected' : ''}}>Inter National</option>
                <option value="course" {{isset($lesson) && $lesson->type == 'course' ? 'selected' : ''}}>Course</option>
            </select>
        </div>
        <div class="form-group col-sm-4">
            <label for="subject_id">Subject</label>
            <select name="subject_id" id="subject_id" class="form-control">
                @foreach ($subjects as $subject)
                    <option value="{{$subject->id}}" {{isset($lesson) && $subject->id == $lesson->subject_id ? 'selected' : ''}}>{{$subject->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-sm-4">
            <label for="academic_year_id">Academic Year</label>
            <select name="academic_year_id" id="academic_year_id" class="form-control">
                @foreach ($academicYears as $year)
                    <option value="{{$year->id}}" {{isset($lesson) && $year->id == $lesson->academic_year_id ? 'selected' : ''}}>{{$year->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-sm-4">
            <label for="instructor_id">Instructor</label>
            <select name="instructor_id" id="instructor_id" class="form-control">
                @foreach ($instructors as $instructor)
                    <option value="{{$instructor->id}}" {{isset($lesson) && $instructor->id == $lesson->instructor_id ? 'selected' : ''}}>{{$instructor->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-sm-4">
            <label for="semester">Semester</label>
            <select name="semester" id="semester" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>
        <div class="form-group col-sm-8">
            <label for="name">Name *</label>
            <input type="text" name="name" id="name" value="{{isset($lesson->name) ? $lesson->name : ''}}" class="form-control" placeholder="Enter Lesson name">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Enter Lesson description">{{isset($lesson->description) ? $lesson->description : ''}}</textarea>
        </div>
        {{-- <div class="form-group">
            <label for="price">Price *</label>
            <input type="number" name="price" id="price" value="{{isset($lesson->price) ? $lesson->price : ''}}" class="form-control" placeholder="15.00">
        </div> --}}
        <div class="form-group col-sm-9">
            <label for="expire_hours">Expire Hours *</label>
            <input type="number" name="expire_hours" id="expire_hours" value="{{isset($lesson->expire_hours) ? $lesson->expire_hours : '4'}}" class="form-control" placeholder="4">
        </div>
        <div class="form-group col-sm-3">
            <label for="active">Active</label>
            <input type="checkbox" class="" name="active" id="active" {{isset($lesson) && $lesson->active == 1 ? 'checked' : ''}}>
        </div>
        <div class="form-group col-sm-12 imageInputWithPreviosImage">
            <label for="thumb">Thumb</label>
            <input type="file" name="thumb" id="thumb" class="form-control">
            @isset($lesson)
                <img src="{{$lesson->thumb?->file_path}}" alt="" class="previosImage" width="100" height="100px">
            @endisset
        </div>

        <div class="form-group col-sm-12 imageInputWithPreviosImage">
            <label for="examAnswer">Exam Answers</label>
            <input type="file" name="examAnswer" id="examAnswer" class="form-control">
            @isset($lesson)
                <a target="__blank" href="{{$lesson->examAnswer?->file_path}}">{{$lesson->examAnswer?->file_path}}</a>
            @endisset
        </div>


        <div class="form-group col-sm-12">
            <label for="video">Video</label>
            <input type="file" name="video" id="video" class="form-control">
            @isset($lesson)
                <video width="400" poster="{{$lesson->thumb?->file_path}}" controls>
                    <source src="{{$lesson->video?->file_path}}" type="video/mp4">
                    <source src="{{$lesson->video?->file_path}}" type="video/ogg">
                    <source src="{{$lesson->video?->file_path}}" type="video/webm">
                        Your browser does not support the video tag.
                </video>
            @endisset
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
@endsection

@push('scripts')
    <script>
        $('#type').on('change',function () {
            changeType();
        });

        changeType();

        function changeType() {
            if($('#type').val() == 'course'){
                $('#academic_year_id').attr('disabled', true);
                $('#semester').attr('disabled', true);
            }else{
                $('#academic_year_id').attr('disabled', false);
                $('#semester').attr('disabled', false);
            }
        }
    </script>
@endpush
