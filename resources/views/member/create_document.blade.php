@extends('layout.member')
@section('title')
    ขออนุมัติชื่อเรื่องและแต่งตั้งที่ปรึกษา
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="/member/manage_document">จัดการเอกสาร</a></li>
@endsection
@section('content')
    @livewire('document.create-document')
    <a href="/member/manage_document" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
