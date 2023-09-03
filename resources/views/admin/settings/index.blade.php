@extends('admin.layout.index')

@section('title', 'Lessons')

@section('content')
<div class="content-panel" style="margin:20px">
    <div class="adv-table">
      <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered dtable">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($settings as $key=>$setting)
            <tr>
                <td>{{++$key}}</td>
                <td>{{$setting->slug}} ({{$setting->count}})</td>
                <td>
                    <a href="{{route('admin.settings.edit', $setting->slug)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
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
