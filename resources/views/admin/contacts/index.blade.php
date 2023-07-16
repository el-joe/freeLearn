@extends('admin.layout.index')

@section('title', 'Contacts')

@section('content')
<div class="content-panel" style="margin:20px">
    <div class="adv-table">
      <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered dtable">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($contacts as $contact)
            <tr>
                <td>{{$contact->id}}</td>
                <td>{{$contact->name}}</td>
                <td>{{$contact->email}}</td>
                <td>{{$contact->message}}</td>
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
