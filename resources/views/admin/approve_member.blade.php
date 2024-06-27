@extends('layout.admin')
@section('title')
รายละเอียดและแก้ไขบัญชีสมาชิก
@endsection
@section('content')
@livewire('account.approve-member', ['id' => $studentId])
@endsection