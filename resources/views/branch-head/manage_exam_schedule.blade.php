@extends('layout.branch-head')
@section('title')
    ตารารางสอบ
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('branch-head.dashboard') }}">Dashboard</a></li>
@endsection
@section('content')
    @livewire('schedule.manage-exam-schedule')
    <a href="{{ route('branch-head.dashboard') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
