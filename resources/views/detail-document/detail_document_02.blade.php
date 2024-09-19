@php
    $layout = match (Auth::guard('teachers')->user()->user_type) {
        'Branch head' => 'layout.branch-head',
        'Admin' => 'layout.admin',
        default => 'layout.default', // Provide a default layout if needed
    };
@endphp

@extends($layout)

@section('title')
    รายละเอียดเอกสาร
@endsection

@section('navigation')
    <li class="breadcrumb-item"><a href="{{ route('admin.approve.documents') }}">อนุมัติเอกสาร</a></li>
@endsection
@section('content')
    <livewire:document-layout.document-head :id_project="$id_project" :id_document="$id_document" />
    @livewire('document-detail.document02', ['id_project' => $id_project, 'id_document' => $id_document])
    
    @if (Auth::guard('teachers')->user()->user_type == 'Branch head')
        <a href="{{ route('branch-head.approve.documents') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
    @elseif(Auth::guard('teachers')->user()->user_type == 'Admin')
        <a href="{{ route('admin.approve.documents') }}" class="btn btn-orange mt-3 mb-3">ย้อนกลับ</a>
    @endif
    
@endsection
