@extends('layout.admin')
@section('title')
จัดการบัญชีสมาชิก
@endsection
@section('navigation')
<li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
@endsection
@section('content')
@livewire('account.manage-member')
<a href="/admin" class="btn btn-primary mb-3">ย้อนกลับ</a>
@endsection