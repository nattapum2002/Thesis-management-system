@extends('layout.welcome')
@section('title')
รายละเอียดบทความปริญญานิพนธ์
@endsection
@section('content')
@livewire('thesis.detail-thesis', ['id' => $thesisId])
@endsection