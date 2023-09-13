@extends('web.layout.index')


@section('content')

<div class="bg-cream">
    <div class="max-w-screen-xl px-8 mx-auto flex flex-col lg:flex-row items-start">
        <!--Left Col-->
        <div
            class="flex flex-col w-full lg:w-6/12 justify-center lg:pt-24 items-start text-center lg:text-left mb-5 md:mb-0">
            <h1 data-aos="fade-right" data-aos-once="true"
                class="my-4 text-5xl font-bold leading-tight text-darken">
                <span class="text-yellow-500">Studying</span> Online is now much easier
            </h1>
            <p data-aos="fade-down" data-aos-once="true" data-aos-delay="300" class="leading-normal text-2xl mb-8">
                Free Learn is an interesting platform that will teach you in more an interactive way
            </p>
        </div>
        <!--Right Col-->
        <div class="w-full lg:w-6/12 lg:-mt-10 relative" id="girl">
            <img data-aos="fade-up" data-aos-once="true" class="w-10/12 mx-auto 2xl:-mb-20" src="{{asset('website/img/girl.png')}}" />
            <!-- calendar -->
            {{-- <div data-aos="fade-up" data-aos-delay="300" data-aos-once="true"
                class="absolute top-20 -left-6 sm:top-32 sm:left-10 md:top-40 md:left-16 lg:-left-0 lg:top-52 floating-4">
                <img class="bg-white bg-opacity-80 rounded-lg h-12 sm:h-16" src="{{asset('website/img/calendar.svg')}}" />
            </div> --}}
            <!-- red -->
            <div data-aos="fade-up" data-aos-delay="400" data-aos-once="true"
                class="absolute top-20 right-10 sm:right-24 sm:top-28 md:top-36 md:right-32 lg:top-32 lg:right-16 floating">
                <svg class="h-16 sm:h-24" viewBox="0 0 149 149" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g filter="url(#filter0_d)">
                        <rect x="40" y="32" width="69" height="69" rx="14"
                            fill="#F3627C" />
                    </g>
                    <rect x="51.35" y="44.075" width="47.3" height="44.85" rx="8"
                        fill="white" />
                    <path d="M74.5 54.425V78.575" stroke="#F25471" stroke-width="4" stroke-linecap="round" />
                    <path d="M65.875 58.7375L65.875 78.575" stroke="#F25471" stroke-width="4"
                        stroke-linecap="round" />
                    <path d="M83.125 63.9125V78.575" stroke="#F25471" stroke-width="4" stroke-linecap="round" />
                    <defs>
                        <filter id="filter0_d" x="0" y="0" width="149" height="149"
                            filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                            <feColorMatrix in="SourceAlpha" type="matrix"
                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
                            <feOffset dy="8" />
                            <feGaussianBlur stdDeviation="20" />
                            <feColorMatrix type="matrix"
                                values="0 0 0 0 0.825 0 0 0 0 0.300438 0 0 0 0 0.396718 0 0 0 0.26 0" />
                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow" />
                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow"
                                result="shape" />
                        </filter>
                    </defs>
                </svg>
            </div>
        </div>
    </div>
    <div class="text-white -mt-14 sm:-mt-24 lg:-mt-36 z-40 relative">
        <svg class="xl:h-40 xl:w-full" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M600,112.77C268.63,112.77,0,65.52,0,7.23V120H1200V7.23C1200,65.52,931.37,112.77,600,112.77Z"
                fill="currentColor"></path>
        </svg>
        <div class="bg-white w-full h-20 -mt-px"></div>
    </div>
</div>

