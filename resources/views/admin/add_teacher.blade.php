@extends('layout.admin')
@section('title')
    เพิ่มบัญชีอาจารย์
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('admin.manage.teacher') }}">จัดการบัญชีอาจารย์</a></li>
@endsection
@section('content')
    @livewire('account.add-teacher')
    <a href="{{ route('admin.manage.teacher') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
