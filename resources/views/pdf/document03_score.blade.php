<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
@include('pdf.css')

<body>
    <div style="font-family: 'THSarabunNew', sans-serif;">
        <header>
            <div class="documentId">คกท.-คง.-03</div>
            {{-- <img class="documentLogo" src="data:image/png;base64,{{ base64_encode(file_get_contents('/home/vol4_2/infinityfree.com/if0_37229336/htdocs/Asset/main/img/logo/RMUTI.png')) }}" alt="University Logo"> --}}
            <img class="documentLogo" src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public\Asset\main\img\logo\RMUTI.png'))); ?>" alt="University Logo">
            <div class="documentHead">
                คณะเกษตรศาสตร์และเทคโนโลยี
                <br>มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน วิทยาเขตสุรินทร์
                <br>แบบรายงานผลการสอบสิ้นสุดโครงงาน
                <br>-----------------------------------
            </div>
        </header>
        @foreach ($projects as $project)
            <div>
                <table>
                    <tr>
                        <td>
                            <div>ชื่อนักศึกษา</div>
                        </td>
                    </tr>
                    @foreach ($project->confirmStudents->unique('id_student') as $confirmStudent)
                        <tr>
                            <td>
                                <div>
                                    คนที่ {{ $loop->iteration }}
                                    <span
                                        class="dotted">{{ $confirmStudent->student->name . ' ' . $confirmStudent->student->surname }}
                                    </span>รหัส
                                    <span class="dotted"> รหัส
                                        {{ $confirmStudent->student->id_student }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div>
                                    เป็นนักศึกษา หลักสูตร<span class="dotted">
                                        {{ $confirmStudent->student->course->course }}</span> สาขาวิชา <span
                                        class="dotted">
                                        เทคโนโลยีคอมพิวเตอร์ </span>
                                </div>
                                <div>
                                    ระดับ
                                    <input type="checkbox"
                                        {{ $confirmStudent->student->id_level == 1 ? 'checked' : '' }}>
                                    <label>ประกาศนียบัตรวิชาชีพขั้นสูง</label>

                                    <input type="checkbox"
                                        {{ $confirmStudent->student->id_level != 1 ? 'checked' : '' }}>
                                    <label>ปริญญาตรี
                                        @if ($confirmStudent->student->id_level == 2)
                                            <span class="dotted"> 4 </span>ปี
                                        @elseif ($confirmStudent->student->id_level == 3)
                                            <span class="dotted"> 2 - 3 </span>ปี
                                        @else
                                            ..... ปี
                                        @endif
                                    </label>
                                    ภาค<span class="dotted"> ปกติ </span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div>
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
                                <span class="dotted">
                                    {{ $project->project_name_th }}
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
                                <span class="dotted">
                                    {{ $project->project_name_en }}
                                </span>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div>
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
                            @foreach ($projectscore->members as $member)
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
                            @foreach ($projectscore->members as $member)
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
                            @foreach ($projectscore->members as $member)
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
                            @foreach ($projectscore->members as $member)
                                @foreach ($scores->where('id_student', $member->id_student)->where('id_comment_list', 21) as $score)
                                    <td>
                                        <div>{{ $score->score != null ? $score->score : 0 }}</div>
                                    </td>
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <div style="padding-left: 1.8em; text-align: left;">2.2 ทักษะการใช้ภาษาเพื่อการสื่อสาร
                                </div>
                            </td>
                            <td>
                                <div>5</div>
                            </td>
                            @foreach ($projectscore->members as $member)
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
                            @foreach ($projectscore->members as $member)
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
                            @foreach ($projectscore->members as $member)
                                <td>
                                    <div> </div>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <div style="padding-left: 1.8em; text-align: left;">4.1
                                    รูปแบบถูกต้องตามคู่มือจัดทำโครงงาน</div>
                            </td>
                            <td>
                                <div>10</div>
                            </td>
                            @foreach ($projectscore->members as $member)
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
                            @foreach ($projectscore->members as $member)
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
                            @foreach ($projectscore->members as $member)
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
                            @foreach ($projectscore->members as $member)
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
                                <div>10</div>
                            </td>
                            @foreach ($projectscore->members as $member)
                                @foreach ($scores->where('id_student', $member->id_student)->where('id_comment_list', 28) as $score)
                                    <td>
                                        <div>{{ $score->score != null ? $score->score : 0 }}</div>
                                    </td>
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                <div style="padding-left: 1.8em; text-align: left;">6. ความตรงต่อเวลา</div>
                            </td>
                            <td>
                                <div>10</div>
                            </td>
                            @foreach ($projectscore->members as $member)
                                @foreach ($scores->where('id_student', $member->id_student)->where('id_comment_list', 29) as $score)
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
                            @foreach ($projectscore->members as $member)
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
                                <div style="padding-left: 1.8em; text-align: left;">2.3 ทักษะการใช้ภาษาเพื่อการสื่อสาร
                                </div>
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
                                <div style="padding-left: 1.8em; text-align: left;">4.1
                                    รูปแบบถูกต้องตามคู่มือจัดทำโครงงาน</div>
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
                                <div style="padding-left: 1.8em; text-align: left;">6. ความตรงต่อเวลา</div>
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
            <div class="section">
                <table>
                    <tr>
                        <td colspan="10">
                            <div>3. สรุปผลการสอบ</div>
                        </td>
                    </tr>
                    @if ($comments->isNotEmpty())
                        {{-- @foreach ($teachers as $teacher)
                    @php
                    $result = $comments->where('id_teacher', $teacher->id_teacher)->where('id_document',
                    $documentId)->where('id_position', 3)->where('id_comment_list', 1)->first();
                    $resultDetail = $comments->where('id_teacher', $teacher->id_teacher)->where('id_document',
                    $documentId)->where('id_position', 3)->where('id_comment_list', 2)->first();
                    @endphp
                    @endforeach --}}
                        <tr>
                            <td style="width: 1.8em"></td>
                            <td colspan="9">
                                <div>
                                    <input type="checkbox"
                                        {{ isset($result) && $result->comment == 'ผ่าน' ? 'checked' : '' }}>
                                    <label> ผ่าน</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="9">
                                <div>
                                    <input type="checkbox"
                                        {{ isset($result) && $result->comment == 'ผ่าน/ แก้ไขใหม่' ? 'checked' : '' }}>
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
            <div>
                <table>
                    @php
                        $teachers = $project->confirmTeachers
                            ->unique('id_teacher')
                            ->where('confirm_status', 1)
                            ->first();
                    @endphp
                    @if ($teachers)
                        <tr>
                            <td colspan="2">
                                <div>4. ลงชื่อคณะกรรมการสอบ</div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8">
                                <div>
                                    ลงชื่อ ......................................... ประธานกรรมการ
                                    <br><span class="dotted">(
                                        {{ $teachers->where('id_position', 5)->first()->teacher->prefix . ' ' . $teachers->where('id_position', 5)->first()->teacher->name . ' ' . $teachers->where('id_position', 5)->first()->teacher->surname }}
                                        )</span>
                                    <br>วันที่ ....... เดือน ............... พ.ศ. ............
                                </div>
                            </td>
                        </tr>
                        @foreach ($project->confirmTeachers->where('id_position', 6)->where('confirm_status', 1) as $directors)
                            <tr>
                                <td colspan="8">
                                    <div>
                                        ลงชื่อ ......................................... กรรมการ
                                        <br>(<span
                                            class="dotted">{{ $directors->teacher->prefix . ' ' . $directors->teacher->name . ' ' . $directors->teacher->surname }}</span>
                                        )
                                        <br>วันที่ ....... เดือน ............... พ.ศ. ............
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="8">
                                <div>
                                    ลงชื่อ ......................................... กรรมการและเลขานุการ
                                    (อาจารย์ที่ปรึกษา)
                                    <br><span class="dotted">(
                                        {{ $teachers->where('id_position', 7)->first()->teacher->prefix . ' ' . $teachers->where('id_position', 7)->first()->teacher->name . ' ' . $teachers->where('id_position', 5)->first()->teacher->surname }}
                                        )</span>
                                    <br>วันที่ ....... เดือน ............... พ.ศ. ............
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="width: 2.8em"></td>
                            <td>
                                <div class="signature">
                                    ลงชื่อ ......................................... อาจารย์ประจำวิชา
                                    <br>(<span
                                        class="dotted">{{ $teachers->where('id_position', 3)->first()->teacher->name . ' ' . $teachers->where('id_position', 3)->first()->teacher->surname }}</span>
                                    )
                                    <br>วันที่ ....... เดือน ............... พ.ศ. ............
                                </div>
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        @endforeach
    </div>
</body>

</html>
