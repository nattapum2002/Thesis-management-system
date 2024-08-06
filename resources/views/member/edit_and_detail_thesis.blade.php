@extends('layout.member')
@section('title')
    รายละเอียดและแก้ไขบทความ
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="/member/manage_thesis">จัดการบทความปริญญานิพนธ์</a></li>
@endsection
@section('content')
    @livewire('thesis.edit-and-detail-thesis', ['id' => $thesisId])
    <a href="/member/manage_thesis" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
