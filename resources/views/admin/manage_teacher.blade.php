@extends('layout.admin')
@section('title')
    จัดการบัญชีอาจารย์
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
@endsection
@section('content')
    @livewire('account.manage-teacher')
    <a href="{{ route('admin.dashboard') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
