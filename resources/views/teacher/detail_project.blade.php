@extends('layout.teacher')
@section('title')
    รายละเอียดโปรเจค
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('teacher.manage.project') }}">จัดการข่าวประชาสัมพันธ์</a></li>
@endsection
@section('content')
    @livewire('project.detail-project', ['id' => $projectId])
    <a href="{{ route('teacher.manage.project') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
