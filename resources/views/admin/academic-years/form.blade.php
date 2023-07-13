@extends('admin.layout.index')

@section('title', 'Academic Years')

@section('content')
    <form action="{{$action}}" method="POST" class="form-panel" enctype="multipart/form-data">
        @csrf
        @if($method == 'PUT')
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" name="name" id="name" value="{{isset($academicYear->name) ? $academicYear->name : ''}}" class="form-control" placeholder="Enter subject name">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
@endsection
