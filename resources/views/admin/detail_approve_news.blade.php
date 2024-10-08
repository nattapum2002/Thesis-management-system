@extends('layout.admin')
@section('title')
    รายละเอียดข่าว
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('admin.approve.news') }}">ซ่อน-แสดง ข่าวของผู้ใช้</a></li>
@endsection
@section('content')
    @livewire('news.detail-approve-news', ['id' => $newsId])
    <a href="{{ route('admin.approve.news') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
