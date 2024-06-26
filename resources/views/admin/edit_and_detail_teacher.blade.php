@extends('layout.admin')
@section('title')
อาจารย์ประจำวิชา
@endsection
@section('content')
@livewire('admin.edit-and-detail-teacher', ['id' => $teacherId])
@endsection
