@extends('layout.admin')
@section('title')
    รายละเอียดข่าว
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="/admin/approve_news">ซ่อน-แสดง ข่าวของผู้ใช้</a></li>
@endsection
@section('content')
    @livewire('news.detail-approve-news', ['id' => $newsId])
    <a href="/admin/approve_news" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
