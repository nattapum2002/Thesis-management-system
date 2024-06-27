@extends('layout.admin')
@section('title')
รายละเอียดและแก้ไขบัญชีอาจารย์
@endsection
@section('content')
@livewire('account.approve-teacher', ['id' => $teacherId])
@endsection