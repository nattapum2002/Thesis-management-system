@extends('layout.admin')
@section('title')
    เพิ่มบทความปริญญานิพนธ์
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('admin.approve.thesis') }}">จัดการบทความปริญญานิพนธ์</a></li>
@endsection
@section('content')
    @livewire('thesis.add-thesis')
    <a href="{{ route('admin.approve.thesis') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
