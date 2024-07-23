@extends('layout.admin')
@section('title')
รายละเอียดเอกสาร
@endsection
@section('content')
@livewire('document-detail.document02',['id_project' => $id_project])
@endsection