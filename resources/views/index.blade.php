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
    <title>Dashboard</title>
    @include('component.header')
    @yield('header')
</head>

<body class="animsition">
    <div class="page-wrapper">
        {{-- MENU SIDEBAR --}}
        @include('component.sidebar')
        {{-- END MEDNU SIDEBAR --}}

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        @yield('navbar')
                        @php
                        $notif = App\Http\Controllers\NotificationController::notification();
                        @endphp
                        <span class="setting nav-icon float-right pt-1" data-toggle="popover">
                            <i class="fas fa-cog"></i>
                        </span>
                        <span class="notification float-right pt-1 mr-2" data-toggle="popover">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-danger cs-badge">{{$notif['counter']}}</span>
                        </span>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                @yield('content')
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
    <div id="image-modal" class="modal">
        <!-- The Close Button -->
        <span class="close">&times;</span>
        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="image-place">
        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
    </div>
    
    <div class="d-none template-notification">
        @include('component.notification')
    </div>
    <div class="d-none template-setting">
        @include('component.setting')
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
    <script src="{{url('js/modal-image.js')}}"></script>
    <script src="{{url('data-table/datatables.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    @yield('footer')
    @include('component.footer')
</body>

</html>
<!-- end document-->
