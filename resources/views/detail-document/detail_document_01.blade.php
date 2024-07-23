@extends('layout.admin')
@section('title')
รายละเอียดเอกสาร
@endsection
@section('content')
@livewire('document-detail.document01',['id_project' => $id_project])
@endsection