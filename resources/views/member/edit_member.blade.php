@extends('layout.member')
@section('title')
    จัดการบัญชีผู้ใช้
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="/member">Dashboard</a></li>
@endsection
@section('content')
    @livewire('account.edit-and-detail-member')
    <a href="/member" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
