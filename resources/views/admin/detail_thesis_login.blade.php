@extends('layout.admin')
@section('title')
    รายละเอียดบทความปริญญานิพนธ์
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('admin.menu.thesis') }}">ข่าวประชาสัมพันธ์</a></li>
@endsection
@section('content')
    @livewire('thesis.detail-thesis-login', ['id' => $thesisId])
    <a href="{{ route('admin.menu.thesis') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
