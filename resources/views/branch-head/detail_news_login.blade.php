@extends('layout.branch-head')
@section('title')
รายละเอียดข่าวประชาสัมพันธ์
@endsection
@section('navigation')
<li class="breadcrumb-item"><a href="/branch-head/menu_news_login">ข่าวประชาสัมพันธ์</a></li>
@endsection
@section('content')
@livewire('news.detail-news-login', ['id' => $newsId])
<a href="/branch-head/menu_news_login" class="btn btn-primary mb-3">ย้อนกลับ</a>
@endsection
