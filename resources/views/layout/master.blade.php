<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $lang ?? app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('Asset/main/img/logo/favicon.png') }}" type="image/png">
    <title>ระบบจัดการปริญานิพนธ์ | @yield('mastertitle')</title>

    <!-- Css -->
    @yield('mastercss')
    @include('layout.css')

    <!-- master.css -->
    <link rel="stylesheet" href="{{ asset('Asset/main/css/master2.css') }}">

    @livewireStyles

</head>

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
    <script src="{{ asset('js/app.js') }}"></script>
    @livewireScripts
    @yield('masterscript')
    @include('layout.script')
</body>

</html>
