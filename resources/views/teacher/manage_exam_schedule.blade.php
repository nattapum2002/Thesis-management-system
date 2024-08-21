@extends('layout.teacher')
@section('title')
    กำหนดการสอบ
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="/teacher">Dashboard</a></li>
@endsection
@section('content')
    @livewire('schedule.manage-exam-schedule')
    <a href="/teacher" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
