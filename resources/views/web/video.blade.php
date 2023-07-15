@extends('web.layout.index')


@section('content')
    <div class="container px-4 lg:px-8 mx-auto max-w-screen-xl text-gray-700">
        <h1 class="text-darken text-center text-2xl font-semibold mt-20">
            {{$lesson->name}}
        </h1>
        <div class="flex flex-col mt-20 gap-10">
            <div data-aos="fade-left" class="relative mt-20 sm:mt-0">
                <video class="rounded-lg shadow-lg w-full" src="{{ $lesson->video?->file_path }}" poster="{{$lesson->thumb?->file_path}}" controls></video>
                {{-- <span
                    class="bg-white w-40 h-40 text-5xl font-medium rounded-full flex items-center justify-center absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 transform transition duration-300 ease-in-out z-0">
                    20
                </span> --}}
            </div>

            <div data-aos="fade-right" class="sm:w-100% relative">
                <div class="bg-green-500 rounded-full absolute z-0 -left-4 -top-3 animate-pulse"></div>
                {{-- <h1 class="font-semibold text-2xl relative z-50 text-darken lg:pr-10">
                    {{$lesson->name}},
                </h1> --}}
                <p class="py-5 lg:pr-32">
                    {{$lesson->description}}
                </p>
            </div>
        </div>
    </div>
@endsection
