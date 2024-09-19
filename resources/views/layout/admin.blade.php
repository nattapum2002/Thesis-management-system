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
                <a href="{{ route('admin.dashboard') }}">
                    <div>
                        <img src="{{ asset('Asset/main/img/logo/RMUTI.png') }}" alt="RMUTI.png">
                    </div>
                    <span>TMS.TC</span>
                </a>
            </div>
            <hr>
            <div class="sidebar-user">
                <a href="{{ route('admin.edit.admin') }}">
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
                        class="sidebar-link has-dropdown collapsed{{ Route::is('admin.manage.project') || Route::is('admin.detail.project') || Route::is('admin.approve.documents') ? 'off active' : '' }}"
                        data-bs-target="#project" data-bs-toggle="collapse"
                        aria-expanded="{{ Route::is('admin.manage.project') || Route::is('admin.detail.project') || Route::is('admin.approve.documents') ? 'true' : 'false' }}">
                        <div>
                            <i class='nav-icon bx bx-book'></i>
                            <span class="link-name">โปรเจค</span>
                        </div>
                        <i class="bx bx-chevron-down arrow"></i>
                    </a>
                </div>
                <ul id="project"
                    class="sidebar-dropdown list-unstyled collapse {{ Route::is('admin.manage.project') || Route::is('admin.detail.project') || Route::is('admin.approve.documents') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('admin.manage.project') || Route::is('admin.detail.project') ? 'active' : '' }}"
                            href="{{ route('admin.manage.project') }}">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">จัดการโปรเจค</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('admin.approve.documents') ? 'active' : '' }}"
                            href="{{ route('admin.approve.documents') }}">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">อนุมัติเอกสาร</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <div class="sidebar-collapse">
                    <a href="#"
                        class="sidebar-link has-dropdown collapsed{{ Route::is('admin.manage.exam.schedule') || Route::is('admin.manage.document.schedule') || Route::is('admin.add.document.schedule') || Route::is('admin.edit.detail.document.schedule') ? 'off active' : '' }}"
                        data-bs-target="#manage_schedule" data-bs-toggle="collapse"
                        aria-expanded="{{ Route::is('admin.manage.exam.schedule') || Route::is('admin.manage.document.schedule') || Route::is('admin.add.document.schedule') || Route::is('admin.edit.detail.document.schedule') ? 'true' : 'false' }}">
                        <div>
                            <i class='nav-icon bx bx-calendar-edit'></i>
                            <span class="link-name">จัดการกำหนดการ</span>
                        </div>
                        <i class="bx bx-chevron-down arrow"></i>
                    </a>
                </div>
                <ul id="manage_schedule"
                    class="sidebar-dropdown list-unstyled collapse {{ Route::is('admin.manage.exam.schedule') || Route::is('admin.manage.document.schedule') || Route::is('admin.add.document.schedule') || Route::is('admin.edit.detail.document.schedule') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('admin.manage.exam.schedule') ? 'active' : '' }}"
                            href="{{ route('admin.manage.exam.schedule') }}">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">ตารางสอบ</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('admin.manage.document.schedule') || Route::is('admin.add.document.schedule') || Route::is('admin.edit.detail.document.schedule') ? 'active' : '' }}"
                            href="{{ route('admin.manage.document.schedule') }}">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">จัดการกำหนดการเอกสาร</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <div class="sidebar-collapse">
                    <a href="#"
                        class="sidebar-link has-dropdown collapsed{{ Route::is('admin.manage.teacher') || Route::is('admin.add.teacher') || Route::is('admin.approve.teacher') || Route::is('admin.manage.member') || Route::is('admin.approve.member') || Route::is('admin.edit.admin') ? 'off active' : '' }}"
                        data-bs-target="#manage_user" data-bs-toggle="collapse"
                        aria-expanded="{{ Route::is('admin.manage.teacher') || Route::is('admin.add.teacher') || Route::is('admin.approve.teacher') || Route::is('admin.manage.member') || Route::is('admin.approve.member') || Route::is('admin.edit.admin') ? 'true' : 'false' }}">
                        <div>
                            <i class='nav-icon bx bx-user'></i>
                            <span class="link-name">จัดการบัญชีผู้ใช้</span>
                        </div>
                        <i class="bx bx-chevron-down arrow"></i>
                    </a>
                </div>
                <ul id="manage_user"
                    class="sidebar-dropdown list-unstyled collapse {{ Route::is('admin.manage.teacher') || Route::is('admin.add.teacher') || Route::is('admin.approve.teacher') || Route::is('admin.manage.member') || Route::is('admin.approve.member') || Route::is('admin.edit.admin') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('admin.manage.teacher') || Route::is('admin.add.teacher') || Route::is('admin.approve.teacher') ? 'active' : '' }}"
                            href="{{ route('admin.manage.teacher') }}">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">จัดการบัญชีอาจารย์</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('admin.manage.member') || Route::is('admin.approve.member') ? 'active' : '' }}"
                            href="{{ route('admin.manage.member') }}">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">จัดการบัญชีสมาชิก</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('admin.edit.admin') ? 'active' : '' }}"
                            href="{{ route('admin.edit.admin') }}">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">จัดการบัญชีผู้ดูแลระบบ</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <div class="sidebar-collapse">
                    <a href="#"
                        class="sidebar-link has-dropdown collapsed{{ Route::is('admin.manage.news') || Route::is('admin.add.news') || Route::is('admin.edit.detail.news') || Route::is('admin.approve.news') || Route::is('admin.detail.approve.news') ? 'off active' : '' }}"
                        data-bs-target="#manage_news" data-bs-toggle="collapse"
                        aria-expanded="{{ Route::is('admin.manage.news') || Route::is('admin.add.news') || Route::is('admin.edit.detail.news') || Route::is('admin.approve.news') || Route::is('admin.detail.approve.news') ? 'true' : 'false' }}">
                        <div>
                            <i class='nav-icon bx bx-news'></i>
                            <span class="link-name">จัดการข่าว</span>
                        </div>
                        <i class="bx bx-chevron-down arrow"></i>
                    </a>
                </div>
                <ul id="manage_news"
                    class="sidebar-dropdown list-unstyled collapse {{ Route::is('admin.manage.news') || Route::is('admin.add.news') || Route::is('admin.edit.detail.news') || Route::is('admin.approve.news') || Route::is('admin.detail.approve.news') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('admin.manage.news') || Route::is('admin.add.news') || Route::is('admin.edit.detail.news') ? 'active' : '' }}"
                            href="{{ route('admin.manage.news') }}">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">จัดการข่าวของผู้ดูแลระบบ</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('admin.approve.news') || Route::is('admin.detail.approve.news') ? 'active' : '' }}"
                            href="{{ route('admin.approve.news') }}">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">ซ่อน-แสดง ข่าวของผู้ใช้</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Route::is('admin.approve.thesis') || Route::is('admin.detail.approve.thesis') ? 'active' : '' }}"
                    href="{{ route('admin.approve.thesis') }}">
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
                <a href="{{ route('admin.menu.thesis') }}"
                    class="navbar-link {{ Route::is('admin.menu.thesis') || Route::is('admin.detail.thesis') ? 'active' : '' }}">
                    <i class='nav-icon bx bx-bookmarks'></i>
                    <span>บทความปริญญานิพนธ์</span>
                </a>
            </li>
            <li class="navbar-item my-1">
                <a href="{{ route('admin.menu.news') }}"
                    class="navbar-link {{ Route::is('admin.menu.news') || Route::is('admin.detail.news') ? 'active' : '' }}">
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
