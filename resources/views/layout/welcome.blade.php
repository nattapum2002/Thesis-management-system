<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ระบบจัดการปริญานิพนธ์ | @yield('title')</title>
</head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<body>
    <div class="container">
        <div class="navbar">
            <a href="/"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <span class="fs-4">ระบบจัดการปริญญานิพนธ์</span>
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item"><a href="/menu_thesis" class="nav-link">บทความปริญญานิพนธ์</a></li>
                <li class="nav-item"><a href="/menu_news" class="nav-link">ข่าวประชาสัมพันธ์</a></li>
                <li class="nav-item"><a href="#" class="nav-link">เกียวกับสาขา</a></li>
                <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">เข้าสู่ระบบ</a></li>
            </ul>
        </div>

        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>