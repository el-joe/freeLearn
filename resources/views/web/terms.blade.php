@extends('web.layout.index')

@section('content')
    <section class="py-16 lg:py-20 ">
        <div class="container">
            <div class="grid items-center grid-cols-4 gap-6 lg:grid-cols-12">
                <div class="justify-center col-span-4 border-b border-b-wuiSlate-200 lg:col-span-8 lg:col-start-3">
                    <h1 class="pb-6 text-4xl font-medium text-wuiSlate-900">Terms &amp; Conditions</h1>
                    {{-- <p class="pb-6 text-lg">Read about the terms and conditions for WindUI.</p> --}}
                </div>
                <div class="justify-center col-span-4 lg:col-span-8 lg:col-start-3">
                    {!! $setting !!}
                </div>
            </div>
        </div>
    </section>
@endsection
