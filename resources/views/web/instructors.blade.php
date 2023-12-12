@extends('web.layout.index')

@section('content')
    <div class="container px-4 lg:px-8 mx-auto max-w-screen-xl text-gray-700 overflow-x-hidden mt-20">
        <h1 class="text-darken text-center text-2xl font-semibold">
            Instructors
        </h1>

        <div class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5">
            @foreach ($instructors as $instructor)
                <a class="rounded overflow-hidden shadow-lg" href="{{route('playlist',[$_data,'instructor_id'=>$instructor->id])}}">
                    <img class="w-full" src="{{$instructor->getRelation('image')->file_path}}" alt="Mountain">
                    <div class="px-6 py-4">
                    <div class="font-bold text-center text-xl mb-2">{{$instructor->name}}</div>
                    </div>
                </a>
            @endforeach
          </div>
        </div>
    </div>
@endsection
