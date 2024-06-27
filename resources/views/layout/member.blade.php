@extends('layout.master')

{{-- title --}}
@section('mastertitle')
@yield('title')
@endsection

<<<<<<< HEAD
{{-- css --}}
@section('mastercss')

@endsection

{{-- navbar --}}
@section('masternavbar')
<div class="container-fluid">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
            <a href="/member" class="nav-link">ระบบจัดการปริญญานิพนธ์</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="/menu_thesis" class="nav-link">บทความปริญญานิพนธ์</a>
        </li>
        <li class="nav-item">
            <a href="/menu_news" class="nav-link">ข่าวประชาสัมพันธ์</a>
        </li>
        <li class="nav-item">
            <a href="https://computer.surin.rmuti.ac.th/computer/" class="nav-link">เกียวกับสาขา</a>
        </li>
        <li class="nav item">
            <a class="btn btn-danger" href="{{route('logout')}}">ออกจากระบบ</a>
        </li>
    </ul>
</div>
@endsection

{{-- sidebar --}}
@section('mastersidebar')
<a href="/member" class="brand-link">
    <img src="{{asset('Asset/main/img/logo/RMUTI.png')}}" alt="RMUTI.png" class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">TMS.TC</span>
</a>
<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('storage/'.Auth::guard('members')->user()->student_image) }}"
                class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="/member/edit_member" class="d-block">
                {{Auth::guard('members')->user()->name}} {{Auth::guard('members')->user()->surname}}
            </a>
        </div>
    </div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a class="nav-link active">
                    <i class='nav-icon bx bx-book'></i>
                    <p>
                        โปรเจค
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a class="nav-link active" href="/member/submit_project_documents">
                            <i class='nav-icon bx bx-circle'></i>
                            ยื่นเอกสารโปรเจค
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/member/manage_document">
                            <i class='nav-icon bx bx-circle'></i>
                            จัดการเอกสาร
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/member/edit_member">
                    <i class='nav-icon bx bx-user'></i>
                    <p>
                        จัดการบัญชีผู้ใช้
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/member/manage_thesis_member">
                    <i class='nav-icon bx bx-news'></i>
                    <p>
                        จัดการบทความปริญญานิพนธ์
                    </p>
                </a>
            </li>
        </ul>
    </nav>
</div>
@endsection

{{-- content --}}
@section('mastercontent')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">@yield('title')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/member">Dashboard</a></li>
                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        @yield('content')
    </div>
</section>
@endsection

{{-- footer --}}
@section('masterfooter')
=======
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
>>>>>>> f00d0975e56290881ee21f26a325b79d120bf432

@endsection

{{-- script --}}
@section('masterscript')

@endsection