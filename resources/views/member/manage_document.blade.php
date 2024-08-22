@extends('layout.member')
@section('title')
    จัดการเอกสาร
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="/member">Dashboard</a></li>
@endsection
@section('content')
    @livewire('member-manage-document')
    <a href="/member" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
