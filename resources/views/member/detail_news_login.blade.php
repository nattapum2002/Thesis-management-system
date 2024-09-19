@extends('layout.member')
@section('title')
    รายละเอียดข่าวประชาสัมพันธ์
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('member.menu.news') }}">ข่าวประชาสัมพันธ์</a></li>
@endsection
@section('content')
    @livewire('news.detail-news-login', ['id' => $newsId])
    <a href="{{ route('member.menu.news') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
