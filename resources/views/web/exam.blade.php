@extends('web.layout.index')

@section('content')
<div class="container px-4 lg:px-8 mx-auto h-full max-w-screen-xl text-gray-700">
    <div class="flex flex-col mt-20 gap-10">
    <div data-aos="fade-left" class="relative mt-20 sm:mt-0">
        <span class="tex-green-500 text-2xl font-medium">Q1</span>
        <img class="bg-white bg-opacity-80 rounded-lg" src="img/hand.avif" width="200" height="50" />
    </div>

    <div data-aos="fade-right" class="flex flex-col gap-5">
        <!-- radion buttons  -->

        <label for="slider1">
        <input type="radio" name="slider1" id="slide1" checked />
        Answare 1
        </label>
        <label for="slider">
        <input type="radio" name="slider" id="slide1" />
        Answare 1
        </label>
        <label for="slider">
        <input type="radio" name="slider" id="slide1" />
        Answare 1
        </label>
        <label for="slider">
        <input type="radio" name="slider" id="slide1" />
        Answare 1
        </label>
    </div>
    </div>
</div>

@endsection
