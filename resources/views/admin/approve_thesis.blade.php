@extends('layout.admin')
@section('title')
ซ่อน-แสดง บทความ
@endsection
@section('navigation')
<li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
@endsection
@section('content')
@livewire('thesis.approve-thesis')
<a href="/admin" class="btn btn-primary mb-3">ย้อนกลับ</a>
@endsection