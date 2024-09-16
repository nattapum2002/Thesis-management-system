@extends('layout.member')
@section('title')
    ตารางการสอบ
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
@endsection
@section('content')
    @livewire('schedule.manage-exam-schedule')
    <a href="{{ route('member.dashboard') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
