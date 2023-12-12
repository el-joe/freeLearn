@extends('admin.layout.index')

@section('title', 'Instructors')

@section('content')
<div class="content-panel" style="margin:20px">
    <div class="adv-table">
      <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered dtable">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Image</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($instructors as $instructor)
            <tr>
                <td>{{$instructor->id}}</td>
                <td>{{$instructor->name}}</td>
                <td>
                    <img src="{{optional($instructor->getRelation('image'))->file_path}}" alt="" height="100">
                </td>
                <td>
                    <a href="{{route('admin.instructors.edit', $instructor->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                    <a href="{{route('admin.instructors.destroy', $instructor->id)}}" class="btn btn-danger btn-xs deleteThis"><i class="fa fa-trash-o "></i></a>
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
