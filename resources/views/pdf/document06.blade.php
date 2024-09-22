<!DOCTYPE html>
<html lang="th">

<head>
    <meta http-equiv="Content-Language" content="th">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document PDF</title>
    @include('pdf.css')
</head>

<body>
    <header>
        <div class="documentId">คกท.-คง.-06</div>
        {{-- <img class="documentLogo" src="data:image/png;base64,{{ base64_encode(file_get_contents('/home/vol4_2/infinityfree.com/if0_37229336/htdocs/Asset/main/img/logo/RMUTI.png')) }}" alt="University Logo"> --}}
        <img class="documentLogo" src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public\Asset\main\img\logo\RMUTI.png'))); ?>" alt="University Logo">
        <div class="documentHead">
            คณะเกษตรศาสตร์และเทคโนโลยี
            <br>มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน วิทยาเขตสุรินทร์
            <br>แบบรายงานผลการสอบสิ้นสุดโครงงาน
            <br>-----------------------------------
        </div>
    </header>
    {{-- ชื่อนักศึกษา --}}
    <div class="section">
        @if ($projects->members->isNotEmpty())
            <table>
                @foreach ($projects->members as $index => $member)
                    <tr>
                        @if ($loop->first)
                            <td style="width: 3.6em">
                                <div>ชื่อนักศึกษา</div>
                            </td>
                        @else
                            <td></td>
                        @endif
                        <td>
                            <div>
                                คนที่ {{ $loop->iteration }}<span class="dotted">
                                    {{ $member->prefix . ' ' . $member->name . ' ' . $member->surname }}
                                </span>รหัส<span class="dotted"> {{ $member->id_student }} </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        @if (
                            $loop->last ||
                                $member->id_level != $projects->members[$index + 1]->id_level ||
                                $member->id_course != $projects->members[$index + 1]->id_course)
                            <td></td>
                            <td>
                                <div>
                                    หลักสูตร<span class="dotted"> {{ $member->course->course }} </span>สาขาวิชา<span
                                        class="dotted">
                                        เทคโนโลยีคอมพิวเตอร์
                                </div>
                                <div>
                                    ระดับ
                                    <input type="checkbox" {{ $member->level->id_level == 1 ? 'checked' : '' }}>
                                    <label>ประกาศนียบัตรวิชาชีพขั้นสูง</label>

                                    <input type="checkbox" {{ $member->level->id_level != 1 ? 'checked' : '' }}>
                                    <label>ปริญญาตรี
                                        @if ($member->level->id_level == 2)
                                            <span class="dotted"> 4 </span>ปี
                                        @elseif ($member->level->id_level == 3)
                                            <span class="dotted"> 2 - 3 </span>ปี
                                        @else
                                            ..... ปี
                                        @endif
                                    </label>
                                    ภาค<span class="dotted"> ปกติ </span>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>
        @else
            <table>
                <tr>
                    <td>
                        <div>ชื่อนักศึกษา</div>
                    </td>
                    <td>
                        <div>
                            คนที่ 1 ............................................................................ รหัส
                            ......................................
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <div>
                            คนที่ 2 ............................................................................ รหัส
                            ......................................
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div>
                            เป็นนักศึกษา หลักสูตร ...................................... สาขาวิชา <span class="dotted">
                                เทคโนโลยีคอมพิวเตอร์ </span>
                        </div>
                        <div>
                            ระดับ <input type="checkbox"><label> ประกาศนียบัตรวิชาชีพขั้นสูง</label> <input
                                type="checkbox"><label>
                                ปริญญาตรี .......... ปี</label> ภาค<span class="dotted"> ปกติ </span>
                        </div>
                    </td>
                </tr>
            </table>
        @endif
    </div>
    {{-- 1.ชื่อเรื่อง --}}
    <div class="section">
        <table>
            <tr>
                <td colspan="3">
                    <div>1. ชื่อเรื่อง</div>
                </td>
            </tr>
            <tr>
                <td style="width: 1.8em"></td>
                <td style="width: 4em">
                    <div>
                        (ภาษาไทย)
                    </div>
                </td>
                <td>
                    <div>
                        <span class="dotted"> {{ $projects->project_name_th }}
                        </span>
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div>
                        (ภาษาอังกฤษ)
                    </div>
                </td>
                <td>
                    <div>
                        <span class="dotted"> {{ $projects->project_name_en }}
                        </span>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    {{-- 2.ผลการสอบสิ้นสุดโครงงาน --}}
    <div class="section">
        <div>2. ผลการสอบสิ้นสุดโครงงาน</div>
        <table class="solid">
            @if ($scores->isNotEmpty())
                <tr>
                    <td>
                        <div>หัวข้อพิจารณา</div>
                    </td>
                    <td>
                        <div>คะแนน</div>
                    </td>
                    @foreach ($projects->members as $member)
                        <td>
                            <div>คนที่ {{ $loop->iteration }}</div>
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td>
                        <div style="text-align: left;">1. บุคลิก ท่าทาง การวางตัวและความเชื่อมั่นในตนเอง</div>
                    </td>
                    <td>
                        <div>5</div>
                    </td>
                    @foreach ($projects->members as $member)
                        @foreach ($scores->where('id_student', $member->id_student)->where('id_comment_list', 20) as $score)
                            <td>
                                <div>{{ $score->score != null ? $score->score : 0 }}</div>
                            </td>
                        @endforeach
                    @endforeach
                </tr>
                <tr>
                    <td>
                        <div style="text-align: left;">2. การนำเสนอผลงาน</div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                    @foreach ($projects->members as $member)
                        <td>
                            <div> </div>
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td>
                        <div style="padding-left: 1.8em; text-align: left;">2.1 ไฟล์นำเสนอมีความสมบูรณ์</div>
                    </td>
                    <td>
                        <div>10</div>
                    </td>
                    @foreach ($projects->members as $member)
                        @foreach ($scores->where('id_student', $member->id_student)->where('id_comment_list', 21) as $score)
                            <td>
                                <div>{{ $score->score != null ? $score->score : 0 }}</div>
                            </td>
                        @endforeach
                    @endforeach
                </tr>
                <tr>
                    <td>
                        <div style="padding-left: 1.8em; text-align: left;">
                            2.2 สัดส่วนของเนื้อหาที่นำเสนอ
                            <br>(ควรเน้นผลการทดลองและการอภิปรายผล)
                        </div>
                    </td>
                    <td>
                        <div>5</div>
                    </td>
                    @foreach ($projects->members as $member)
                        @foreach ($scores->where('id_student', $member->id_student)->where('id_comment_list', 22) as $score)
                            <td>
                                <div>{{ $score->score != null ? $score->score : 0 }}</div>
                            </td>
                        @endforeach
                    @endforeach
                </tr>
                <tr>
                    <td>
                        <div style="padding-left: 1.8em; text-align: left;">2.3 ทักษะการใช้ภาษาเพื่อการสื่อสาร</div>
                    </td>
                    <td>
                        <div>5</div>
                    </td>
                    @foreach ($projects->members as $member)
                        @foreach ($scores->where('id_student', $member->id_student)->where('id_comment_list', 23) as $score)
                            <td>
                                <div>{{ $score->score != null ? $score->score : 0 }}</div>
                            </td>
                        @endforeach
                    @endforeach
                </tr>
                <tr>
                    <td>
                        <div style="text-align: left;">3. การตอบคำถาม ความรู้ ความเข้าใจในโครงงาน</div>
                    </td>
                    <td>
                        <div>20</div>
                    </td>
                    @foreach ($projects->members as $member)
                        @foreach ($scores->where('id_student', $member->id_student)->where('id_comment_list', 24) as $score)
                            <td>
                                <div>{{ $score->score != null ? $score->score : 0 }}</div>
                            </td>
                        @endforeach
                    @endforeach
                </tr>
                <tr>
                    <td>
                        <div style="text-align: left;">4. ความสมบูณ์ของเอกสารโครงงานฉบับร่าง</div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                    @foreach ($projects->members as $member)
                        <td>
                            <div> </div>
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td>
                        <div style="padding-left: 1.8em; text-align: left;">4.1 รูปแบบถูกต้องตามคู่มือจัดทำโครงงาน</div>
                    </td>
                    <td>
                        <div>10</div>
                    </td>
                    @foreach ($projects->members as $member)
                        @foreach ($scores->where('id_student', $member->id_student)->where('id_comment_list', 25) as $score)
                            <td>
                                <div>{{ $score->score != null ? $score->score : 0 }}</div>
                            </td>
                        @endforeach
                    @endforeach
                </tr>
                <tr>
                    <td>
                        <div style="padding-left: 1.8em; text-align: left;">4.2 เนื้อหาครบถ้วน</div>
                    </td>
                    <td>
                        <div>10</div>
                    </td>
                    @foreach ($projects->members as $member)
                        @foreach ($scores->where('id_student', $member->id_student)->where('id_comment_list', 26) as $score)
                            <td>
                                <div>{{ $score->score != null ? $score->score : 0 }}</div>
                            </td>
                        @endforeach
                    @endforeach
                </tr>
                <tr>
                    <td>
                        <div style="text-align: left;">5. ความสำเร็จของโครงงานตาม</div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                    @foreach ($projects->members as $member)
                        <td>
                            <div> </div>
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td>
                        <div style="padding-left: 1.8em; text-align: left;">5.1 วัตถุประสงค์ของโครงงาน</div>
                    </td>
                    <td>
                        <div>20</div>
                    </td>
                    @foreach ($projects->members as $member)
                        @foreach ($scores->where('id_student', $member->id_student)->where('id_comment_list', 27) as $score)
                            <td>
                                <div>{{ $score->score != null ? $score->score : 0 }}</div>
                            </td>
                        @endforeach
                    @endforeach
                </tr>
                <tr>
                    <td>
                        <div style="padding-left: 1.8em; text-align: left;">5.2 ขอบเขตของโครงงาน</div>
                    </td>
                    <td>
                        <div>15</div>
                    </td>
                    @foreach ($projects->members as $member)
                        @foreach ($scores->where('id_student', $member->id_student)->where('id_comment_list', 28) as $score)
                            <td>
                                <div>{{ $score->score != null ? $score->score : 0 }}</div>
                            </td>
                        @endforeach
                    @endforeach
                </tr>
                <tr>
                    <td>
                        <div>รวม</div>
                    </td>
                    <td>
                        <div>100</div>
                    </td>
                    @foreach ($projects->members as $member)
                        @php
                            $sum = 0; // Initialize sum for each member
                        @endphp
                        @foreach ($scores->where('id_student', $member->id_student) as $score)
                            @php
                                $sum += $score->score;
                            @endphp
                        @endforeach
                        <td>
                            <div>{{ $sum != 0 ? $sum : ' ' }}</div>
                        </td>
                    @endforeach

                </tr>
            @else
                <tr>
                    <td>
                        <div>หัวข้อพิจารณา</div>
                    </td>
                    <td>
                        <div>คะแนน</div>
                    </td>
                    <td>
                        <div>คนที่ 1</div>
                    </td>
                    <td>
                        <div>คนที่ 2</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="text-align: left;">1. บุคลิก ท่าทาง การวางตัวและความเชื่อมั่นในตนเอง</div>
                    </td>
                    <td>
                        <div>5</div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="text-align: left;">2. การนำเสนอผลงาน</div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="padding-left: 1.8em; text-align: left;">2.1 ไฟล์นำเสนอมีความสมบูรณ์</div>
                    </td>
                    <td>
                        <div>5</div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="padding-left: 1.8em; text-align: left;">
                            2.2 สัดส่วนของเนื้อหาที่นำเสนอ
                            <br>(ควรเน้นผลการทดลองและการอภิปรายผล)
                        </div>
                    </td>
                    <td>
                        <div>10</div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="padding-left: 1.8em; text-align: left;">2.3 ทักษะการใช้ภาษาเพื่อการสื่อสาร</div>
                    </td>
                    <td>
                        <div>5</div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="text-align: left;">3. การตอบคำถาม ความรู้ ความเข้าใจในโครงงาน</div>
                    </td>
                    <td>
                        <div>20</div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="text-align: left;">4. ความสมบูณ์ของเอกสารโครงงานฉบับร่าง</div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="padding-left: 1.8em; text-align: left;">4.1 รูปแบบถูกต้องตามคู่มือจัดทำโครงงาน</div>
                    </td>
                    <td>
                        <div>10</div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="padding-left: 1.8em; text-align: left;">4.2 เนื้อหาครบถ้วน</div>
                    </td>
                    <td>
                        <div>10</div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="text-align: left;">5. ความสำเร็จของโครงงานตาม</div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="padding-left: 1.8em; text-align: left;">5.1 วัตถุประสงค์ของโครงงาน</div>
                    </td>
                    <td>
                        <div>20</div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="padding-left: 1.8em; text-align: left;">5.2 ขอบเขตของโครงงาน</div>
                    </td>
                    <td>
                        <div>15</div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>รวม</div>
                    </td>
                    <td>
                        <div>100</div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                    <td>
                        <div> </div>
                    </td>
                </tr>
            @endif
        </table>
    </div>
    {{-- 3.สรุปผลการสอบ --}}
    <div class="section">
        <table>
            <tr>
                <td colspan="10">
                    <div>3. สรุปผลการสอบ</div>
                </td>
            </tr>
            @if ($comments->isNotEmpty())
                @foreach ($admins as $admin)
                    @php
                        $result = $comments
                            ->where('id_teacher', $admin->id_teacher)
                            ->where('id_document', $documentId)
                            ->where('id_position', 3)
                            ->where('id_comment_list', 26)
                            ->first();
                        $resultDetail = $comments
                            ->where('id_teacher', $admin->id_teacher)
                            ->where('id_document', $documentId)
                            ->where('id_position', 3)
                            ->where('id_comment_list', 27)
                            ->first();
                    @endphp
                    <tr>
                        <td style="width: 1.8em"></td>
                        <td colspan="9">
                            <div>
                                <input type="checkbox" {{ $result->comment == 'ผ่าน' ? 'checked' : '' }}>
                                <label> ผ่าน</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="9">
                            <div>
                                <input type="checkbox" {{ $result->comment == 'ผ่าน/ แก้ไขใหม่' ? 'checked' : '' }}>
                                <label> ผ่าน/ แก้ไขใหม่</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 1.8em"></td>
                        <td colspan="2">
                            <div>แก้ไข ดังนี้</div>
                        </td>
                        <td colspan="6">
                            <div>
                                @if (isset($resultDetail) && $result->comment == 'ผ่าน/ แก้ไขใหม่')
                                    <span class="dotted"> {{ $resultDetail->comment }} </span>
                                @else
                                    .........................................................................................................................
                                    <br>.........................................................................................................................
                                    <br>.........................................................................................................................
                                    <br>.........................................................................................................................
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="9">
                            <div>
                                <input type="checkbox"
                                    {{ isset($result) && $result->comment == 'ไม่ผ่าน' ? 'checked' : '' }}>
                                <label> ไม่ผ่าน</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 1.8em"></td>
                        <td colspan="2">
                            <div>เนื่องจาก</div>
                        </td>
                        <td colspan="6">
                            <div>
                                @if (isset($resultDetail) && $result->comment == 'ไม่ผ่าน')
                                    <span class="dotted"> {{ $resultDetail->comment }} </span>
                                @else
                                    .........................................................................................................................
                                    <br>.........................................................................................................................
                                    <br>.........................................................................................................................
                                    <br>.........................................................................................................................
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td style="width: 1.8em"></td>
                    <td colspan="9">
                        <div>
                            <input type="checkbox">
                            <label> ผ่าน</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="9">
                        <div>
                            <input type="checkbox">
                            <label> ผ่าน/ แก้ไขใหม่</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 1.8em"></td>
                    <td colspan="2">
                        <div>แก้ไข ดังนี้</div>
                    </td>
                    <td colspan="6">
                        <div>
                            .........................................................................................................................
                            <br>.........................................................................................................................
                            <br>.........................................................................................................................
                            <br>.........................................................................................................................
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="9">
                        <div>
                            <input type="checkbox">
                            <label> ไม่ผ่าน</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 1.8em"></td>
                    <td colspan="2">
                        <div>เนื่องจาก</div>
                    </td>
                    <td colspan="6">
                        <div>
                            .........................................................................................................................
                            <br>.........................................................................................................................
                            <br>.........................................................................................................................
                            <br>.........................................................................................................................
                        </div>
                    </td>
                </tr>
            @endif
        </table>
    </div>
    {{-- 4.ลงชื่อคณะกรรมการสอบ --}}
    <div class="section">
        <table>
            <tr>
                <td colspan="2">
                    <div>4. ลงชื่อคณะกรรมการสอบ</div>
                </td>
            </tr>
            @if ($projects->confirmTeachers)
                @foreach ($directors as $director)
                    @php
                        $confirm = $projects->confirmTeachers
                            ->where('id_teacher', $director->id_teacher)
                            ->where('id_position', $director->id_position)
                            ->where('id_document', $documentId)
                            ->where('confirm_status', 1)
                            ->first();
                    @endphp
                    <tr>
                        <td style="width: 1.8em"></td>
                        <td>
                            <div class="signature">
                                @if ($confirm)
                                    ลงชื่อ .........................................
                                    {{ $director->id_position == 7
                                        ? $director->position->position . ' (อาจารย์ที่ปรึกษา)'
                                        : $director->position->position }}
                                    <br>(<span class="dotted">
                                        {{ $director->teacher->prefix . ' ' . $director->teacher->name . ' ' . $director->teacher->surname }}
                                    </span>)
                                    <br>วันที่<span class="dotted"> {{ $confirm->created_at->thaidate('j') }}
                                    </span>เดือน<span class="dotted">
                                        {{ $confirm->created_at->thaidate('F') }} </span>พ.ศ.<span class="dotted">
                                        {{ $confirm->created_at->thaidate('Y') }} </span>
                                @else
                                    ลงชื่อ .........................................
                                    {{ $director->id_position == 7
                                        ? $director->position->position . ' (อาจารย์ที่ปรึกษา)'
                                        : $director->position->position }}
                                    <br>( ............................................................. )
                                    <br>วันที่ ....... เดือน ............... พ.ศ. ............
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td style="width: 1.8em"></td>
                    <td>
                        <div class="signature">
                            ลงชื่อ ......................................... ประธานกรรมการ
                            <br>( ............................................................. )
                            <br>วันที่ ....... เดือน ............... พ.ศ. ............
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="signature">
                            ลงชื่อ ......................................... กรรมการ
                            <br>( ............................................................. )
                            <br>วันที่ ....... เดือน ............... พ.ศ. ............
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="signature">
                            ลงชื่อ ......................................... กรรมการ
                            <br>( ............................................................. )
                            <br>วันที่ ....... เดือน ............... พ.ศ. ............
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="signature">
                            ลงชื่อ ......................................... กรรมการและเลขานุการ (อาจารย์ที่ปรึกษา)
                            <br>( ............................................................. )
                            <br>วันที่ ....... เดือน ............... พ.ศ. ............
                        </div>
                    </td>
                </tr>
            @endif
        </table>
    </div>
    {{-- 5.ความเห็นของอาจารย์ผู้รับผิดชอบรายวิชา --}}
    <div class="section">
        <table>
            <tr>
                <td colspan="5">
                    <div>5. ความเห็นของอาจารย์ผู้รับผิดชอบรายวิชา</div>
                </td>
            </tr>
            @foreach ($admins as $admin)
                @php
                    $adminComments = $comments
                        ->where('id_teacher', $admin->id_teacher)
                        ->where('id_document', $documentId)
                        ->where('id_position', 3)
                        ->where('id_comment_list', 1)
                        ->sortBy('created_at');
                    $adminOtherComment = $comments
                        ->where('id_teacher', $admin->id_teacher)
                        ->where('id_document', $documentId)
                        ->where('id_position', 3)
                        ->where('id_comment_list', 2);
                    $confirm = $projects->confirmTeachers
                        ->where('id_teacher', $admin->id_teacher)
                        ->where('id_position', 3)
                        ->where('id_document', $documentId)
                        ->where('confirm_status', 1)
                        ->first();
                @endphp

                @if ($adminComments->isNotEmpty() || $adminOtherComment->isNotEmpty() || $confirm)
                    <tr>
                        <td style="width: 1.8em"></td>
                        <td>
                            <div>
                                <input type="checkbox"
                                    {{ $adminComments->first()->comment == 'อนุมัติ' ? 'checked' : '' }}>
                                <label> อนุมัติ</label>
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input type="checkbox"
                                    {{ $adminComments->first()->comment != 'อนุมัติ' ? 'checked' : '' }}>
                                <label> ควรปรับผลการประเมิน</label>
                                @if ($adminComments->first()->comment != 'อนุมัติ')
                                    เป็น<span class="dotted"> {{ $adminComments->first()->comment }} </span>
                                @else
                                    เป็น ............................................................
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div>เนืองจาก</div>
                        </td>
                        <td colspan="3">
                            <div>
                                @if ($adminComments->first()->comment != 'อนุมัติ')
                                    <span class="dotted"> {{ $adminOtherComment->first()->comment }} </span>
                                @else
                                    .........................................................................................................................
                                    <br>.........................................................................................................................
                                    <br>.........................................................................................................................
                                    <br>.........................................................................................................................
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="signature" colspan="4">
                            <div>
                                @if ($confirm)
                                    ลงชื่อ ......................................... อาจารย์ผู้รับผิดชอบรายวิชา
                                    <br>(<span class="dotted">
                                        {{ $confirm->teacher->prefix . ' ' . $confirm->teacher->name . ' ' . $confirm->teacher->surname }}
                                    </span>)
                                    <br>วันที่<span class="dotted"> {{ $confirm->created_at->thaidate('j') }}
                                    </span>เดือน<span class="dotted">
                                        {{ $confirm->created_at->thaidate('F') }} </span>พ.ศ.<span class="dotted">
                                        {{ $confirm->created_at->thaidate('Y') }} </span>
                                @else
                                    ลงชื่อ ......................................... อาจารย์ผู้รับผิดชอบรายวิชา
                                    <br>( ............................................................. )
                                    <br>วันที่ ....... เดือน ............... พ.ศ. ............
                                @endif
                            </div>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td style="width: 1.8em"></td>
                        <td>
                            <div>
                                <input type="checkbox">
                                <label> อนุมัติ</label>
                            </div>
                        </td>
                        <td colspan="3">
                            <div style="padding-left: 1em">
                                <input type="checkbox">
                                <label> ควรปรับผลการประเมิน</label>
                                เป็น ............................................................
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div>เนืองจาก</div>
                        </td>
                        <td colspan="3">
                            <div>
                                .........................................................................................................................
                                <br>.........................................................................................................................
                                <br>.........................................................................................................................
                                <br>.........................................................................................................................
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="signature" colspan="4">
                            ลงชื่อ ......................................... อาจารย์ผู้รับผิดชอบรายวิชา
                            <br>( ............................................................. )
                            <br>วันที่ ....... เดือน ............... พ.ศ. ............
                        </td>
                    </tr>
                @endif
            @endforeach


        </table>
    </div>
    {{-- 6.ความเห็นหัวหน้าสาขาวิชา --}}
    <div class="section">
        <table>
            <tr>
                <td colspan="5">
                    <div>6. ความเห็นหัวหน้าสาขาวิชา</div>
                </td>
            </tr>
            @foreach ($branchHeads as $branchHead)
                @php
                    $branchHeadComments = $comments
                        ->where('id_teacher', $branchHead->id_teacher)
                        ->where('id_document', $documentId)
                        ->where('id_position', 4)
                        ->where('id_comment_list', 1)
                        ->sortBy('created_at');
                    $branchHeadOtherComment = $comments
                        ->where('id_teacher', $branchHead->id_teacher)
                        ->where('id_document', $documentId)
                        ->where('id_position', 4)
                        ->where('id_comment_list', 2);
                    $confirm = $projects->confirmTeachers
                        ->where('id_teacher', $branchHead->id_teacher)
                        ->where('id_position', 4)
                        ->where('id_document', $documentId)
                        ->where('confirm_status', 1)
                        ->first();
                @endphp

                @if ($branchHeadComments->isNotEmpty() || $branchHeadOtherComment->isNotEmpty() || $confirm)
                    <tr>
                        <td style="width: 1.8em"></td>
                        <td>
                            <div>
                                <input type="checkbox"
                                    {{ $branchHeadComments->first()->comment == 'อนุมัติ' ? 'checked' : '' }}>
                                <label> อนุมัติ</label>
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input type="checkbox"
                                    {{ $branchHeadComments->first()->comment != 'อนุมัติ' ? 'checked' : '' }}>
                                <label> ควรปรับผลการประเมิน</label>
                                @if ($branchHeadComments->first()->comment != 'อนุมัติ')
                                    เป็น<span class="dotted"> {{ $branchHeadComments->first()->comment }} </span>
                                @else
                                    เป็น ............................................................
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div>เนืองจาก</div>
                        </td>
                        <td colspan="3">
                            <div>
                                @if ($branchHeadComments->first()->comment != 'อนุมัติ')
                                    <span class="dotted"> {{ $branchHeadOtherComment->first()->comment }} </span>
                                @else
                                    .........................................................................................................................
                                    <br>.........................................................................................................................
                                    <br>.........................................................................................................................
                                    <br>.........................................................................................................................
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="4">
                            <div>
                                และอนุมัติให้ทำการศึกษาได้ ตั้งแต่วันที่<span class="dotted">
                                    {{ $confirm->created_at->thaidate('j') }} </span>
                                เดือน<span class="dotted">{{ $confirm->created_at->thaidate('F') }} </span>
                                พ.ศ.<span class="dotted">{{ $confirm->created_at->thaidate('Y') }} </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="signature" colspan="4">
                            <div>
                                @if ($confirm)
                                    ลงชื่อ ......................................... หัวหน้าสาขาวิชา
                                    <br>(<span class="dotted">
                                        {{ $confirm->teacher->prefix . ' ' . $confirm->teacher->name . ' ' . $confirm->teacher->surname }}
                                    </span>)
                                    <br>วันที่<span class="dotted"> {{ $confirm->created_at->thaidate('j') }}
                                    </span>เดือน<span class="dotted">
                                        {{ $confirm->created_at->thaidate('F') }} </span>พ.ศ.<span class="dotted">
                                        {{ $confirm->created_at->thaidate('Y') }} </span>
                                @else
                                    ลงชื่อ ......................................... หัวหน้าสาขาวิชา
                                    <br>( ............................................................. )
                                    <br>วันที่ ....... เดือน ............... พ.ศ. ............
                                @endif
                            </div>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td style="width: 1.8em"></td>
                        <td>
                            <div>
                                <input type="checkbox">
                                <label> อนุมัติ</label>
                            </div>
                        </td>
                        <td colspan="3">
                            <div style="padding-left: 1em">
                                <input type="checkbox">
                                <label> ควรปรับผลการประเมิน</label>
                                เป็น ............................................................
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div>เนืองจาก</div>
                        </td>
                        <td colspan="3">
                            <div>
                                .........................................................................................................................
                                <br>.........................................................................................................................
                                <br>.........................................................................................................................
                                <br>.........................................................................................................................
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="signature" colspan="4">
                            ลงชื่อ ......................................... หัวหน้าสาขาวิชา
                            <br>( ............................................................. )
                            <br>วันที่ ....... เดือน ............... พ.ศ. ............
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
</body>

</html>
