@extends('layout.admin')
@section('title')
    เพิ่มกำหนดการเอกสาร
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('admin.manage.document.schedule') }}">จัดการกำหนดการเอกสาร</a></li>
@endsection
@section('content')
    @livewire('schedule.add-document-schedule')
    <a href="{{ route('admin.manage.document.schedule') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
