@extends('web.layout.index')

@section('content')
    <!-- Create By Joker Banny -->
    <style>
        @layer utilities {

            input[type="number"]::-webkit-inner-spin-button,
            input[type="number"]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
        }
    </style>

    <div class="h-screen bg-gray-100 pt-20">
        <h1 class="mb-10 text-center text-2xl font-bold">Previous Carts</h1>
        <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
            <div class="rounded-lg md:w-2/3">
                @foreach ($orders as $order)
                    <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
                        <img src="{{ asset('logo.png') }}" alt="product-image" class="w-full rounded-lg sm:w-40" />
                        <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                            <div class="mt-5">
                                <h2 class="text-lg flex-1 font-bold text-gray-900">#{{ $order->id }}</h2>
                                <p class="mt-1 ml-2 flex-1/2 text-xs text-gray-700">
                                    Fawry Code : <span
                                        class="text-sm font-bold">{{ $order->payment_data['referenceNumber'] ?? 'ERROR' }}</span>
                                </p>
                                <p class="mt-1 ml-2 flex-1/2 text-xs text-{{ $order->paid == 1 ? 'green' : 'red' }}-700">
                                    {{ $order->paid == 1 ? 'Paid' : 'Not Paid' }}
                                </p>
                            </div>
                            <div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
                                <div class="flex items-center border-gray-100">
                                    <label for="QTY">Quantity</label>&nbsp;
                                    <input class="h-8 w-8 border bg-white text-center text-xs outline-none" readonly
                                        disabled type="number" value="{{$order->video_num}}" min="1" />
                                </div>
                                <div class="flex items-center space-x-4">
                                    <p class="text-sm">{{ $order->total }} LE</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Sub total -->
            {{-- <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
                <div class="mb-2 flex justify-between">
                    <p class="text-gray-700">Subtotal</p>
                    <p class="text-gray-700">{{ number_format($orders->sum('subtotal'), 2) }} LE</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-gray-700">VAT</p>
                    <p class="text-gray-700">{{ number_format($orders->sum('vat'), 2) }} LE</p>
                </div>
                <hr class="my-4" />
                <div class="flex justify-between">
                    <p class="text-lg font-bold">Total</p>
                    <div class="">
                        <p class="mb-1 text-lg font-bold">{{ number_format($orders->sum('total'), 2) }} LE</p>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
