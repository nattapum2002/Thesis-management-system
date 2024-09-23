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
                <a href="{{ route('branch-head.dashboard') }}">
                    <div>
                        <img src="{{ asset('Asset/main/img/logo/RMUTI.png') }}" alt="RMUTI.png">
                    </div>
                    <span>TMS.TC</span>
                </a>
            </div>
            <hr>
            <div class="sidebar-user">
                <a href="{{ route('branch-head.edit.branch-head') }}">
                    <div class="image">
                        @if (Auth::guard('teachers')->user()->teacher_image)
                            {{-- Thesis-management-system/storage/app/public/ --}}
                            <img src="{{ asset('storage/' . Auth::guard('teachers')->user()->teacher_image) }}"
                                alt="UserImage">
                        @else
                            <img src="{{ asset('Asset/dist/img/avatar' . rand('1', '5') . '.png') }}" alt="UserImage">
                        @endif
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
                        class="sidebar-link has-dropdown collapsed{{ Route::is('branch-head.manage.project') || Route::is('branch-head.detail.project') || Route::is('branch-head.approve.documents') || Route::is('detail_document_01') || Route::is('detail_document_02') || Route::is('detail_document_03') || Route::is('detail_document_04') || Route::is('detail_document_05') || Route::is('detail_document_06') || Route::is('detail_document_07') ? 'off active' : '' }}"
                        data-bs-target="#project" data-bs-toggle="collapse"
                        aria-expanded="{{ Route::is('branch-head.manage.project') || Route::is('branch-head.detail.project') || Route::is('branch-head.approve.documents') || Route::is('detail_document_01') || Route::is('detail_document_02') || Route::is('detail_document_03') || Route::is('detail_document_04') || Route::is('detail_document_05') || Route::is('detail_document_06') || Route::is('detail_document_07') ? 'true' : 'false' }}">
                        <div>
                            <i class='nav-icon bx bx-book'></i>
                            <span class="link-name">โปรเจค</span>
                        </div>
                        <i class="bx bx-chevron-down arrow"></i>
                    </a>
                </div>
                <ul id="project"
                    class="sidebar-dropdown list-unstyled collapse {{ Route::is('branch-head.manage.project') || Route::is('branch-head.detail.project') || Route::is('branch-head.approve.documents') || Route::is('detail_document_01') || Route::is('detail_document_02') || Route::is('detail_document_03') || Route::is('detail_document_04') || Route::is('detail_document_05') || Route::is('detail_document_06') || Route::is('detail_document_07') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('branch-head.manage.project') || Route::is('branch-head.detail.project') ? 'active' : '' }}"
                            href="{{ route('branch-head.manage.project') }}">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">จัดการโปรเจค</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('branch-head.approve.documents') || Route::is('detail_document_01') || Route::is('detail_document_02') || Route::is('detail_document_03') || Route::is('detail_document_04') || Route::is('detail_document_05') || Route::is('detail_document_06') || Route::is('detail_document_07') ? 'active' : '' }}"
                            href="{{ route('branch-head.approve.documents') }}">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">อนุมัติเอกสาร</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <div class="sidebar-collapse">
                    <a href="#"
                        class="sidebar-link has-dropdown collapsed{{ Route::is('branch-head.manage.exam.schedule') || Route::is('branch-head.manage.document.schedule') || Route::is('branch-head.add.document.schedule') || Route::is('branch-head.edit.detail.document.schedule') ? 'off active' : '' }}"
                        data-bs-target="#manage_schedule" data-bs-toggle="collapse"
                        aria-expanded="{{ Route::is('branch-head.manage.exam.schedule') || Route::is('branch-head.manage.document.schedule') || Route::is('branch-head.add.document.schedule') || Route::is('branch-head.edit.detail.document.schedule') ? 'true' : 'false' }}">
                        <div>
                            <i class='nav-icon bx bx-calendar-edit'></i>
                            <span class="link-name">ตารางกำหนดการ</span>
                        </div>
                        <i class="bx bx-chevron-down arrow"></i>
                    </a>
                </div>
                <ul id="manage_schedule"
                    class="sidebar-dropdown list-unstyled collapse {{ Route::is('branch-head.manage.exam.schedule') || Route::is('branch-head.manage.document.schedule') || Route::is('branch-head.add.document.schedule') || Route::is('branch-head.edit.detail.document.schedule') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('branch-head.manage.exam.schedule') ? 'active' : '' }}"
                            href="{{ route('branch-head.manage.exam.schedule') }}">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">ตารางสอบ</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('branch-head.manage.document.schedule') || Route::is('branch-head.add.document.schedule') || Route::is('branch-head.edit.detail.document.schedule') ? 'active' : '' }}"
                            href="{{ route('branch-head.manage.document.schedule') }}">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">ตารางการส่งเอกสาร</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Route::is('branch-head.edit.branch-head') ? 'active' : '' }}"
                    href="{{ route('branch-head.edit.branch-head') }}">
                    <i class='nav-icon bx bx-user'></i>
                    <span class="link-name">จัดการบัญชีผู้ใช้</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Route::is('branch-head.manage.news') || Route::is('branch-head.add.news') || Route::is('branch-head.edit.detail.news') ? 'active' : '' }}"
                    href="{{ route('branch-head.manage.news') }}">
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
                <a href="{{ route('branch-head.menu.thesis') }}"
                    class="navbar-link {{ Route::is('branch-head.menu.thesis') || Route::is('branch-head.detail.thesis') ? 'active' : '' }}">
                    <i class='nav-icon bx bx-bookmarks'></i>
                    <span>บทความปริญญานิพนธ์</span>
                </a>
            </li>
            <li class="navbar-item my-1">
                <a href="{{ route('branch-head.menu.news') }}"
                    class="navbar-link {{ Route::is('branch-head.menu.news') || Route::is('branch-head.detail.news') ? 'active' : '' }}">
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
