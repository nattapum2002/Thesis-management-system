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
                <a href="/admin">
                    <div>
                        <img src="{{ asset('Asset/main/img/logo/RMUTI.png') }}" alt="RMUTI.png">
                    </div>
                    <span>TMS.TC</span>
                </a>
            </div>
            <hr>
            <div class="sidebar-user">
                <a href="/admin/edit_admin">
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
                        <small>อาจารย์ประจำวิชา</small>
                    </div>
                </a>
            </div>
            <hr>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <div class="sidebar-collapse">
                    <a href="#"
                        class="sidebar-link has-dropdown collapsed{{ Request::is('admin/manage_project') || Request::is('admin/approve_documents') ? 'off active' : '' }}"
                        data-bs-target="#project" data-bs-toggle="collapse"
                        aria-expanded="{{ Request::is('admin/manage_project') || Request::is('admin/approve_documents') ? 'true' : 'false' }}">
                        <div>
                            <i class='nav-icon bx bx-book'></i>
                            <span class="link-name">โปรเจค</span>
                        </div>
                        <i class="bx bx-chevron-down arrow"></i>
                    </a>
                </div>
                <ul id="project"
                    class="sidebar-dropdown list-unstyled collapse {{ Request::is('admin/manage_project') || Request::is('admin/approve_documents') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/manage_project') ? 'active' : '' }}"
                            href="/admin/manage_project">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">จัดการโปรเจค</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/approve_documents') ? 'active' : '' }}"
                            href="/admin/approve_documents">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">อนุมัติเอกสาร</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <div class="sidebar-collapse">
                    <a href="#"
                        class="sidebar-link has-dropdown collapsed{{ Request::is('admin/manage_teacher') || Request::is('admin/manage_member') || Request::is('admin/edit_admin') ? 'off active' : '' }}"
                        data-bs-target="#manage_user" data-bs-toggle="collapse"
                        aria-expanded="{{ Request::is('admin/manage_teacher') || Request::is('admin/manage_member') || Request::is('admin/edit_admin') ? 'true' : 'false' }}">
                        <div>
                            <i class='nav-icon bx bx-user'></i>
                            <span class="link-name">จัดการบัญชีผู้ใช้</span>
                        </div>
                        <i class="bx bx-chevron-down arrow"></i>
                    </a>
                </div>
                <ul id="manage_user"
                    class="sidebar-dropdown list-unstyled collapse {{ Request::is('admin/manage_teacher') || Request::is('admin/manage_member') || Request::is('admin/edit_admin') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/manage_teacher') ? 'active' : '' }}"
                            href="/admin/manage_teacher">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">จัดการบัญชีอาจารย์</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/manage_member') ? 'active' : '' }}"
                            href="/admin/manage_member">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">จัดการบัญชีสมาชิก</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/edit_admin') ? 'active' : '' }}"
                            href="/admin/edit_admin">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">จัดการบัญชีผู้ดูแลระบบ</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <div class="sidebar-collapse">
                    <a href="#"
                        class="sidebar-link has-dropdown collapsed{{ Request::is('admin/manage_exam_schedule') || Request::is('admin/manage_document_schedule') ? 'off active' : '' }}"
                        data-bs-target="#manage_schedule" data-bs-toggle="collapse"
                        aria-expanded="{{ Request::is('admin/manage_exam_schedule') || Request::is('admin/manage_document_schedule') ? 'true' : 'false' }}">
                        <div>
                            <i class='nav-icon bx bx-calendar-edit'></i>
                            <span class="link-name">จัดการกำหนดการ</span>
                        </div>
                        <i class="bx bx-chevron-down arrow"></i>
                    </a>
                </div>
                <ul id="manage_schedule"
                    class="sidebar-dropdown list-unstyled collapse {{ Request::is('admin/manage_exam_schedule') || Request::is('admin/manage_document_schedule') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/manage_exam_schedule') ? 'active' : '' }}"
                            href="/admin/manage_exam_schedule">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">กำหนดกรรมการและเวลาสอบ</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/manage_document_schedule') ? 'active' : '' }}"
                            href="/admin/manage_document_schedule">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">จัดการกำหนดการเอกสาร</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <div class="sidebar-collapse">
                    <a href="#"
                        class="sidebar-link has-dropdown collapsed{{ Request::is('admin/manage_news') || Request::is('admin/approve_news') ? 'off active' : '' }}"
                        data-bs-target="#manage_news" data-bs-toggle="collapse"
                        aria-expanded="{{ Request::is('admin/manage_news') || Request::is('admin/approve_news') ? 'true' : 'false' }}">
                        <div>
                            <i class='nav-icon bx bx-news'></i>
                            <span class="link-name">จัดการข่าว</span>
                        </div>
                        <i class="bx bx-chevron-down arrow"></i>
                    </a>
                </div>
                <ul id="manage_news"
                    class="sidebar-dropdown list-unstyled collapse {{ Request::is('admin/manage_news') || Request::is('admin/approve_news') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/manage_news') ? 'active' : '' }}"
                            href="/admin/manage_news">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">จัดการข่าวของผู้ดูแลระบบ</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('admin/approve_news') ? 'active' : '' }}"
                            href="/admin/approve_news/">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">ซ่อน-แสดง ข่าวของผู้ใช้</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('admin/approve_thesis') ? 'active' : '' }}"
                    href="/admin/approve_thesis">
                    <i class='nav-icon bx bx-bookmarks'></i>
                    <span class="link-name">ซ่อน-แสดง บทความของผู้ใช้</span>
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
                <a href="/admin/menu_thesis_login"
                    class="navbar-link {{ Request::is('admin/menu_thesis_login') ? 'active' : '' }}">
                    <i class='nav-icon bx bx-bookmarks'></i>
                    <span>บทความปริญญานิพนธ์</span>
                </a>
            </li>
            <li class="navbar-item my-1">
                <a href="/admin/menu_news_login"
                    class="navbar-link {{ Request::is('admin/menu_news_login') ? 'active' : '' }}">
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
    @yield('script')
@endsection
