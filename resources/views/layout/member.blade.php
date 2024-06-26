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
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.1/css/boxicons.min.css" rel="stylesheet">
@livewireStyles
{{--
<link href="{{Asset('Asset/main/css/sidebar.css')}}" rel="stylesheet"> --}}

<body>
    <div class="row">
        <div class="col-sm-2">
            {{-- Main Sidebar --}}
            <div class="d-flex">
                <div class="sidebar border-end">
                    <div class="title">
                        <a href="/member">
                            <i class='bx bx-user'></i>
                            <h4>Dashboard</h4>
                        </a>
                        <div class="title-name">
                            <i class='bx bx-user'></i>
                            <span>{{ Auth::guard('members')->user()->name }} {{ Auth::guard('members')->user()->surname }}</span>
                        </div>
                    </div>
                    <ul>
                        <li><a href="/member/submit_project_documents"><i class='bx bx-file'></i> ยื่นเอกสารโปรเจค</a></li>
                        <li>
                            <a href="#" data-bs-toggle="collapse" data-bs-target="#manageDocuments" aria-expanded="false" aria-controls="manageDocuments">
                                <i class='bx bx-user'></i> จัดการเอกสาร
                            </a>
                            <ul id="manageDocuments" class="collapse submenu">
                                <li><a href="/member/manage-document-01">เอกสารย่อย 1</a></li>
                                <li><a href="/member/manage_document_2">เอกสารย่อย 2</a></li>
                                <li><a href="/member/manage_document_3">เอกสารย่อย 3</a></li>
                                <li><a href="/member/manage_document_4">เอกสารย่อย 4</a></li>
                                <li><a href="/member/manage_document_5">เอกสารย่อย 5</a></li>
                                <li><a href="/member/manage_document_6">เอกสารย่อย 6</a></li>
                                <li><a href="/member/manage_document_7">เอกสารย่อย 7</a></li>
                            </ul>
                        </li>
                        <li><a href="/member/edit_member"><i class='bx bx-user'></i> จัดการบัญชีผู้ใช้</a></li>
                        <li><a href="/member/manage_thesis_member"><i class='bx bx-book'></i> จัดการบทความปริญญานิพนธ์</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-10">
            <div class="navbar">
                <a href="/admin" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <span class="fs-4">ระบบจัดการปริญญานิพนธ์</span>
                </a>
                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="/menu_thesis" class="nav-link">บทความปริญญานิพนธ์</a></li>
                    <li class="nav-item"><a href="/menu_news" class="nav-link">ข่าวประชาสัมพันธ์</a></li>
                    <li class="nav-item"><a href="https://computer.surin.rmuti.ac.th/computer/" class="nav-link">เกียวกับสาขา</a></li>
                    <li class="nav-item"><a class="btn btn-danger" href="{{ route('logout') }}">ออกจากระบบ</a></li>
                </ul>
            </div>
            {{-- Content --}}
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>

</html>