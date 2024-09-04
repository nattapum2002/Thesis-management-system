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
                <a href="{{ route('member.dashboard') }}">
                    <div>
                        <img src="{{ asset('Asset/main/img/logo/RMUTI.png') }}" alt="RMUTI.png">
                    </div>
                    <span>TMS.TC</span>
                </a>
            </div>
            <hr>
            <div class="sidebar-user">
                <a href="{{ route('member.edit.member') }}">
                    <div class="image">
                        @php
                            $userImage = optional(Auth::guard('members')->user())->student_image;
                            $imagePath = $userImage
                                ? asset('storage/' . $userImage)
                                : asset('Asset/dist/img/avatar' . rand(1, 5) . '.png');
                        @endphp

                        <img src="{{ $imagePath }}" alt="UserImage">
                    </div>
                    <div class="info">
                        {{ Auth::guard('members')->user()->name . ' ' . Auth::guard('members')->user()->surname }}
                        <small>นักศึกษา</small>
                    </div>
                </a>
            </div>
            <hr>
        </div>
        <ul class="sidebar-nav" data-widget="treeview" role="menu" data-accordion="false">
            <li class="sidebar-item">
                <div class="sidebar-collapse">
                    <a href="#"
                        class="sidebar-link has-dropdown collapsed{{ Route::is('member.manage.submit.document') || Route::is('member.manage.document') ? 'off active' : '' }}"
                        data-bs-target="#project" data-bs-toggle="collapse"
                        aria-expanded="{{ Route::is('member.manage.submit.document') || Route::is('member.manage.document') ? 'true' : 'false' }}">
                        <div>
                            <i class='nav-icon bx bx-book'></i>
                            <span class="link-name">จัดการโปรเจค</span>
                        </div>
                        <i class="bx bx-chevron-down arrow"></i>
                    </a>
                </div>
                <ul id="project"
                    class="sidebar-dropdown list-unstyled collapse {{ Route::is('member.manage.submit.document') || Route::is('member.manage.document') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('member.manage.submit.document') ? 'active' : '' }}"
                            href="{{ route('member.manage.submit.document') }}">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">ยื่นเอกสารโปรเจค</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('member.manage.document') ? 'active' : '' }}"
                            href="{{ route('member.manage.document') }}">
                            <i class='nav-icon bx bx-circle'></i>
                            <span class="link-name">จัดการเอกสาร</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Route::is('member.edit.member') ? 'active' : '' }}"
                    href="{{ route('member.edit.member') }}">
                    <i class='nav-icon bx bx-user'></i>
                    <span class="link-name">จัดการบัญชีผู้ใช้</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Route::is('member.manage.thesis') || Route::is('member.add.thesis') || Route::is('member.edit.detail.thesis') ? 'active' : '' }}"
                    href="{{ route('member.manage.thesis') }}">
                    <i class='nav-icon bx bx-news'></i>
                    <span class="link-name">จัดการบทความปริญญานิพนธ์</span>
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
                <a href="{{ route('member.menu.thesis') }}"
                    class="navbar-link {{ Route::is('member.menu.thesis') || Route::is('member.detail.thesis') ? 'active' : '' }}">
                    <i class='nav-icon bx bx-bookmarks'></i>
                    <span>บทความปริญญานิพนธ์</span>
                </a>
            </li>
            <li class="navbar-item my-1">
                <a href="{{ route('member.menu.news') }}"
                    class="navbar-link {{ Route::is('member.menu.news') || Route::is('member.detail.news') ? 'active' : '' }}">
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
