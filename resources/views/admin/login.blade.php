<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>FreeLearn | Login</title>

    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <link href="{{ asset('adminLayout/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminLayout/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminLayout/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('adminLayout/css/style-responsive.css') }}" rel="stylesheet">
</head>

<body>
    <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
    <div id="login-page">
        <div class="container">
            <form class="form-login" action="{{ route('admin.postLogin') }}" method="POST">
                @csrf
                <h2 class="form-login-heading">sign in</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="login-wrap">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="User ID" autofocus>
                    <br>
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <br>
                    <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i>
                        SIGN IN</button>
                </div>
            </form>
        </div>
    </div>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{ asset('adminLayout/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminLayout/lib/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="{{ asset('adminLayout/lib/jquery.backstretch.min.js') }}"></script>
    <script>
        $.backstretch("{{ asset('adminLayout/img/login-bg.jpg') }}", {
            speed: 500
        });
    </script>
</body>

</html>
