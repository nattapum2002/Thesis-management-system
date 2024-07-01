@extends('layout.admin')
@section('title')
อนุมัติเอกสาร
@endsection
@section('content')
{{-- @livewire('DocumentLayout.group-member-detail') --}}
{{-- @livewire('DocumentLayout.doc01-comment-admin-input') --}}
@livewire('document.teacher-manage-all-submit-document')
@endsection