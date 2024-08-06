@extends('layout.member')
@section('title')
    ข่าวประชาสัมพันธ์
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="/member">Dashboard</a></li>
@endsection
@section('content')
    @livewire('news.menu-news-login')
    <a href="/member" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
