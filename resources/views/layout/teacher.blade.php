@extends('layout.master')

{{-- title --}}
@section('mastertitle')
@yield('title')
@endsection

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
            <a href="/teacher" class="nav-link">ระบบจัดการปริญญานิพนธ์</a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="/teacher/menu_thesis_login" class="nav-link">บทความปริญญานิพนธ์</a>
        </li>
        <li class="nav-item">
            <a href="/teacher/menu_news_login" class="nav-link">ข่าวประชาสัมพันธ์</a>
        </li>
        <li class="nav-item">
            <a href="https://computer.surin.rmuti.ac.th/computer/index.php" target="_blank"
                class="nav-link">เกี่ยวกับสาขา</a>
        </li>
        <li class="nav item">
            <a class="btn btn-danger" href="{{route('logout')}}">ออกจากระบบ</a>
        </li>
    </ul>
</div>
@endsection

{{-- sidebar --}}
@section('mastersidebar')
<a href="/teacher" class="brand-link">
    <img src="{{asset('Asset/main/img/logo/RMUTI.png')}}" alt="RMUTI.png" class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">TMS.TC</span>
</a>
<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('storage/'.Auth::guard('teachers')->user()->teacher_image) }}"
                class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="/teacher/edit_teacher" class="d-block">
                {{ Auth::guard('teachers')->user()->name }} {{ Auth::guard('teachers')->user()->surname }}
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
                        <a class="nav-link active" href="#">
                            <i class='nav-icon bx bx-circle'></i>
                            จัดการโปรเจค
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/teacher/approve_documents_teacher">
                            <i class='nav-icon bx bx-circle'></i>
                            อนุมัติเอกสาร
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/teacher/edit_teacher">
                    <i class='nav-icon bx bx-user'></i>
                    <p>
                        จัดการบัญชีผู้ใช้
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/teacher/manage_news">
                    <i class='nav-icon bx bx-news'></i>
                    <p>
                        จัดการข่าวประชาสัมพันธ์
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
                    @yield('navigation')
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

@endsection

{{-- script --}}
@section('masterscript')

@endsection
