@extends('layout.welcome')
@section('title')
รายละเอียดบทความปริญญานิพนธ์
@endsection
@section('content')
@livewire('thesis-detail', ['id' => $thesisId])
@endsection