<!-- container -->
<div class="container px-4 lg:px-8 mx-auto max-w-screen-xl text-gray-700 overflow-x-hidden">
    <h1 class="text-darken text-center text-2xl font-semibold">
        Latest News and Resources
    </h1>
    <div class="sm:flex items-center sm:space-x-8 mt-20">
        <div data-aos="fade-right" class="sm:w-1/2 relative">
            <div class="bg-green-500 rounded-full absolute w-12 h-12 z-0 -left-4 -top-3 animate-pulse"></div>
            <h1 class="font-semibold text-2xl relative z-50 text-darken lg:pr-10">
                Everything you can do in a physical classroom,
                <span class="text-yellow-500">you can do with Free Learn</span>
            </h1>
            <p class="py-5 lg:pr-32">
                Free Learn’s school management software helps traditional and online
                schools manage scheduling, attendance, payments and virtual
                classrooms all in one secure cloud-based system.
            </p>
            <a href="" class="underline">Learn More</a>
        </div>
        <div data-aos="fade-left" class="sm:w-1/2 relative mt-10 sm:mt-0">
            <div class="main-video-component">
                <div style="background: #23bdee" class="floating w-24 h-24 absolute rounded-lg z-0 -top-3 -left-3">
                </div>
                <img class="rounded-xl z-40 relative home-video-thumb" src="{{asset('website/img/teacher-explaining.png')}}" alt="" />
                <button onclick="playVideo(event)"
                    class="bg-white w-14 h-14 rounded-full flex items-center justify-center absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 focus:outline-none transform transition hover:scale-110 duration-300 ease-in-out z-50">
                    <svg class="w-5 h-5 ml-1" viewBox="0 0 24 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M22.5751 12.8097C23.2212 13.1983 23.2212 14.135 22.5751 14.5236L1.51538 27.1891C0.848878 27.5899 5.91205e-07 27.1099 6.25202e-07 26.3321L1.73245e-06 1.00123C1.76645e-06 0.223477 0.848877 -0.256572 1.51538 0.14427L22.5751 12.8097Z"
                            fill="#23BDEE" />
                    </svg>

                </button>
            </div>
            <div class="text-center mt-5">
                {{$views}}
            </div>
            <div class="flex justify-center items-center">
                <svg class="h-6 text-gray-700 " fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    viewbox="0 0 576 512">
                    <path fill="currentColor"
                    d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                    </path>
                </svg>
            </div>
            <div class="bg-green-500 w-40 h-40 floating absolute rounded-lg z-10 -bottom-3 -right-3"></div>
        </div>
    </div>

    <!-- All-In-One Cloud Software. -->
    <div data-aos="flip-up" class="max-w-xl mx-auto text-center mt-24">
        <h1 class="font-bold text-darken my-3 text-2xl">
            <span class="text-yellow-500">
                Our <span class="text-yellow-500">Courses</span>
            </span>
        </h1>
        <p class="leading-relaxed text-gray-500">
            Free Learn is one powerful online learning platform
        </p>
    </div>
    <!-- card -->
    <div class="grid md:grid-cols-3 gap-14 md:gap-5 mt-20">
        @foreach (['national','international','course'] as $subject)
            <a href="{{$subject == 'course' ? route('courseSubjects') : route('years',$subject)}}" data-aos="fade-up"
                class="bg-white shadow-xl p-6 text-center rounded-xl duration-300 hover:scale-105 cursor-pointer">
                <div style="background: #5b72ee"
                    class="rounded-full w-16 h-16 flex items-center justify-center mx-auto shadow-lg transform -translate-y-12">
                    <svg class="w-6 h-6 text-white" viewBox="0 0 33 46" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M24.75 23H8.25V28.75H24.75V23ZM32.3984 9.43359L23.9852 0.628906C23.5984 0.224609 23.0742 0 22.5242 0H22V11.5H33V10.952C33 10.3859 32.7852 9.83789 32.3984 9.43359ZM19.25 12.2188V0H2.0625C0.919531 0 0 0.961328 0 2.15625V43.8438C0 45.0387 0.919531 46 2.0625 46H30.9375C32.0805 46 33 45.0387 33 43.8438V14.375H21.3125C20.1781 14.375 19.25 13.4047 19.25 12.2188ZM5.5 6.46875C5.5 6.07164 5.80766 5.75 6.1875 5.75H13.0625C13.4423 5.75 13.75 6.07164 13.75 6.46875V7.90625C13.75 8.30336 13.4423 8.625 13.0625 8.625H6.1875C5.80766 8.625 5.5 8.30336 5.5 7.90625V6.46875ZM5.5 12.2188C5.5 11.8216 5.80766 11.5 6.1875 11.5H13.0625C13.4423 11.5 13.75 11.8216 13.75 12.2188V13.6562C13.75 14.0534 13.4423 14.375 13.0625 14.375H6.1875C5.80766 14.375 5.5 14.0534 5.5 13.6562V12.2188ZM27.5 39.5312C27.5 39.9284 27.1923 40.25 26.8125 40.25H19.9375C19.5577 40.25 19.25 39.9284 19.25 39.5312V38.0938C19.25 37.6966 19.5577 37.375 19.9375 37.375H26.8125C27.1923 37.375 27.5 37.6966 27.5 38.0938V39.5312ZM27.5 21.5625V30.1875C27.5 30.9817 26.8847 31.625 26.125 31.625H6.875C6.11531 31.625 5.5 30.9817 5.5 30.1875V21.5625C5.5 20.7683 6.11531 20.125 6.875 20.125H26.125C26.8847 20.125 27.5 20.7683 27.5 21.5625Z"
                            fill="white" />
                    </svg>
                </div>
                <h1 class="font-medium text-xl mb-3 lg:px-14 text-darken">
                    {{strtoupper($subject)}}
                </h1>
                <p>
                    {!! $subject !!}
                </p>
                {{-- <p class="px-4 text-gray-500">
                </p> --}}
            </a>
        @endforeach
    </div>
    {{-- <div class="flex justify-center items-center mt-4" data-aos="fade-up" data-aos-delay="150">
        <a href="/subjects" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Load More
        </a>
    </div> --}}

    <!-- Assessments, Quizzes, Tests -->
    <div class="mt-20 flex flex-col-reverse md:flex-row items-center md:space-x-10">
        <div data-aos="fade-right" class="md:w-6/12">
            <img class="md:w-11/12" src="{{asset('website/img/true-false.png')}}" />
        </div>
        <div data-aos="fade-left" class="md:w-6/12 md:transform md:-translate-y-20">
            <h1 class="font-semibold text-darken text-3xl lg:pr-64">
                Assessments, <span class="text-yellow-500">Quizzes</span>, Tests
            </h1>
            <p class="text-gray-500 my-5 lg:pr-52">
                Easily launch live assignments, quizzes, and tests. Student results
                are automatically entered in the online gradebook.
            </p>
        </div>
    </div>
</div>
<!-- .container -->
@endsection

@push('scripts')
    <script src="{{asset('adminLayout/lib/jquery/jquery.min.js')}}"></script>
    <script>
        function playVideo(e){
            $(e.currentTarget).parents('.main-video-component').empty()
            .append('<video class="rounded-lg shadow-lg w-full" src="{{asset("website/video/home-video.webm")}}" autoplay="1" controls></video>');

            $.ajax({
                url : "/update-views",
                method : 'POST',
                data : {
                    _token : "{{csrf_token()}}"
                }
            });
        }
    </script>
@endpush
