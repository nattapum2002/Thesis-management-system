@php
    $layout = match (Auth::guard('teachers')->user()->user_type) {
        'Branch head' => 'layout.branch-head',
        'Admin' => 'layout.admin',
        default => 'layout.default', // Provide a default layout if needed
    };
    $route = match (Auth::guard('teachers')->user()->user_type) {
        'Branch head' => 'branch-head.approve.documents',
        'Admin' => 'admin.approve.documents',
        'Teacher' => 'teacher.approve.documents',
        default => null,
    };
@endphp

@extends($layout)

@section('title')
    รายละเอียดเอกสาร
@endsection

@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route($route) }}">อนุมัติเอกสาร</a></li>
@endsection

@section('content')
    <livewire:document-layout.document-head :id_project="$id_project" :id_document="$id_document" />
    @livewire('document-detail.document04', ['id_project' => $id_project, 'id_document' => $id_document])

    <a href="{{ route($route) }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
@endsection
