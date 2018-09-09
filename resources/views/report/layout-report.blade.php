<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <!--     <link rel="icon" href="../../../../favicon.ico">
        -->
        <title>Dashboard Template for Bootstrap</title>
        <!-- Bootstrap core CSS -->
        <link href="{{url('vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
        <!-- Custom styles for this template -->
        <link href="{{url('css/report.css')}}" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('report/data-jamaah')}}">Data Jamaah</a>
                    </li>
{{--                     <li class="nav-item">
                        <a class="nav-link" href="#">Data Pesawat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Data Hotel</a>
                    </li> --}}
                </ul>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <main role="main" class="col-md-12">
                    <div class="content">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="{{url('vendor/jquery-3.2.1.min.js')}}"></script>
        <!-- Bootstrap JS-->
        <script src="{{url('vendor/bootstrap-4.1/popper.min.js')}}"></script>
        <script src="{{url('vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
        <!-- Icons -->
        <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
        <script>
        feather.replace()
        </script>
    </body>
</html>