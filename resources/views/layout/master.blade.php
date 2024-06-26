<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $lang ?? app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ระบบจัดการปริญานิพนธ์ | @yield('mastertitle')</title>
</head>
{{-- Css --}}
@yield('mastercss')
@include('layout.css')

<body>
    <div class="row">
        <div class="col-sm-2">
            {{-- Main Sidebar --}}
            <div>
                @yield('mastersidebar')
            </div>
        </div>
        <div class="col-sm-8">
            {{-- Navber --}}
            <nav>
                @yield('masternavbar')
            </nav>
            {{-- Content --}}
            <div class="content-wrapper">
                @yield('mastercontent')
            </div>

            {{-- Footer --}}
            <div>
                @yield('masterfooter')
            </div>
        </div>
    </div>
    {{-- Script --}}
    @yield('masterscript')
    @include('layout.script')
</body>

</html>
