@extends('admin.layout.index')

@section('title', 'Dashboard')

@section('content')

<div class="col-lg-12">
    <div class="content-panel">
      <h4><i class="fa fa-angle-right"></i> Current Year Subscriptions</h4>
      <div class="panel-body">
        <div id="hero-bar" class="graph"></div>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
<script src="{{asset('adminLayout/lib/morris/morris.min.js')}}"></script>
<script class="include" type="text/javascript" src="{{asset('adminLayout/lib/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('adminLayout/lib/raphael/raphael.min.js')}}"></script>
<script>

    var data = JSON.parse('{!! collect($yearRevenue) !!}');

    Morris.Bar({
        element: 'hero-bar',
        data,
        xkey: 'month',
        ykeys: ['amount'],
        labels: ['amount'],
        barRatio: 0.4,
        xLabelAngle: 35,
        hideHover: 'auto',
        barColors: ['#ac92ec']
      });

</script>
@endpush

@push('styles')
@endpush
