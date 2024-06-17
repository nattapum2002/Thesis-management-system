@extends('layout.welcome')
@section('title')
รายละเอียดข่าวประชาสัมพันธ์
@endsection
@section('content')
@livewire('news-detail', ['id' => $newsId])
@endsection