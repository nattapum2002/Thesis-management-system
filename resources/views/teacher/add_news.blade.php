@extends('layout.teacher')
@section('title')
    เพิ่มข่าว
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('teacher.manage.news') }}">จัดการข่าวประชาสัมพันธ์</a></li>
@endsection
@section('content')
    @livewire('news.add-news')
    <a href="{{ route('teacher.manage.news') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
