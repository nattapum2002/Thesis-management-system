@extends('layout.teacher')
@section('title')
    อนุมัติเอกสาร
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
@endsection
@section('content')
    @livewire('document.teacher-manage-all-submit-document')
    {{-- @livewire('approve-documents-teacher') --}}
    <a href="{{ route('teacher.dashboard') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
