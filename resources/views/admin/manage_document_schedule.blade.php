@extends('layout.admin')
@section('title')
    จัดการกำหนดการเอกสาร
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
@endsection
@section('content')
    @livewire('schedule.manage-document-schedule')
    <a href="{{ route('admin.dashboard') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
