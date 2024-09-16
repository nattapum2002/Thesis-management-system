@extends('layout.member')
@section('title')
    รายละเอียดกำหนดการเอกสาร
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('member.manage.document.schedule') }}">ตารางการส่งเอกสาร</a></li>
@endsection
@section('content')
    @livewire('schedule.edit-and-detail-document-schedule', ['id' => $scheduleId])
    <a href="{{ route('member.manage.document.schedule') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
