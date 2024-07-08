@extends('layout.teacher')
@section('title')
จัดการบัญชีผู้ใช้
@endsection
@section('navigation')
<li class="breadcrumb-item"><a href="/teacher">Dashboard</a></li>
@endsection
@section('content')
@livewire('account.edit-and-detail-teacher')
<a href="/teacher" class="btn btn-primary mb-3">ย้อนกลับ</a>
@endsection
