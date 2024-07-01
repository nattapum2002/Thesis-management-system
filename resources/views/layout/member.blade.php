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
<<<<<<< HEAD
            {{-- <img src="{{ asset('storage/'.Auth::guard('members')->user()->student_image) }}"
                class="img-circle elevation-2" alt="User Image"> --}}
=======
            @if (Auth::guard('members')->user()->student_image == null)
            <img src="{{ asset('Asset/dist/img/avatar'.rand('1', '5').'.png') }}" alt="User Image"
                class="img-circle elevation-2">
            @else
            <img src="{{ asset('storage/'.Auth::guard('members')->user()->student_image) }}"
                class="img-circle elevation-2" alt="User Image">
            @endif
>>>>>>> 7180dd9122fc7bd9108b4592b6805ff9a7fa5fed
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
                        <a class="nav-link" href="{{route('submit_document')}}">
                            <i class='nav-icon bx bx-circle'></i>
                            ยื่นเอกสารโปรเจค
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('manage_document')}}">
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

@endsection

{{-- script --}}
@section('masterscript')

@endsection
