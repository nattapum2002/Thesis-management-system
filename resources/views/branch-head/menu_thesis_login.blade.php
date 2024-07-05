@extends('layout.branch-head')
@section('title')
บทความปริญญานิพนธ์
@endsection
@section('navigation')
<li class="breadcrumb-item"><a href="/branch-head">Dashboard</a></li>
@endsection
@section('content')
@livewire('thesis.menu-thesis-login')
<a href="/branch-head" class="btn btn-primary mb-3">ย้อนกลับ</a>
@endsection