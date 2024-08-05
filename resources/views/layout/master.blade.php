<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $lang ?? app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ระบบจัดการปริญานิพนธ์ | @yield('mastertitle')</title>

    <!-- Css -->
    @yield('mastercss')
    @include('layout.css')

    <!-- master.css -->
    <link rel="stylesheet" href="{{ asset('Asset/main/css/master2.css') }}">
</head>

{{-- <body class="sidebar-mini hold-transition layout-navbar-fixed layout-fixed">
    <div class="wrapper">
        <!-- Main Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand">
            @yield('mastersidebar')
        </aside>

        <!-- Navber -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            @yield('masternavbar')
        </nav>

        <!-- Content -->
        <div class="content-wrapper">
            @yield('mastercontent')
            <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button"
                aria-label="Scroll to top">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                @yield('masterfooter')
            </div>
        </footer>
    </div>

    <!-- Script -->
    @yield('masterscript')
    @include('layout.script')
</body> --}}

<body>
    <div class="wrapper">
        <!-- Main Sidebar -->
        <aside id="sidebar" class="">
            @yield('mastersidebar')
        </aside>

        <div class="main">
            <!-- Navber -->
            <nav class="navbar navbar-expand">
                @yield('masternavbar')
            </nav>

            <!-- Content -->
            <div class="content">
                @yield('mastercontent')
                <a id="back-to-top" href="#" class="btn btn-back-to-top" role="button"
                    aria-label="Scroll to top">
                    <i class='bx bx-chevron-up'></i>
                </a>
            </div>

            <!-- Footer -->
            {{-- <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    @yield('masterfooter')
                </div>
            </footer> --}}
            <footer class="bg-cover">
                <div class="footer-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 mx-auto">
                                <a class="navbar-brand" href="#">ระบบจัดการปริญญานิพนธ์</a>
                                <p>ระบบจัดการปริญญานิพนธ์ สาขาเทคโนโลยีคอมพิวเตอร์
                                    เป็นโครงงานปริญญานิพนธ์ที่นักศึกษาพัฒนาขึ้นมาเพื่อการเรียนรู้ในสาขางานของตนเอง</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <p class="mb-0">Copyright © 2022. All right reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Script -->
    @yield('masterscript')
    @include('layout.script')
</body>

</html>
