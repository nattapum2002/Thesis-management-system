@extends('layout.branch-head')
@section('title')
    รายละเอียดโปรเจค
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('branch-head.manage.project') }}">ข่าวประชาสัมพันธ์</a></li>
@endsection
@section('content')
    @livewire('project.detail-project', ['id' => $projectId])
    <a href="{{ route('branch-head.manage.project') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
