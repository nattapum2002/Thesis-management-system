@extends('layout.member')
@section('title')
    จัดการบทความปริญญานิพนธ์
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
@endsection
@section('content')
    @livewire('thesis.manage-thesis')
    <a href="{{ route('member.dashboard') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
