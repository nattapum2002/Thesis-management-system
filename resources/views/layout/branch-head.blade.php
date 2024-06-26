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
<div class="navbar">
    <a href="/admin" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <span class="fs-4">ระบบจัดการปริญญานิพนธ์</span>
    </a>

    <ul class="nav nav-pills">
        <li class="nav-item"><a href="/menu_thesis" class="nav-link">บทความปริญญานิพนธ์</a></li>
        <li class="nav-item"><a href="/menu_news" class="nav-link">ข่าวประชาสัมพันธ์</a></li>
        <li class="nav-item"><a href="https://computer.surin.rmuti.ac.th/computer/" class="nav-link">เกียวกับสาขา</a>
        </li>
        <li class="nav item"><a class="btn btn-danger" href="{{route('logout')}}">ออกจากระบบ</a></li>
    </ul>
</div>
@endsection

{{-- sidebar --}}
@section('mastersidebar')
<div class="sidebar">
    <div class="title">
        <a href="/admin">
            <i class='bx bx-user'></i>
            <h4>dashboard</h4>
        </a>

        <div class="title-name">
            <i class='bx bx-user'></i>
            <span>Branch Head</span>
        </div>
    </div>
    <ul style="list-style-type: none">
        <div class="dropdown dropend">
            <a class="dropdown-toggle" data-bs-toggle="dropdown">
                <i class='bx bx-user'></i>
                <span>โปรเจค</span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#">จัดการโปรเจค</a></li>
                <li><a href="/branch-head/approve_documents_branch_head">อนุมัติเอกสาร</a></li>
            </ul>
        </div>
        <li><a href="/branch-head/edit_branch_head"><i class='bx bx-user'></i>จัดการบัญชีผู้ใช้</a></li>
        <li><a href="/branch-head/manage_news_branch_head"><i class='bx bx-news'></i>จัดการข่าวประชาสัมพันธ์</a></li>
    </ul>
</div>
@endsection

{{-- content --}}
@section('mastercontent')
@yield('content')
@endsection

{{-- footer --}}
@section('masterfooter')

@endsection

{{-- script --}}
@section('masterscript')

@endsection
