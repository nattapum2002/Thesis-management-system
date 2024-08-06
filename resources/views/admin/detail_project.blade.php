@extends('layout.admin')
@section('title')
    รายละเอียดโปรเจค
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="/admin/manage_project">จัดการโปรเจค</a></li>
@endsection
@section('content')
    @livewire('project.detail-project', ['id' => $projectId])
    <a href="/admin/manage_project" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
