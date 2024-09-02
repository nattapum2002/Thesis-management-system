<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $lang ?? app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ระบบจัดการปริญานิพนธ์ | @yield('title')</title>

    <!-- css -->
    @include('layout.css')

    <!-- welcome.css -->
    <link href="{{ Asset('Asset/main/css/welcome2.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Navigation-->

    <nav class="navbar navbar-expand-xl navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="{{ route('welcome') }}">ระบบจัดการปริญญานิพนธ์</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto my-2 my-lg-0">
                    <li class="navbar-item my-1"><a
                            class="navbar-link {{ Route::is('welcome.thesis') || Route::is('welcome.thesis.detail') ? 'active' : '' }}"
                            href="{{ route('welcome.thesis') }}">บทความปริญญานิพนธ์</a>
                    </li>
                    <li class="navbar-item my-1"><a
                            class="navbar-link {{ Route::is('welcome.news') || Route::is('welcome.news.detail') ? 'active' : '' }}"
                            href="{{ route('welcome.news') }}">ข่าวประชาสัมพันธ์</a></li>
                    <li class="navbar-item my-1"><a href="https://computer.surin.rmuti.ac.th/computer/index.php"
                            class="navbar-link" target="_blank">เกี่ยวกับสาขา</a></li>
                    <li class="navbar-item my-1 dropdown">
                        <a class="navbar-link dropdown-toggle {{ Route::is('login.member') ? 'active' : '' }} {{ Route::is('login.teacher') ? 'active' : '' }}"
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            เข้าสู่ระบบ
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('login.member') }}">นักศึกษา</a></li>
                            <li><a class="dropdown-item" href="{{ route('login.teacher') }}">อาจารย์</a></li>
                        </ul>
                    </li>
                </ul>
                <a class="btn btn-brand ms-lg-3" href="{{ route('register') }}">สมัครสมาชิก</a>
            </div>
        </div>
    </nav>

    <div class="content">
        @yield('content')
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

    @include('layout.script')
</body>

</html>
