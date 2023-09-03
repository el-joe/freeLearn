@extends('web.layout.index')

@section('content')
    <div class="container px-4 lg:px-8 mx-auto max-w-screen-xl text-gray-700 mt-20">
        <h1 class="text-darken text-center text-2xl font-semibold">
            Acadimic Years
        </h1>


        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 mt-20">

            @foreach ($years as $year)
                <div
                    class=" col-span-1 text-center flex flex-col items-center p-6 bg-white border border-gray-200 rounded-lg shadow-md w-fit">

                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $year->name }}</h5>


                    <div class="flex gap-3 mx-auto w-full justify-center" role="group">
                        <a href="{{ route('subjects', [$type,$year->id, 1]) }}"
                            class="border border-green-600 rounded-lg flex items-center p-5 hover:shadow-xl overflow-hidden">
                            Semester 1
                        </a>
                        <a href="{{ route('subjects', [$type, $year->id, 2]) }}"
                            class="border border-green-600 rounded-lg flex items-center p-5 hover:shadow-xl overflow-hidden">
                            Semester 2
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
