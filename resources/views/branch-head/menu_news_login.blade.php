@extends('layout.branch-head')
@section('title')
ข่าวประชาสัมพันธ์
@endsection
@section('navigation')
<li class="breadcrumb-item"><a href="/branch-head">Dashboard</a></li>
@endsection
@section('content')
@livewire('news.menu-news-login')
<a href="/branch-head" class="btn btn-primary mb-3">ย้อนกลับ</a>
@endsection
