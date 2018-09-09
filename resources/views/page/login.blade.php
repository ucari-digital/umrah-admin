<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>
	@include('component.header')
    @yield('header')
</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <h4>LOGIN</h4>
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="{{url('login')}}" method="post">
                            	@csrf
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <a href="#">Forgotten Password?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{url('vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{url('vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{url('vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{url('vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{url('vendor/wow/wow.min.js')}}"></script>
    <script src="{{url('vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{url('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{url('vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{url('vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{url('vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{url('vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{url('vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{url('vendor/select2/select2.min.js')}}"></script>
    <script src="{{url('vendor/maskmoney/jquery.maskMoney.js')}}"></script>
    <!-- Main JS-->
    <script src="{{url('js/main.js')}}"></script>
    <script src="{{url('js/jquery-printme.min.js')}}"></script>
    <script src="{{url('js/paginathing.js')}}"></script>

</body>

</html>
<!-- end document-->