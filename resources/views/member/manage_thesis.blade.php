@extends('layout.member')
@section('title')
จัดการบทความปริญญานิพนธ์
@endsection
@section('navigation')
<li class="breadcrumb-item"><a href="/member">Dashboard</a></li>
@endsection
@section('content')
@livewire('thesis.manage-thesis')
<a href="/member" class="btn btn-primary mb-3">ย้อนกลับ</a>
@endsection