  <!-- js placed at the end of the document so the pages load faster -->
  <script src="{{asset('adminLayout/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('adminLayout/lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <script class="include" type="text/javascript" src="{{asset('adminLayout/lib/jquery.dcjqaccordion.2.7.js')}}"></script>
  <script src="{{asset('adminLayout/lib/jquery.scrollTo.min.js')}}"></script>
  <script src="{{asset('adminLayout/lib/jquery.nicescroll.js')}}" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="{{asset('adminLayout/lib/common-scripts.js')}}"></script>
  <!--script for this page-->

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
