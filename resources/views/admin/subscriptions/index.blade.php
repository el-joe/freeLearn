@extends('admin.layout.index')

@section('title', 'Subscriptions')

@section('content')
<div class="content-panel" style="margin:20px">
    <div class="adv-table">
        <div class="col-sm-12 text-center">
            <a href="{{request()->fullUrl()}}?export=1" target="_blank" class="btn btn-success">Export To Excel</a>
        </div>
      <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered dtable">
        <thead>
          <tr>
            <th>#</th>
            <th>IP</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($subscriptions as $subscription)
            <tr>
                <td>{{$subscription->id}}</td>
                <td>{{$subscription->ip}}</td>
                <td>
                    Subject : {{$subscription->lesson?->subject?->name}} <br>
                    Year : {{$subscription->lesson?->academicYear?->name}} <br>
                    Lesson : {{$subscription->lesson?->name}}
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
