@extends('layout.admin')
@section('title')
    รายละเอียดและแก้ไขข่าว
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="/admin/manage_news">จัดการข่าวประชาสัมพันธ์</a></li>
@endsection
@section('content')
    @livewire('news.edit-and-detail-news', ['id' => $newsId])
    <a href="/admin/manage_news" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
