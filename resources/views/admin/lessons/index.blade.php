@extends('admin.layout.index')

@section('title', 'Lessons')

@section('content')
<div class="content-panel" style="margin:20px">
    <div class="adv-table">
      <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered dtable">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Subject</th>
            <th>Year</th>
            <th>Image</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($lessons as $lesson)
            <tr>
                <td>{{$lesson->id}}</td>
                <td>{{$lesson->name}}</td>
                <td>{{$lesson->description}}</td>
                <td>{{optional($lesson->subject)->name}}</td>
                <td>{{optional($lesson->academicYear)->name}}</td>
                <td>
                    <img src="{{optional($lesson->thumb)->file_path}}" alt="" height="100">
                </td>
                <td>
                    <a href="{{route('admin.lessons.edit', $lesson->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                    <a href="{{route('admin.lesson.exam', $lesson->id)}}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                    <a href="{{route('admin.lessons.destroy', $lesson->id)}}" class="btn btn-danger btn-xs deleteThis"><i class="fa fa-trash-o "></i></a>
                </td>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@push('scripts')
<script type="text/javascript" language="javascript" src="{{asset('adminLayout/lib/advanced-datatable/js/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{asset('adminLayout/lib/advanced-datatable/js/DT_bootstrap.js')}}"></script>

<script>
    $('.dtable').dataTable();
</script>
@endpush

@push('styles')
  <link rel="stylesheet" href="{{asset('adminLayout/lib/advanced-datatable/css/DT_bootstrap.css')}}" />
@endpush
