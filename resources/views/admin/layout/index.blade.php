<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Free Learn | @yield('title')</title>

  <!-- Favicons -->
  <link href="{{asset('adminLayout/img/favicon.png')}}" rel="icon">
  <link href="{{asset('adminLayout/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  @include('admin.layout.styles')
  @stack('styles')

</head>

<body>
  <section id="container">
    @include('admin.layout.header')

    @include('admin.layout.sidebar')

    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> @yield('title') |  <a href="@yield('previousUrl')">Back</a></h3>
        <hr>
        @isset($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{$error}}
                </div>
            @endforeach
        @endisset
        <!-- page start-->
        <div class="row mt">
            @yield('content')
        </div>
      </section>
    </section>
    @include('admin.layout.footer')
</section>


@include('admin.layout.scripts')
@stack('scripts')

</body>

</html>
