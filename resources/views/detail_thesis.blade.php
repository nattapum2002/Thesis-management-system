@extends('layout.welcome')
@section('title')
รายละบทความปริญญานิพนธ์
@endsection
@section('content')
@livewire('thesis.detail-thesis', ['id' => $thesisId])
@endsection