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
                <a href="/teacher">
                    <div>
                        <img src="{{ asset('Asset/main/img/logo/RMUTI.png') }}" alt="RMUTI.png">
                    </div>
                    <span>TMS.TC</span>
                </a>
            </div>
            <hr>
            <div class="sidebar-user">
                <a href="/teacher/edit_teacher">
                    <div class="image">
                        @if (Auth::guard('teachers')->user()->teacher_image == null)
                            <img src="{{ asset('Asset/dist/img/avatar' . rand('1', '5') . '.png') }}" alt="UserImage">
                        @else
                            <img src="{{ asset('storage/' . Auth::guard('teachers')->user()->teacher_image) }}"
                                alt="UserImage">
                        @endif
                    </div>
                    <div class="info">
                        <span>{{ Auth::guard('teachers')->user()->name . ' ' . Auth::guard('teachers')->user()->surname }}</span>
                        <small>อาจารย์</small>
                    </div>
                </a>
            </div>
            <hr>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <div class="sidebar-collapse">
                    <a href="#"
                        class="sidebar-link has-dropdown collapsed{{ Request::is('teacher/manage_project') || Request::is('admin/approve_documents_teacher') ? 'off active' : '' }}"
                        data-bs-target="#project" data-bs-toggle="collapse"
                        aria-expanded="{{ Request::is('teacher/manage_project') || Request::is('teacher/approve_documents_teacher') ? 'true' : 'false' }}">
                        <div>
                            <i class='nav-icon bx bx-book'></i>
                            <span class="link-name">โปรเจค</span>
                        </div>
                        <i class="bx bx-chevron-down arrow"></i>
                    </a>
                </div>
                <ul id="project"
                    class="sidebar-dropdown list-unstyled collapse {{ Request::is('teacher/manage_project') || Request::is('teacher/approve_documents_teacher') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('teacher/manage_project') ? 'active' : '' }}"
                            href="/teacher/manage_project">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">จัดการโปรเจค</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('teacher/approve_documents_teacher') ? 'active' : '' }}"
                            href="/teacher/approve_documents_teacher">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">อนุมัติเอกสาร</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('teacher/edit_teacher') ? 'active' : '' }}"
                    href="/teacher/edit_teacher">
                    <i class='nav-icon bx bx-user'></i>
                    <span class="link-name">จัดการบัญชีผู้ใช้</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('teacher/manage_news') ? 'active' : '' }}"
                    href="/teacher/manage_news">
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
                <a href="/teacher/menu_thesis_login"
                    class="navbar-link {{ Request::is('teacher/menu_thesis_login') ? 'active' : '' }}">
                    <i class='nav-icon bx bx-bookmarks'></i>
                    <span>บทความปริญญานิพนธ์</span>
                </a>
            </li>
            <li class="navbar-item my-1">
                <a href="/teacher/menu_news_login"
                    class="navbar-link {{ Request::is('teacher/menu_news_login') ? 'active' : '' }}">
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
