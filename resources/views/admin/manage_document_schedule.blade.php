@extends('layout.admin')
@section('title')
    จัดการกำหนดการเอกสาร
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
@endsection
@section('content')
    @livewire('schedule.manage-document-schedule')
    <a href="/admin" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
