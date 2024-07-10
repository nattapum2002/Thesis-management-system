<<<<<<< HEAD
<!DOCTYPE html>
<html lang="th">

<head>
    <meta http-equiv="Content-Language" content="th">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>Document PDF</title>
=======
<html>
<header>
    <title>pdf</title>
    <meta http-equiv=”Content-Language” content=”th” />
    <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8" />
>>>>>>> a5a079dc7b66fe79cc001f95a6957c6bf5beb838
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }
<<<<<<< HEAD

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew-Bold.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew-Italic.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew-BoldItalic.ttf') }}") format("truetype");
        }

        @page {
            size: A4;
            margin-top: 20mm;
            margin-bottom: 20mm;
            margin-left: 30mm;
            margin-right: 30mm;
        }

        body {
            font-family: 'THSarabunNew', sans-serif;
            font-size: 15pt;
            line-height: 0.9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            padding: 0px;
        }

        .header {
            text-align: center;
        }

        .header img {
            width: 55px;
            margin-top: -20px;
            margin-bottom: 0px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 18pt;
            margin-top: 20px;
        }

        .section {
            margin-top: 5px;
        }

        .section div {
            margin-top: 5px;
            padding: 0px 0;
        }

        .section p {
            margin-top: 0px;
            padding-top: 0px;
        }

        .section p.indent {
            padding-left: 1.8em
        }

        .signature {
            margin-top: 0px;
            text-align: center;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .signature td {
            padding-top: 0px;
        }

        .signature .text-align-center {
            text-align: center;
        }

        input[type="checkbox"] {
            padding-top: 0px;
        }
    </style>
</head>
{{-- grid --}}
{{--

<body>
    <div style="text-align: right;"">คกท.-คง.-01</div>
    <div class=" container">
        <div class="header">
            <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public\Asset\main\img\logo\RMUTI.png'))); ?>"
                alt="University Logo">
            <div>คณะเกษตรศาสตร์และเทคโนโลยี</div>
            <div>มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน วิทยาเขตสุรินทร์</div>
            <div>แบบขออนุมัติชื่อเรื่อง ปัญหาพิเศษ โครงการพิเศษ โครงงานปริญญานิพนธ์
                และแต่งตั้งอาจารย์ที่ปรึกษา</div>
        </div>
        <div class="section row">
            <p class="col">ชื่อนักศึกษา</p>
            <div class="col">
                <p>คนที่ 1 (นาย/นาง/นางสาว).................................</p>
                <p>คนที่ 2 (นาย/นาง/นางสาว).................................</p>
            </div>
            <div class="col">
                <p>รหัส ........................</p>
                <p>รหัส ........................</p>
            </div>
        </div>
        <div class="section row">
            <p>1. ชื่อเรื่อง</p>
            <div class="col">
                <p>(ภาษาไทย)</p>
                <p>(ภาษาอังกฤษ)</p>
            </div>
            <div class="col">
                <p>...............................</p>
                <p>...............................</p>
            </div>
        </div>
        <div class="section">
            <p>2. อาจารย์ที่ปรึกษา</p>
            <p>2.1 ชื่อ ............................... นามสกุล ............................ ตำแหน่งทางวิชาการ
                ............................</p>
            <p>วุฒิการศึกษา ........................ สาขา ............................</p>
        </div>
        <div class="section">
            <p>3. อาจารย์ที่ปรึกษาร่วม (ถ้ามี)</p>
            <p>3.1 ชื่อ ............................... นามสกุล ............................ ตำแหน่งทางวิชาการ
                ............................</p>
            <p>วุฒิการศึกษา ........................ สาขา ............................</p>
        </div>
        <div class="signature row">
            <div class="col">
                ลงชื่อ .......................... นักศึกษา คนที่ 1
                <br>( ......................................... )
                <br>วันที่ ....... เดือน ............... พ.ศ. ............
            </div>
            <div class="col">
                ลงชื่อ .......................... นักศึกษา คนที่ 2
                <br>( ......................................... )
                <br>วันที่ ....... เดือน ............... พ.ศ. ............
            </div>
        </div>
    </div>
</body> --}}

{{-- no grid --}}

<body>
    <div style="text-align: right;"">คกท.-คง.-01</div>
    <div class=" container">
        <div class="header">
            <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public\Asset\main\img\logo\RMUTI.png'))); ?>"
                alt="University Logo">
            <div>คณะเกษตรศาสตร์และเทคโนโลยี</div>
            <div>มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน วิทยาเขตสุรินทร์</div>
            <div>แบบขออนุมัติชื่อเรื่อง ปัญหาพิเศษ โครงการพิเศษ โครงงานปริญญานิพนธ์
                และแต่งตั้งอาจารย์ที่ปรึกษา</div>
            <div>-----------------------------------</div>
        </div>
        {{-- <div class="section">
            <p>ชื่อนักศึกษา</p>
            <div>
                <p>
                    คนที่ 1 ................................. รหัส ........................
                    <br> หลักสูตร ................................. สาขาวิชา ..............................
                    <br> ระดับ ............................ ภาค ปกติ
                </p>
            </div>
            <div>
                <p>
                    คนที่ 1 ................................. รหัส ........................
                    <br> หลักสูตร ................................. สาขาวิชา ..............................
                    <br> ระดับ ............................ ภาค ปกติ
                </p>
            </div>
            <div>
                <p>
                    คนที่ 1 ................................. รหัส ........................
                    <br> หลักสูตร ................................. สาขาวิชา ..............................
                    <br> ระดับ ............................ ภาค ปกติ
                </p>
            </div>
            <div>
                <p>
                    คนที่ 1 ................................. รหัส ........................
                    <br> หลักสูตร ................................. สาขาวิชา ..............................
                    <br> ระดับ ............................ ภาค ปกติ
                </p>
            </div>
            <div>
                <p>
                    คนที่ 1 ................................. รหัส ........................
                    <br> หลักสูตร ................................. สาขาวิชา ..............................
                    <br> ระดับ ............................ ภาค ปกติ
                </p>
            </div>
        </div> --}}
        <div class="section">
            <p>ชื่อนักศึกษา</p>
            <div>
                คนที่ 1 ................................. รหัส ........................
            </div>
            <div>
                คนที่ 1 ................................. รหัส ........................
            </div>
            <div>
                คนที่ 1 ................................. รหัส ........................
            </div>
            <div>
                คนที่ 1 ................................. รหัส ........................
            </div>
            <div>
                คนที่ 1 ................................. รหัส ........................
            </div>
            <div>
                หลักสูตร ................................. สาขาวิชา เทคโนโลยีคอมพิวเตอร์
                <br> ระดับ ............................ ภาค ปกติ
            </div>
        </div>
        <div class="section">
            <p>1. ชื่อเรื่อง</p>
            <div>
                (ภาษาไทย) ...............................
                <br>(ภาษาอังกฤษ) ...............................
            </div>
        </div>
        <div class="section">
            <p>2. อาจารย์ที่ปรึกษา</p>
            2.1 ชื่อ ............................... นามสกุล ............................ ตำแหน่งทางวิชาการ
            ............................
            <br>วุฒิการศึกษา ........................ สาขา ............................
        </div>
        <div class="section">
            <p>3. อาจารย์ที่ปรึกษาร่วม (ถ้ามี)</p>
            3.1 ชื่อ ............................... นามสกุล ............................ ตำแหน่งทางวิชาการ
            ............................
            <br>วุฒิการศึกษา ........................ สาขา ............................<br>
            3.1 ชื่อ ............................... นามสกุล ............................ ตำแหน่งทางวิชาการ
            ............................
            <br>วุฒิการศึกษา ........................ สาขา ............................<br>
            3.1 ชื่อ ............................... นามสกุล ............................ ตำแหน่งทางวิชาการ
            ............................
            <br>วุฒิการศึกษา ........................ สาขา ............................<br>
        </div>
        <div class="section">
            <table class="signature table">
                <tr>
                    <td class="text-align-center">
                        ลงชื่อ .......................... นักศึกษา คนที่ 1
                        <br>( ......................................... )
                        <br>วันที่ ....... เดือน ............... พ.ศ. ............
                    </td>
                    <td class="text-align-center">
                        ลงชื่อ .......................... นักศึกษา คนที่ 2
                        <br>( ......................................... )
                        <br>วันที่ ....... เดือน ............... พ.ศ. ............
                    </td>
                </tr>
                <tr>
                    <td class="text-align-center">
                        ลงชื่อ .......................... นักศึกษา คนที่ 3
                        <br>( ......................................... )
                        <br>วันที่ ....... เดือน ............... พ.ศ. ............
                    </td>
                    <td class="text-align-center">
                        ลงชื่อ .......................... นักศึกษา คนที่ 4
                        <br>( ......................................... )
                        <br>วันที่ ....... เดือน ............... พ.ศ. ............
                    </td>
                </tr>
                <tr>
                    <td class="text-align-center">
                        ลงชื่อ .......................... นักศึกษา คนที่ 5
                        <br>( ......................................... )
                        <br>วันที่ ....... เดือน ............... พ.ศ. ............
                    </td>
                </tr>
            </table>
        </div>
        <div class="section">
            <p>4. ผู้รับเสนอ</p>
            <table class="signature table">
                <tr>
                    <td class="text-align-center">
                        ลงชื่อ .......................... อาจารย์ที่ปรึกษา
                        <br>( ......................................... )
                        <br>วันที่ ....... เดือน ............... พ.ศ. ............
                    </td>
                    <td class="text-align-center">
                        ลงชื่อ .......................... อาจารย์ที่ปรึกษาร่วม
                        <br>( ......................................... )
                        <br>วันที่ ....... เดือน ............... พ.ศ. ............
                    </td>
                </tr>
                <tr>
                    <td class="text-align-center">
                        ลงชื่อ .......................... อาจารย์ที่ปรึกษาร่วม
                        <br>( ......................................... )
                        <br>วันที่ ....... เดือน ............... พ.ศ. ............
                    </td>
                    <td class="text-align-center">
                        ลงชื่อ .......................... อาจารย์ที่ปรึกษาร่วม
                        <br>( ......................................... )
                        <br>วันที่ ....... เดือน ............... พ.ศ. ............
                    </td>
                </tr>
            </table>
        </div>
        <div class="section">
            <p>5. ความเห็นของอาจารย์ผู้รับผิดชอบรายวิชา</p>
            <table class="table">
                <tr>
                    <td>
                        <div>
                            <input type="checkbox">
                            <label> อนุมัติชื่อเรื่อง</label>
                        </div>
                        <div>
                            <input type="checkbox">
                            <label> ไม่อนุมัติ เนื่องจาก</label>
                        </div>
                    </td>
                    <td style="">
                        <div>
                            <input type="checkbox">
                            <label> อนุมัติอาจารย์ที่ปรึกษา</label>
                        </div>
                        <div>
                            <input type="checkbox">
                            <label> มีคุณวุฒิทางการศึกษาไม่เป็นไปตามเกณฑ์</label>
                        </div>
                        <div>
                            <input type="checkbox">
                            <label> มีจำนวนนักศึกษาที่รับผิดชอบเกินเกณฑ์ที่กำหนดไว้</label>
                        </div>
                        <div>
                            <input type="checkbox">
                            <label> อื่นๆ ...........</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center" colspan="2">
                        ลงชื่อ .......................... อาจารย์ผู้รับผิดชอบรายวิชา
                        <br>( ......................................... )
                        <br>วันที่ ....... เดือน ............... พ.ศ. ............
                    </td>
                </tr>
            </table>
        </div>
        <div class="section">
            <p>6. ความเห็นหัวหน้าสาขาวิชา</p>
            <table class="table">
                <tr>
                    <td>
                        <div>
                            <input type="checkbox">
                            <label> อนุมัติ</label>
                        </div>
                        <div>
                            <input type="checkbox">
                            <label> ไม่อนุมัติ เนื่องจาก.............................</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center">
                        ลงชื่อ .......................... หัวหน้าสาขาวิชา
                        <br>( ......................................... )
                        <br>วันที่ ....... เดือน ............... พ.ศ. ............
                    </td>
                </tr>
            </table>
        </div>

    </div>
=======
        body {
            font-family: "THSarabunNew";
            font-size: 20px;
        }
    </style>
</header>

<body>
    <p>สวัสดี</p> ผม สร้างจาก domPs
>>>>>>> a5a079dc7b66fe79cc001f95a6957c6bf5beb838
</body>

</html>
