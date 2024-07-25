<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $lang ?? app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ระบบจัดการปริญานิพนธ์ | @yield('title')</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
        rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />

    <style>
        header.masthead {
            padding-top: 40rem;
            padding-bottom: calc(20rem - 4.5rem);
            background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%), url("https://fastly.picsum.photos/id/2/5000/3333.jpg?hmac=_KDkqQVttXw_nM-RyJfLImIbafFrqLsuGO5YuHqD-qQ");
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: scroll;
            background-size: cover;
        }

        header.masthead h1,
        header.masthead .h1 {
            font-size: 2.25rem;
        }

        @media (min-width: 992px) {
            header.masthead {
                height: 100vh;
                min-height: 40rem;
                padding-top: 4.5rem;
                padding-bottom: 0;
            }

            header.masthead p {
                font-size: 1.15rem;
            }

            header.masthead h1,
            header.masthead .h1 {
                font-size: 3rem;
            }
        }

        @media (min-width: 1200px) {

            header.masthead h1,
            header.masthead .h1 {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

@include('layout.css')

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="/">ระบบจัดการปริญญานิพนธ์</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/menu_thesis">บทความปริญญานิพนธ์</a></li>
                    <li class="nav-item"><a class="nav-link" href="/menu_news">ข่าวประชาสัมพันธ์</a></li>
                    <li class="nav-item"><a href="https://computer.surin.rmuti.ac.th/computer/index.php"
                            class="nav-link" target="_blank">เกี่ยวกับสาขา</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            เข้าสู่ระบบ
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/login_member">นักศึกษา</a></li>
                            <li><a class="dropdown-item" href="/login_teacher">อาจารย์</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="/register">สมัครสมาชิก</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer-->
    <footer class="bg-light py-5">
        <div class="container px-4 px-lg-5">
            <div class="small text-center text-muted">ระบบจัดการปริญญานิพนธ์ สาขาเทคโนโลยีคอมพิวเตอร์</div>
        </div>
    </footer>

    @include('layout.script')
</body>

</html>
