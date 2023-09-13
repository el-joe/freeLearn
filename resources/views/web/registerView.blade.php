@extends('web.layout.index')

@section('content')
<form action="{{route('registerPost')}}" method="POST">
    @csrf
    <?php $errorClass = 'border-red-500  focus:outline-none focus:shadow-outline'; ?>
    <div class="container mx-auto">
        <div class="flex justify-center px-6 my-12">
            <!-- Row -->
            <div class="w-full xl:w-3/4 lg:w-11/12 flex">
                <!-- Col -->
                <div
                    class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
                    style="background-image: url('https://source.unsplash.com/DNhCPsVF8l4/600x800')"
                ></div>
                <!-- Col -->
                <div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
                    <h3 class="pt-4 text-2xl text-center">Register</h3>
                    <form class="px-8 pt-6 pb-8 mb-4 bg-white rounded">
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                                Name
                            </label>
                            <input
                                class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none @error('name') {{$errorClass}} @enderror"
                                id="name"
                                type="text"
                                name="name"
                                placeholder="John .."
                            />
                            @error('name')
                                <p class="text-xs italic text-red-500">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="phone">
                                Phone Number
                            </label>
                            <input
                                class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none @error('phone') {{$errorClass}} @enderror"
                                id="phone"
                                type="text"
                                name="phone"
                                placeholder="010********"
                            />
                            @error('email')
                                <p class="text-xs italic text-red-500">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                                Email
                            </label>
                            <input
                                class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none @error('email') {{$errorClass}} @enderror"
                                id="email"
                                type="text"
                                name="email"
                                placeholder="example@example.com"
                            />
                            @error('email')
                                <p class="text-xs italic text-red-500">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                                Password
                            </label>
                            <input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none"
                                id="password"
                                type="password"
                                name="password"
                                placeholder="******************"
                            />
                            {{-- <p class="text-xs italic text-red-500">Please choose a password.</p> --}}
                        </div>
                        <div class="mb-6 text-center">
                            <button
                                class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                type="submit"
                            >
                                Register
                            </button>
                        </div>
                        <hr class="mb-6 border-t" />
                        <div class="text-center">
                            <a
                                class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                                href="login"
                            >
                                you have Account? Login!
                            </a>
                        </div>
                        {{-- <div class="text-center">
                            <a
                                class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                                href="#"
                            >
                                Forgot Password?
                            </a>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('styles')
  @vite('resources/js/login.js')
@endpush

@push('scripts')

@endpush
