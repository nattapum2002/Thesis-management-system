@extends('layout.admin')
@section('title')
    รายละเอียดและแก้ไขบัญชีสมาชิก
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('admin.manage.member') }}">จัดการบัญชีสมาชิก</a></li>
@endsection
@section('content')
    @livewire('account.approve-member', ['id' => $studentId])
    <a href="{{ route('admin.manage.member') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
