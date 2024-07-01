@extends('layout.branch-head')
@section('title')
เพิ่มข่าว
@endsection
@section('navigation')
<li class="breadcrumb-item"><a href="/branch-head/manage_news">จัดการข่าวประชาสัมพันธ์</a></li>
@endsection
@section('content')
@livewire('news.add-news')
<a href="/branch-head/manage_news" class="btn btn-primary mb-3">ย้อนกลับ</a>
@endsection
