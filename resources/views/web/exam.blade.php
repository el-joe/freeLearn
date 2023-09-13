@extends('web.layout.index')

@section('content')
    <form action="{{route('submitExam',$subId)}}" method="POST">
        @csrf
        <div class="container px-4 lg:px-8 mx-auto h-full max-w-screen-xl text-gray-700">
            @foreach ($lesson->questions as $key => $q)
                <div class="flex flex-col mt-20 gap-10">
                    <div class="relative mt-20 sm:mt-0">
                        <span class="tex-green-500 text-2xl font-medium">Question {{ $key + 1 }}</span>
                        @if ($q->type == 'image')
                            <img class="bg-white bg-opacity-80 rounded-lg" src="{{ $q->file?->file_path }}" width="200"
                                height="50" />
                        @else
                            <span class="tex-green-500 text-2xl font-medium">{{ $q->source }}</span>
                        @endif
                    </div>

                    <div class="flex flex-row gap-5">
                        <!-- radion buttons  -->
                        @foreach ($q->options as $key => $option)
                            <label for="slider{{ $option->id }}">
                                <input type="radio" name="question[{{ $q->id }}]" value="{{ ++$key }}"
                                    id="slider{{ $option->id }}" />
                                <br>
                                @if ($option->type == 'image')
                                    <img class="bg-white bg-opacity-80 rounded-lg" src="{{ $option->file?->file_path }}"
                                        width="200" height="50" />
                                @else
                                    {{ $option->source }}
                                @endif
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <br>
            <br>
            <br>
            <br>
            <button class="text-gray-700 bg-cream rounded-full px-4 py-2 font-semibold text-sm">Submit Exam</button>
        </div>
    </form>
    <div id="image-viewer">
        <span class="close">&times;</span>
        <img class="modal-content" id="full-image">
    </div>
@endsection

@push('styles')
    <style>
        /* Style the Image Used to Trigger the Modal */
        img {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        img:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        #image-viewer {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.9);
        }

        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        .modal-content {
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        #image-viewer .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        #image-viewer .close:hover,
        #image-viewer .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(".container img").click(function() {
            $("#full-image").attr("src", $(this).attr("src"));
            $('#image-viewer').show();
        });

        $("#image-viewer .close").click(function() {
            $('#image-viewer').hide();
        });
    </script>
@endpush
