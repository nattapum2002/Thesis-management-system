@extends('layout.admin')
@section('title')
จัดการข่าวประชาสัมพันธ์
@endsection
@section('navigation')
<li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
@endsection
@section('content')
@livewire('news.manage-news')
<a href="/admin" class="btn btn-primary mb-3">ย้อนกลับ</a>
@endsection
