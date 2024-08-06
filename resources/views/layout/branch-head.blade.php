@extends('layout.master')

{{-- title --}}
@section('mastertitle')
    @yield('title')
@endsection

{{-- css --}}
@section('mastercss')
@endsection

{{-- sidebar --}}
@section('mastersidebar')
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <a href="/branch-head">
                    <div>
                        <img src="{{ asset('Asset/main/img/logo/RMUTI.png') }}" alt="RMUTI.png">
                    </div>
                    <span>TMS.TC</span>
                </a>
            </div>
            <hr>
            <div class="sidebar-user">
                <a href="/branch-head/edit_branch_head">
                    <div class="image">
                        <img src="{{ asset('storage/' . Auth::guard('teachers')->user()->teacher_image) }}"alt="UserImage">
                    </div>
                    <div class="info">
                        <span>{{ Auth::guard('teachers')->user()->name . ' ' . Auth::guard('teachers')->user()->surname }}</span>
                        <small>หัวหน้าสาขา</small>
                    </div>
                </a>
            </div>
            <hr>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <div class="sidebar-collapse">
                    <a href="#"
                        class="sidebar-link has-dropdown collapsed{{ Request::is('branch-head/manage_project') || Request::is('branch-head/approve_documents_branch_head') ? 'off active' : '' }}"
                        data-bs-target="#project" data-bs-toggle="collapse"
                        aria-expanded="{{ Request::is('branch-head/manage_project') || Request::is('branch-head/approve_documents_branch_head') ? 'true' : 'false' }}">
                        <div>
                            <i class='nav-icon bx bx-book'></i>
                            <span class="link-name">โปรเจค</span>
                        </div>
                        <i class="bx bx-chevron-down arrow"></i>
                    </a>
                </div>
                <ul id="project"
                    class="sidebar-dropdown list-unstyled collapse {{ Request::is('branch-head/manage_project') || Request::is('branch-head/approve_documents_branch_head') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('branch-head/manage_project') ? 'active' : '' }}"
                            href="/branch-head/manage_project">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">จัดการโปรเจค</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('branch-head/approve_documents_branch_head') ? 'active' : '' }}"
                            href="/branch-head/approve_documents_branch_head">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">อนุมัติเอกสาร</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('branch-head/edit_branch_head') ? 'active' : '' }}"
                    href="/branch-head/edit_branch_head">
                    <i class='nav-icon bx bx-user'></i>
                    <span class="link-name">จัดการบัญชีผู้ใช้</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('branch-head/manage_news') ? 'active' : '' }}"
                    href="/branch-head/manage_news">
                    <i class='nav-icon bx bx-news'></i>
                    <span class="link-name">จัดการข่าวประชาสัมพันธ์</span>
                </a>
            </li>
        </ul>
    </div>
@endsection

{{-- navbar --}}
@section('masternavbar')
    <button class="btn" id="toggleSidebar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ms-auto my-2 my-lg-0">
            <li class="navbar-item my-1">
                <a href="/branch-head/menu_thesis_login"
                    class="navbar-link {{ Request::is('branch-head/menu_thesis_login') ? 'active' : '' }}">
                    <i class='nav-icon bx bx-bookmarks'></i>
                    <span>บทความปริญญานิพนธ์</span>
                </a>
            </li>
            <li class="navbar-item my-1">
                <a href="/branch-head/menu_news_login"
                    class="navbar-link {{ Request::is('branch-head/menu_news_login') ? 'active' : '' }}">
                    <i class='nav-icon bx bx-news'></i>
                    <span>ข่าวประชาสัมพันธ์</span>
                </a>
            </li>
            <li class="navbar-item my-1">
                <a href="https://computer.surin.rmuti.ac.th/computer/index.php" target="_blank" class="navbar-link">
                    <i class='bx bx-info-circle'></i>
                    <span>เกี่ยวกับสาขา</span>
                </a>
            </li>
            <li class="navbar-item my-1">
                <a class="btn btn-logout" href="{{ route('logout') }}">
                    <i class='bx bx-log-out'></i>
                    <span>ออกจากระบบ</span>
                </a>
            </li>
        </ul>
    </div>
@endsection

{{-- content --}}
@section('mastercontent')
    <section id="content-header">
        <div class="row mb-2">
            <div class="col col-sm-12">
                <h1 class="m-0">@yield('title')</h1>
                <ol class="breadcrumb">
                    @yield('navigation')
                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
            </div>
        </div>
    </section>
    @yield('content')
@endsection

{{-- footer --}}
@section('masterfooter')
@endsection

{{-- script --}}
@section('masterscript')
@endsection
