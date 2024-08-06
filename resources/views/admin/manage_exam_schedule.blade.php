@extends('layout.admin')
@section('title')
    กำหนดกรรมการและเวลาสอบ
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
@endsection
@section('content')
    @livewire('schedule.manage-exam-schedule')
    <a href="/admin" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
