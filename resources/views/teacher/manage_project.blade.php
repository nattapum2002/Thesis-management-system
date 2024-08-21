@extends('layout.teacher')
@section('title')
    จัดการโปรเจค
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="/teacher">Dashboard</a></li>
@endsection
@section('content')
    @livewire('project.manage-project')
    <a href="/teacher" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
