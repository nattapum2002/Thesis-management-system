@extends('layout.branch-head')
@section('title')
รายละเอียดและแก้ไขข่าว
@endsection
@section('navigation')
<li class="breadcrumb-item"><a href="/branch-head/manage_news">จัดการข่าวประชาสัมพันธ์</a></li>
@endsection
@section('content')
@livewire('news.edit-and-detail-news', ['id' => $newsId])
<a href="/branch-head/manage_news" class="btn btn-primary mb-3">ย้อนกลับ</a>
@endsection
