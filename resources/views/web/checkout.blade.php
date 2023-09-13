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
    <h1 class="mb-10 text-center text-2xl font-bold">Cart</h1>
    <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
      <div class="rounded-lg md:w-2/3">
        <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
            <img src="{{asset('logo.png')}}" alt="product-image" class="w-full rounded-lg sm:w-40" />
            <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                <div class="mt-1">
                    <h2 class="text-lg flex-1 font-bold text-gray-900">How Many Video you want ?</h2>
                </div>
              <div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
                <div class="flex items-center border-gray-100">
                  <span class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50" onclick="decrease(event)"> - </span>
                  <input class="h-8 w-8 border bg-white text-center text-xs outline-none" type="number" value="1" min="1" />
                  <span class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50" onclick="increase(event)"> + </span>
                </div>
              </div>
            </div>
          </div>
      </div>
      <!-- Sub total -->
      <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
        <div class="mb-2 flex justify-between">
          <p class="text-gray-700">Subtotal</p>
          <p class="text-gray-700 subtotal">10.00 LE</p>
        </div>
        <div class="flex justify-between">
          <p class="text-gray-700">VAT</p>
          <p class="text-gray-700 vat">2.25 LE</p>
        </div>
        <hr class="my-4" />
        <div class="flex justify-between">
          <p class="text-lg font-bold">Total</p>
          <div class="">
            <p class="mb-1 text-lg font-bold total">12.25 LE</p>
            {{-- <p class="text-sm text-gray-700">including VAT</p> --}}
          </div>
        </div>
        <button class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600" onclick="saveOrder(event)">Get Fawry Code</button>
        <div class="flex justify-center mt-5 fawri-code hidden">
            <p class="text-lg font-bold text-white bg-green-700 rounded-lg p-3 refNum">
                12314584184
            </p>
        </div>
      </div>
    </div>
  </div>

  <script src="{{asset('adminLayout/lib/jquery/jquery.min.js')}}"></script>

  <script>
    var price = parseInt("{{App\Models\Setting::where('column_name', 'lesson_price')->first()->value}}");


    function increase(event) {
        var newQty = parseInt($(event.currentTarget).siblings('input').val()) + 1;
        $(event.currentTarget).siblings('input').val(newQty);

        newCalc(newQty);
    }

    function decrease(event) {
        if(parseInt($(event.currentTarget).siblings('input').val()) == 1) return;

        var newQty = parseInt($(event.currentTarget).siblings('input').val()) - 1;
        $(event.currentTarget).siblings('input').val(newQty);

        newCalc(newQty);
    }

    function newCalc(newQty) {
        var subtotal = newQty * price;

        $('.subtotal').text(subtotal.toFixed(2) + ' LE');

        var vat = (subtotal * 0.025) + 2;

        $('.vat').text(vat.toFixed(2) + ' LE');

        var total = subtotal + vat;

        $('.total').text(total.toFixed(2) + ' LE');
    }

    function saveOrder(event) {

        // make btn hidden

        $(event.currentTarget).addClass('hidden');

        $.ajax({
            url : '/checkout',
            method : 'POST',
            data : {
                'video_num' : $('input[type="number"]').val(),
                '_token' : '{{csrf_token()}}'
            },
            success : function (data) {
                $('.fawri-code').removeClass('hidden');
                $('.refNum').text(data.ref_num);
            }
        });
    }
  </script>
@endsection
