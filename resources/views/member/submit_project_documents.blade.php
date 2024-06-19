@extends('layout.member')
@section('title')
สมาชิก
@endsection
@section('content')
@livewire('DocumentLayout.doc01-topic-input')
@livewire('DocumentLayout.doc01-advisers-input')
{{-- @livewire('DocumentLayout.group-member-detail') --}}
{{-- @livewire('submit-project-documents') --}}
@endsection
