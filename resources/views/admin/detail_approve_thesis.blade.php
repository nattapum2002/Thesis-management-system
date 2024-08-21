@extends('layout.admin')
@section('title')
    รายละเอียดบทความ
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="/admin/approve_thesis">ซ่อน-แสดง บทความของผู้ใช้</a></li>
@endsection
@section('content')
    @livewire('thesis.detail-approve-thesis', ['id' => $thesisId])
    <a href="/admin/approve_thesis" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
