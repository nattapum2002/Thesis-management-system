@extends('layout.branch-head')
@section('title')
    จัดการโปรเจค
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="/branch-head">Dashboard</a></li>
@endsection
@section('content')
    @livewire('project.manage-project')
    <a href="/branch-head" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
