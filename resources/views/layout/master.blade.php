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

<body class="sidebar-mini hold-transition layout-navbar-fixed layout-fixed">
    <div class="wrapper">
        {{-- Main Sidebar --}}
        <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand">
            @yield('mastersidebar')
        </aside>

        {{-- Navber --}}
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            @yield('masternavbar')
        </nav>

        {{-- Content --}}
        <div class="content-wrapper">
            @yield('mastercontent')
        </div>

        {{-- Footer --}}
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                @yield('masterfooter')
            </div>
        </footer>
    </div>

    {{-- Script --}}
    @yield('masterscript')
    @include('layout.script')
</body>

</html>
