@extends('layout.admin')
@section('title')
    ข่าวประชาสัมพันธ์
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
@endsection
@section('content')
    @livewire('news.menu-news-login')
    <a href="/admin" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
