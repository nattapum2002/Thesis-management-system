@extends('layout.teacher')
@section('title')
จัดการข่าวประชาสัมพันธ์
@endsection
@section('navigation')
<li class="breadcrumb-item"><a href="/teacher">Dashboard</a></li>
@endsection
@section('content')
@livewire('news.manage-news')
<a href="/teacher" class="btn btn-primary mb-3">ย้อนกลับ</a>
@endsection
