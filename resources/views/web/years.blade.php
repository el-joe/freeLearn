@extends('web.layout.index')

@section('content')
<div
class="container px-4 lg:px-8 mx-auto max-w-screen-xl text-gray-700 overflow-x-hidden mt-20"
>
<h1 class="text-darken text-center text-2xl font-semibold">
  Acadimic Years
</h1>

@foreach ($years as $year)
<div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div>
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$year->name}}</h5>
    </div>


    <div class="inline-flex rounded-md shadow-sm" role="group">
        <a href="{{route('playlist',[$year->id,$subjectId,1])}}" class="px-10 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
            Semester 1
        </a>
        <a href="{{route('playlist',[$year->id,$subjectId,2])}}" class="px-10 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
            Semester 2
        </a>
      </div>
</div>

@endforeach
</div>

@endsection
