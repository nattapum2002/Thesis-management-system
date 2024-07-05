@extends('layout.member')
@section('title')
บทความปริญญานิพนธ์
@endsection
@section('navigation')
<li class="breadcrumb-item"><a href="/member">Dashboard</a></li>
@endsection
@section('content')
@livewire('thesis.menu-thesis-login')
<a href="/member" class="btn btn-primary mb-3">ย้อนกลับ</a>
@endsection