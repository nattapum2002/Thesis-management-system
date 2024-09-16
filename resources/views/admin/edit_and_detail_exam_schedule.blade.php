@extends('layout.admin')
@section('title')
    รายละเอียดและแก้ไขตารางสอบ
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('admin.manage.exam.schedule') }}">ตารางสอบ</a></li>
@endsection
@section('content')
    @livewire('schedule.edit-and-detail-exam-schedule', ['id' => $scheduleId])
    <a href="{{ route('admin.manage.exam.schedule') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
