@extends('layout.teacher')
@section('title')
    ตารางการส่งเอกสาร
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
@endsection
@section('content')
    @livewire('schedule.manage-document-schedule')
    <a href="{{ route('teacher.dashboard') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
