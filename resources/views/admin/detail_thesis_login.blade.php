@extends('layout.admin')
@section('title')
รายละเอียดบทความปริญญานิพนธ์
@endsection
@section('navigation')
<li class="breadcrumb-item"><a href="/admin/menu_thesis_login">ข่าวประชาสัมพันธ์</a></li>
@endsection
@section('content')
@livewire('thesis.detail-thesis-login', ['id' => $thesisId])
<a href="/admin/menu_thesis_login" class="btn btn-primary mb-3">ย้อนกลับ</a>
@endsection