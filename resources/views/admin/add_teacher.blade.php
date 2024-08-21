@extends('layout.admin')
@section('title')
    เพิ่มบัญชีอาจารย์
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="/admin/manage_teacher">จัดการบัญชีอาจารย์</a></li>
@endsection
@section('content')
    @livewire('account.add-teacher')
    <a href="/admin/manage_teacher" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
