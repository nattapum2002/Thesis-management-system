@extends('layout.admin')
@section('title')
รายละเอียดเอกสาร
@endsection
@section('content')
<livewire:document-layout.document-head :id_project="$id_project" :id_document="$id_document" />
@livewire('document-detail.document03',['id_project' => $id_project ,'id_document' => $id_document])

@endsection