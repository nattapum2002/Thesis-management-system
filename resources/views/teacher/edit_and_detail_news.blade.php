@extends('layout.teacher')
@section('title')
    รายละเอียดและแก้ไขข่าว
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('teacher.manage.news') }}">จัดการข่าวประชาสัมพันธ์</a></li>
@endsection
@section('content')
    @livewire('news.edit-and-detail-news', ['id' => $newsId])
    <a href="{{ route('teacher.manage.news') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
