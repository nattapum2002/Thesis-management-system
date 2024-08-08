@extends('layout.admin')
@section('title')
    ซ่อน-แสดง ข่าวของผู้ใช้
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
@endsection
@section('content')
    @livewire('news.approve-news')
    <a href="/admin" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
