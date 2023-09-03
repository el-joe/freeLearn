@extends('web.layout.index')

@section('content')
    <div class="container px-4 lg:px-8 mx-auto max-w-screen-xl text-gray-700 overflow-x-hidden mt-20">
        <h1 class="text-darken text-center text-2xl font-semibold">
            Our Subjects
        </h1>

        <!-- card -->
        <div class="grid md:grid-cols-3 gap-14 md:gap-5 mt-20 py-20">
            @foreach ($subjects as $subject)
            <?php $data = base64_encode(json_encode([
                'type'=>$type,
                'yearId'=>$yearId,
                'semester'=>$semester,
                'subjectId'=> $subject->id
            ])); ?>
            <a  href="{{route('playlist',$data)}}" data-aos="fade-up"
                class="bg-white shadow-xl p-6 text-center rounded-xl duration-300 hover:scale-105 cursor-pointer">
                <div style="background: #5b72ee"
                    class="rounded-full w-16 h-16 flex items-center justify-center mx-auto shadow-lg transform -translate-y-12">
                    <svg class="w-6 h-6 text-white" viewBox="0 0 33 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M24.75 23H8.25V28.75H24.75V23ZM32.3984 9.43359L23.9852 0.628906C23.5984 0.224609 23.0742 0 22.5242 0H22V11.5H33V10.952C33 10.3859 32.7852 9.83789 32.3984 9.43359ZM19.25 12.2188V0H2.0625C0.919531 0 0 0.961328 0 2.15625V43.8438C0 45.0387 0.919531 46 2.0625 46H30.9375C32.0805 46 33 45.0387 33 43.8438V14.375H21.3125C20.1781 14.375 19.25 13.4047 19.25 12.2188ZM5.5 6.46875C5.5 6.07164 5.80766 5.75 6.1875 5.75H13.0625C13.4423 5.75 13.75 6.07164 13.75 6.46875V7.90625C13.75 8.30336 13.4423 8.625 13.0625 8.625H6.1875C5.80766 8.625 5.5 8.30336 5.5 7.90625V6.46875ZM5.5 12.2188C5.5 11.8216 5.80766 11.5 6.1875 11.5H13.0625C13.4423 11.5 13.75 11.8216 13.75 12.2188V13.6562C13.75 14.0534 13.4423 14.375 13.0625 14.375H6.1875C5.80766 14.375 5.5 14.0534 5.5 13.6562V12.2188ZM27.5 39.5312C27.5 39.9284 27.1923 40.25 26.8125 40.25H19.9375C19.5577 40.25 19.25 39.9284 19.25 39.5312V38.0938C19.25 37.6966 19.5577 37.375 19.9375 37.375H26.8125C27.1923 37.375 27.5 37.6966 27.5 38.0938V39.5312ZM27.5 21.5625V30.1875C27.5 30.9817 26.8847 31.625 26.125 31.625H6.875C6.11531 31.625 5.5 30.9817 5.5 30.1875V21.5625C5.5 20.7683 6.11531 20.125 6.875 20.125H26.125C26.8847 20.125 27.5 20.7683 27.5 21.5625Z"
                            fill="white" />
                    </svg>
                </div>
                <h1 class="font-medium text-xl mb-3 lg:px-14 text-darken">
                    {{$subject->name}}
                </h1>
            </a>
            @endforeach
        </div>

        <!-- Assessments, Quizzes, Tests -->
    </div>
@endsection
