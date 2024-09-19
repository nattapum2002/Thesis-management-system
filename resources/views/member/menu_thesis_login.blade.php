@extends('layout.member')
@section('title')
    บทความปริญญานิพนธ์
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
@endsection
@section('content')
    @livewire('thesis.menu-thesis-login')
    <a href="{{ route('member.dashboard') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
