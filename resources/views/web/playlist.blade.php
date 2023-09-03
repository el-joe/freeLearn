@extends('web.layout.index')

@section('content')
    <div class="container px-4 lg:px-8 mx-auto max-w-screen-xl text-gray-700">
        <div class="grid md:grid-cols-3 gap-14 md:gap-5 mt-20 py-2">
            @foreach ($lessons as $lesson)
                <?php $encodedLessonId = base64_encode($lesson->id); ?>
                <div class="flex flex-col gap-10 bg-white shadow-xl p-9 rounded-lg cursor-pointer">
                    <div data-aos="fade-left" class="sm:w-full relative mt-10 sm:mt-0">
                        <a href="{{route('video',[$encodedLessonId])}}"><img class="rounded-xl relative" src="{{$lesson->thumb?->file_path}}" alt="" /></a>
                        <a href="{{route('video',[$encodedLessonId])}}" class="bg-white w-14 h-14 rounded-full flex items-center justify-center absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 focus:outline-none transform transition hover:scale-110 duration-300 ease-in-out z-0">
                            <svg class="w-5 h-5 ml-1" viewBox="0 0 24 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M22.5751 12.8097C23.2212 13.1983 23.2212 14.135 22.5751 14.5236L1.51538 27.1891C0.848878 27.5899 5.91205e-07 27.1099 6.25202e-07 26.3321L1.73245e-06 1.00123C1.76645e-06 0.223477 0.848877 -0.256572 1.51538 0.14427L22.5751 12.8097Z"
                                    fill="#23BDEE" />
                            </svg>
                        </a>
                    </div>

                    <a href="{{route('video',[$encodedLessonId])}}"  data-aos="fade-right" class="relative">
                        <h1 class="font-semibold text-2xl relative z-50 text-darken lg:pr-10">
                            {{$lesson->name}}
                        </h1>
                        <p class="py-5">{{\Str::words($lesson->description,15)}}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
