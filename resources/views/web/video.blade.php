@extends('web.layout.index')


@section('content')
    <div class="container px-4 lg:px-8 mx-auto max-w-screen-xl text-gray-700">
        <h1 class="text-darken text-center text-2xl font-semibold mt-20">
            {{$lesson->name}}
        </h1>
        <div class="flex flex-col mt-20 gap-10">
            @if($subscription)
                <div data-aos="fade-left" class="relative mt-20 sm:mt-0">
                    <video class="rounded-lg shadow-lg w-full" src="{{ $lesson->video?->file_path }}" poster="{{$lesson->thumb?->file_path}}" controlsList="nodownload" controls></video>
                    {{-- <span
                        class="bg-white w-40 h-40 text-5xl font-medium rounded-full flex items-center justify-center absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 transform transition duration-300 ease-in-out z-0">
                        20
                    </span> --}}
                </div>
                <p id="exam">
                    Exam : {{$examPassCount}} / {{$examAllCount}}
                </p>
                <p id="demo"></p>
            @else
            <div class="flex items-center justify-center w-full">
                <button onclick="buyNow({{$lesson->id}})" class="mt-9 text-base font-semibold leading-none text-white py-4 px-10 bg-indigo-700 rounded hover:bg-indigo-600 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 focus:outline-none">Buy Now</button>
            </div>
            @endif

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

@push('styles')
<style>
    p#demo , p#exam {
        text-align: center;
        font-size: 60px;
        margin-top: 0px;
        font-weight: 700;
    }
</style>
@endpush

@push('scripts')
<script src="{{asset('adminLayout/lib/jquery/jquery.min.js')}}"></script>

<script>
    $(document).keydown(function (event) {
        if (event.keyCode == 123) { // Prevent F12
            return false;
        } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
            return false;
        }else if (event.ctrlKey && (event.keyCode === 85)) {//Alt+u
            return false;
        }

    });

    $(document).on("contextmenu", function (e) {
        e.preventDefault();
    });

    function buyNow(lessonId) {
        $.ajax({
            url : '/buy-now/'+lessonId,
            type : 'POST',
            data : {
                _token : '{{csrf_token()}}'
            },
            success : function (response) {
                window.location.href = response.url;
            }
        });
    }
</script>

@if($subscription)
<script>
    // Set the date we're counting down to
    var countDownDate = new Date("{{$expireDate->format('Y-m-d H:i')}}").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

      // Get today's date and time
      var now = new Date().getTime();

      // Find the distance between now and the count down date
      var distance = countDownDate - now;

      // Time calculations for days, hours, minutes and seconds
    //   var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Output the result in an element with id="demo"
      document.getElementById("demo").innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

      // If the count down is over, write some text
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
      }
    }, 1000);

</script>
@endif
@endpush
