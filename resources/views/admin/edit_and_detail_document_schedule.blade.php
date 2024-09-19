@extends('layout.admin')
@section('title')
    รายละเอียดและแก้ไขกำหนดการเอกสาร
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('admin.manage.document.schedule') }}">จัดการกำหนดการเอกสาร</a></li>
@endsection
@section('content')
    @livewire('schedule.edit-and-detail-document-schedule', ['id' => $scheduleId])
    <a href="{{ route('admin.manage.document.schedule') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
