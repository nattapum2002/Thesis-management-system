<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <title>Document PDF</title>
    <style>
        @font-face {
            font-family: 'THSarabun';
            font-style: normal;
            font-weight: normal;
            src: url("{{ asset('fonts/THSarabun.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'THSarabun';
            font-style: normal;
            font-weight: bold;
            src: url("{{ asset('fonts/THSarabun-Bold.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'THSarabun';
            font-style: italic;
            font-weight: normal;
            src: url("{{ asset('fonts/THSarabun-Italic.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'THSarabun';
            font-style: italic;
            font-weight: bold;
            src: url("{{ asset('fonts/THSarabun-BoldItalic.ttf') }}") format("truetype");
        }

        body {
            font-family: 'THSarabun';
        }
    </style>
</head>
{{-- @include('pdf.font', ['font' => 'THSarabunNew']) --}}
{{-- @include('pdf.font') --}}

<body>
    <p>{{ $name.' '.$email }}</p>
    {{-- <img src="{{ asset('Asset/dist/img/avatar.png') }}" alt="Logo"> --}}
    {{-- <img
        src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public\Asset\dist\img\user1-128x128.jpg'))); ?>"
        width="120"> --}}
    <h1>คณะเกษตรศาสตร์และเทคโนโลยี</h1>
    <h2>มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน วิทยาเขตสุรินทร์</h2>
    <p>แบบขออนุมัติชื่อเรื่อง ปัญหาพิเศษ โครงการพิเศษ โครงงานปริญญานิพนธ์ และแผนผังอาจารย์ที่ปรึกษา</p>
    <h3>1. ชื่อเรื่อง</h3>
    <p>(ภาษาไทย)
        ............................................................................................</p>
    <p>(ภาษาอังกฤษ)
        .........................................................................................</p>
    <h3>2. อาจารย์ที่ปรึกษา</h3>
    <p>2.1 ชื่อ ............................................................. นามสกุล
        ............................................... ตำแหน่งทางวิชาการ
        ......................................................</p>
    <p>วุฒิการศึกษาสูงสุด ................................................ สาขา
        ......................................................</p>
    <h3>2. อาจารย์ที่ปรึกษา</h3>
    <p>2.1 ชื่อ ............................................................. นามสกุล
        ............................................... ตำแหน่งทางวิชาการ
        ......................................................</p>
    <p>วุฒิการศึกษาสูงสุด ................................................ สาขา
        ......................................................</p>
    <p>ลงชื่อ ............................................................. นักศึกษา คนที่ 1</p>
    <p>( ............................................................. )</p>
    <p>วันที่ ....... เดือน .................... พ.ศ. ............</p>
    <p>ลงชื่อ ............................................................. นักศึกษา คนที่ 2</p>
    <p>( ............................................................. )</p>
    <p>วันที่ ....... เดือน .................... พ.ศ. ............</p>
    {{-- <div class="container">
        <div class="header">
            <img src="{{ asset('path/to/logo.png') }}" alt="Logo">
            <h1>คณะเกษตรศาสตร์และเทคโนโลยี</h1>
            <h2>มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน วิทยาเขตสุรินทร์</h2>
            <p>แบบขออนุมัติชื่อเรื่อง ปัญหาพิเศษ โครงการพิเศษ โครงงานปริญญานิพนธ์ และแผนผังอาจารย์ที่ปรึกษา</p>
        </div>
        <p>{{ $name.' '.$email }}</p>
        <div class="content">
            <div class="section">
                <h3>1. ชื่อเรื่อง</h3>
                <p>(ภาษาไทย)
                    ............................................................................................</p>
                <p>(ภาษาอังกฤษ)
                    .........................................................................................</p>
            </div>

            <div class="section">
                <h3>2. อาจารย์ที่ปรึกษา</h3>
                <p>2.1 ชื่อ ............................................................. นามสกุล
                    ............................................... ตำแหน่งทางวิชาการ
                    ......................................................</p>
                <p>วุฒิการศึกษาสูงสุด ................................................ สาขา
                    ......................................................</p>
            </div>

            <div class="section">
                <h3>3. อาจารย์ที่ปรึกษาร่วม (ถ้ามี)</h3>
                <p>3.1 ชื่อ ............................................................. นามสกุล
                    ............................................... ตำแหน่งทางวิชาการ
                    ......................................................</p>
                <p>วุฒิการศึกษาสูงสุด ................................................ สาขา
                    ......................................................</p>
                <!-- เพิ่มส่วนนี้ตามต้องการ -->
            </div>

            <div class="signature">
                <div>
                    <p>ลงชื่อ ............................................................. นักศึกษา คนที่ 1</p>
                    <p>( ............................................................. )</p>
                    <p>วันที่ ....... เดือน .................... พ.ศ. ............</p>
                </div>
                <div>
                    <p>ลงชื่อ ............................................................. นักศึกษา คนที่ 2</p>
                    <p>( ............................................................. )</p>
                    <p>วันที่ ....... เดือน .................... พ.ศ. ............</p>
                </div>
            </div>
        </div>
    </div> --}}
</body>

</html>