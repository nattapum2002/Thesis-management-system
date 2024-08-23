@extends('layout.admin')
@section('title')
    อนุมัติเอกสาร
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
@endsection
@section('content')
    {{-- @livewire('DocumentLayout.group-member-detail') --}}
    {{-- @livewire('DocumentLayout.doc01-comment-admin-input') --}}
    @livewire('document.teacher-manage-all-submit-document')
    <a href="/admin" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
