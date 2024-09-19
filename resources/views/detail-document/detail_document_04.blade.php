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
@section('content')
<livewire:document-layout.document-head :id_project="$id_project" :id_document="$id_document" />
@livewire('document-detail.document04',['id_project' => $id_project ,'id_document' => $id_document])

@endsection