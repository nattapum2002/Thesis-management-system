@extends('layout.branch-head')
@section('title')
    จัดการข่าวประชาสัมพันธ์
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('branch-head.dashboard') }}">Dashboard</a></li>
@endsection
@section('content')
    @livewire('news.manage-news')
    <a href="{{ route('branch-head.dashboard') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
