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
        <span class="fs-4 navbar-brand">ระบบจัดการปริญญานิพนธ์</span>
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
            <span>{{ Auth::guard('teachers')->user()->name }} {{ Auth::guard('teachers')->user()->surname
                }}</span>
        </div>
    </div>
    <ul style="list-style-type: none">
        <div class="dropdown dropend">
            <a class="dropdown-toggle" data-bs-toggle="dropdown">
                <i class='bx bx-user'></i>
                <span>โปรเจค</span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="/admin/admin_project">จัดการโปรเจค</a></li>
                <li><a href="/admin/approve_documents">อนุมัติเอกสาร</a></li>
            </ul>
        </div>
        <div class="dropdown dropend">
            <a class="dropdown-toggle" data-bs-toggle="dropdown">
                <i class='bx bx-user'></i>
                <span>จัดการบัญชีผู้ใช้</span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="/admin/manage_teacher">จัดการบัญชีอาจารย์</a></li>
                <li><a href="/admin/manage_member">จัดการบัญชีสมาชิก</a></li>
                <li><a href="/admin/edit_admin">จัดการบัญชีผูดูแลระบบ</a></li>
            </ul>
        </div>
        <div class="dropdown dropend">
            <a class="dropdown-toggle" data-bs-toggle="dropdown">
                <i class='bx bx-calendar-edit'></i>
                <span>จัดการกำหนดการ</span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="/admin/manage_exam_schedule">กำหนดกรรมการและเวลาสอบ</a></li>
                <li><a href="/admin/manage_document_schedule">จัดการกำหนดการเอกสาร</a></li>
            </ul>
        </div>
        <li><a href="/admin/manage_news"><i class='bx bx-news'></i>จัดการข่าวประชาสัมพันธ์</a></li>
        <li><a href="/admin/manage_thesis"><i class='bx bx-book'></i>จัดการบทความปริญญานิพนธ์</a></li>
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
