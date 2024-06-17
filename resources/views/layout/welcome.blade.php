<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ระบบจัดการปริญานิพนธ์ | @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .navbar-brand {
            font-size: 1.5rem;
        }

        .carousel-caption {
            top: 50%;
            transform: translateY(-50%);
            bottom: initial;
        }

        .carousel-caption h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .carousel-caption p {
            font-size: 1.25rem;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .news-card {
            position: relative;
        }

        .ribbon {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: red;
            color: white;
            padding: 5px;
            font-size: 0.8rem;
            z-index: 10;
        }

        /* รูปภาพขนาดด้านเท่าในหน้าเมนู */
        .news-card .thesis-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /* รูปภาพขนาดใหญ่ในหน้ารายละเอียด */
        .img-detail {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
        }
    </style>

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg ">
        <div class="container">
            <a class="navbar-brand" href="/">ระบบจัดการปริญญานิพนธ์</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/menu_news">ข่าวประชาสัมพันธ์</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/menu_thesis">บทความปริญญานิพนธ์</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="https://computer.surin.rmuti.ac.th/computer/index.php">เกี่ยวกับสาขา</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            เข้าสู่ระบบ
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">นักศึกษา</a></li>
                            <li><a class="dropdown-item" href="#">อาจารย์</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary" href="#">สมัครสมาชิก</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <div class="footer">
        <p>ระบบจัดการปริญญานิพนธ์ สาขาเทคโนโลยีคอมพิวเตอร์</p>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>