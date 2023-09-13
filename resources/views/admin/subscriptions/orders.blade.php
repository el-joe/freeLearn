@extends('admin.layout.index')

@section('title', 'Subscriptions')

@section('content')
<div class="content-panel" style="margin:20px">
    <div class="adv-table">
      <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered dtable">
        <thead>
          <tr>
            <th>#</th>
            <th>Video Count</th>
            <th>Sub Total</th>
            <th>VAT</th>
            <th>Grand Total</th>
            <th>User</th>
            <th>Status</th>
            <th>merchantRefNumber</th>
            <th>referenceNumber</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->video_num}}</td>
                <td>{{$order->subtotal}}</td>
                <td>{{$order->vat}}</td>
                <td>{{$order->total}}</td>
                <td>{{$order->user?->name}}</td>
                <td>{{$order->paid == 1 ? 'PAID' : 'NOT PAID'}}</td>
                <td>{{$order->payment_data['merchantRefNumber'] ?? ''}}</td>
                <td>{{$order->payment_data['referenceNumber'] ?? ''}}</td>
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
