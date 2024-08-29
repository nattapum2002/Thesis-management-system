@extends('layout.member')
@section('title')
    สร้างเอกสาร 04
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('member.manage.document') }}">จัดการเอกสาร</a></li>
@endsection
@section('content')
    @livewire('document.create-document-04')
    <a href="{{ route('member.manage.document') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endSection
