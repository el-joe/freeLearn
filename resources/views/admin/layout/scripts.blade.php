  <!-- js placed at the end of the document so the pages load faster -->
  <script src="{{asset('adminLayout/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('adminLayout/lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <script class="include" type="text/javascript" src="{{asset('adminLayout/lib/jquery.dcjqaccordion.2.7.js')}}"></script>
  <script src="{{asset('adminLayout/lib/jquery.scrollTo.min.js')}}"></script>
  <script src="{{asset('adminLayout/lib/jquery.nicescroll.js')}}" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="{{asset('adminLayout/lib/common-scripts.js')}}"></script>
  <!--script for this page-->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
      @if (session()->has('success'))
          swal({
              text: "{{ session('success') }}",
              icon: "success",
          })

      @endif

      @if (session()->has('error'))
          swal({
              text: "{{ session('error') }}",
              icon: "error",
          })
      @endif
  </script>


  <script>
    $('.deleteThis').click(function (e) {
        e.preventDefault();

        var url = $(this).attr('href');

        $.ajax({
            url,
            type: 'DELETE',
            data: {
                _token: '{{csrf_token()}}'
            },
        });

        location.reload();
    });
  </script>
