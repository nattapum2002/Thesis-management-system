@extends('layout.admin')
@section('title')
จัดการบัญชีผู้ดูแลระบบ
@endsection
@section('navigation')
<li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
@endsection
@section('content')
@livewire('account.edit-and-detail-teacher')
<a href="/admin" class="btn btn-primary mb-3">ย้อนกลับ</a>
@endsection