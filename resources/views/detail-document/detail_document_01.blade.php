@extends('layout.admin')
@section('title')
    รายละเอียดเอกสาร
@endsection
@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('admin.approve.documents') }}">อนุมัติเอกสาร</a></li>
@endsection
@section('content')
    <livewire:document-layout.document-head :id_project="$id_project" :id_document="$id_document" />
    @livewire('document-detail.document01', ['id_project' => $id_project, 'id_document' => $id_document])
    <a href="{{ route('admin.approve.documents') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
