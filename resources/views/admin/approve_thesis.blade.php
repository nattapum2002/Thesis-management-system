@extends('layout.admin')
@section('title')
    ซ่อน-แสดง บทความของผู้ใช้
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
@endsection
@section('content')
    @livewire('thesis.approve-thesis')
    <a href="{{ route('admin.dashboard') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
