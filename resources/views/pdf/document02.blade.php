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
        <div class="documentId">คกท.-คง.-02</div>
        {{-- <img class="documentLogo" src="data:image/png;base64,{{ base64_encode(file_get_contents('/home/vol4_2/infinityfree.com/if0_37229336/htdocs/Asset/main/img/logo/RMUTI.png')) }}" alt="University Logo"> --}}
        <img class="documentLogo" src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public\Asset\main\img\logo\RMUTI.png'))); ?>" alt="University Logo">
        <div class="documentHead">
            คณะเกษตรศาสตร์และเทคโนโลยี
            <br>มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน วิทยาเขตสุรินทร์
            <br>แบบขอสอบหัวข้อและเค้าโครงของโครงงาน
            <br>-----------------------------------
        </div>
    </header>
    {{-- ชื่อนักศึกษา --}}
    <div class="section">
        @if ($projects->members->isNotEmpty())
            <table>
                @foreach ($projects->members as $index => $member)
                    <tr>
                        <td style="width: 3.6em">
                            @if ($loop->first)
                                <div>ชื่อนักศึกษา</div>
                            @endif
                        </td>
                        <td>
                            <div>
                                คนที่ {{ $loop->iteration }}<span class="dotted">
                                    {{ $member->prefix . ' ' . $member->name . ' ' . $member->surname }}</span>
                                รหัส<span class="dotted"> {{ $member->id_student }} </span>
                            </div>
                        </td>
                    </tr>
                    @if (
                        $loop->last ||
                            $member->id_level != $projects->members[$index + 1]->id_level ||
                            $member->id_course != $projects->members[$index + 1]->id_course)
                        <tr>
                            <td></td>
                            <td>
                                <div>
                                    หลักสูตร<span class="dotted"> {{ $member->course->course }} </span>
                                    สาขาวิชา<span class="dotted"> เทคโนโลยีคอมพิวเตอร์</span>
                                </div>
                                <div>
                                    ระดับ
                                    <input type="checkbox" {{ $member->level->id_level == 1 ? 'checked' : '' }}>
                                    <label>ประกาศนียบัตรวิชาชีพขั้นสูง</label>

                                    <input type="checkbox" {{ $member->level->id_level != 1 ? 'checked' : '' }}>
                                    <label>
                                        ปริญญาตรี
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
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td colspan="2">
                        <div>
                            ขออนุมัติชื่อเรื่องและแต่งตั้งอาจารย์ที่ปรึกษา ปัญหาพิเศษ โครงการพิเศษ โครงงานปริญญานิพนธ์
                        </div>
                    </td>
                </tr>
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
                    <td></td>
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
                            ระดับ
                            <input type="checkbox"><label> ประกาศนียบัตรวิชาชีพขั้นสูง</label>
                            <input type="checkbox"><label> ปริญญาตรี .......... ปี</label>
                            ภาค<span class="dotted"> ปกติ </span>
                        </div>
                        <div>
                            ขออนุมัติชื่อเรื่องและแต่งตั้งอาจารย์ที่ปรึกษา ปัญหาพิเศษ โครงการพิเศษ โครงงานปริญญานิพนธ์
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
                <td style="width: 4em">(ภาษาไทย)</td>
                <td><span class="dotted">{{ $projects->project_name_th }}</span></td>
            </tr>
            <tr>
                <td></td>
                <td>(ภาษาอังกฤษ)</td>
                <td><span class="dotted">{{ $projects->project_name_en }}</span></td>
            </tr>
        </table>
    </div>
    {{-- เค้าโครง --}}
    <div class="section">
        <table>
            <tr>
                <td style="width: 1.8em"></td>
                <td>
                    <div>
                        โดยได้ส่งสำเนาเค้าโครงของโครงงาน จำนวน
                        <span class="dotted"> 1 </span>
                        ฉบับ เพื่อใช้ในการสอบเค้าโครงของโครงงาน
                    </div>
                </td>
            </tr>
        </table>
    </div>
    {{-- ลงชื่อ --}}
    <div class="section">
        @if ($projects->members->isNotEmpty())
            @foreach ($projects->members->chunk(2) as $chunk)
                <table class="signature">
                    <tr>
                        @foreach ($chunk as $index => $member)
                            @php
                                $confirm = $projects->confirmStudents
                                    ->where('id_student', $member->id_student)
                                    ->where('id_document', $documentId)
                                    ->where('confirm_status', 1)
                                    ->first();
                            @endphp
                            <td class="signature">
                                @if ($confirm)
                                    ลงชื่อ ......................................... นักศึกษา คนที่
                                    {{ $loop->parent->iteration + $index }}
                                    <br>(<span class="dotted">
                                        {{ $member->prefix . ' ' . $member->name . ' ' . $member->surname }} </span>)
                                    <br>วันที่<span class="dotted"> {{ $confirm->created_at->thaidate('j') }} </span>
                                    เดือน<span class="dotted"> {{ $confirm->created_at->thaidate('F') }} </span>
                                    พ.ศ.<span class="dotted"> {{ $confirm->created_at->thaidate('Y') }} </span>
                                @else
                                    ลงชื่อ ......................................... นักศึกษา คนที่
                                    {{ $loop->parent->iteration + $index }}
                                    <br>( ......................................................... )
                                    <br>วันที่ ....... เดือน ............... พ.ศ. ............
                                @endif
                            </td>
                        @endforeach
                    </tr>
                </table>
            @endforeach
        @else
            <table class="signature">
                <tr>
                    <td class="signature">
                        ลงชื่อ ......................................... นักศึกษา คนที่ 1
                        <br>( ......................................................... )
                        <br>วันที่ ....... เดือน ............... พ.ศ. ............
                    </td>
                    <td class="signature">
                        ลงชื่อ ......................................... นักศึกษา คนที่ 2
                        <br>( ......................................................... )
                        <br>วันที่ ....... เดือน ............... พ.ศ. ............
                    </td>
                </tr>
            </table>
        @endif
    </div>
    {{-- 2.อาจารย์ที่ปรึกษา --}}
    <div class="section">
        <table>
            <tr>
                <td colspan="2">
                    <div>2. อาจารย์ที่ปรึกษาให้ความเห็นชอบแล้ว</div>
                </td>
            </tr>
            <tr>
                @if ($projects->teachers->isNotEmpty())
                    @foreach ($projects->teachers as $teacher)
                        @php
                            $confirm = $projects->confirmTeachers
                                ->where('id_teacher', $teacher->id_teacher)
                                ->where('id_position', 1)
                                ->where('id_document', $documentId)
                                ->where('confirm_status', 1)
                                ->first();
                        @endphp
                        @if ($confirm)
                        @break
                    @endif
                @endforeach

                <td></td>
                <td class="signature">
                    @if ($confirm)
                        ลงชื่อ @if ($teacher->signature_image)
                            <img class="signatureImage"
                                src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $teacher->signature_image))) }}"
                                alt="Signature Image">
                        @else
                            .........................................
                        @endif อาจารย์ที่ปรึกษา
                        <br>(<span class="dotted">
                            {{ $teacher->prefix . ' ' . $teacher->name . ' ' . $teacher->surname }}
                        </span>)
                        <br>วันที่<span class="dotted"> {{ $confirm->created_at->thaidate('j') }}
                        </span>เดือน<span class="dotted">
                            {{ $confirm->created_at->thaidate('F') }} </span>พ.ศ.<span class="dotted">
                            {{ $confirm->created_at->thaidate('Y') }} </span>
                    @else
                        ลงชื่อ ......................................... อาจารย์ที่ปรึกษา
                        <br>( ......................................................... )
                        <br>วันที่ ....... เดือน ............... พ.ศ. ............
                    @endif
                </td>
            @else
                <td></td>
                <td class="signature">
                    ลงชื่อ .................................... อาจารย์ที่ปรึกษา
                    <br>( ......................................................... )
                    <br>วันที่ ....... เดือน ............... พ.ศ. ............
                </td>
            @endif
        </tr>
    </table>
</div>

{{-- 3.เสนอรายชื่อคณะกรรมการสอบเค้าโครง --}}
<div class="section">
    <table>
        <tr>
            <td colspan="3">
                <div>3. เสนอรายชื่อคณะกรรมการสอบเค้าโครง (3-4 คน) ดังนี้</div>
            </td>
        </tr>
        @if ($directors->isNotEmpty())
            @foreach ($directors as $director)
                <tr>
                    <td style="width: 1.8em"></td>
                    <td>
                        <div>
                            {{ $loop->iteration }}. <span class="dotted">
                                {{ $director->teacher->prefix . ' ' . $director->teacher->name . ' ' . $director->teacher->surname }}
                            </span>
                        </div>
                    </td>
                    <td>
                        <div>
                            {{ $director->id_position == 7
                                ? $director->position->position . ' (อาจารย์ที่ปรึกษา)'
                                : $director->position->position }}
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td style="width: 1.8em"></td>
                <td>1. ............................................................................ </td>
                <td>ประธานกรรมการ</td>
            </tr>
            <tr>
                <td></td>
                <td>2. ............................................................................ </td>
                <td>กรรมการ</td>
            </tr>
            <tr>
                <td></td>
                <td>3. ............................................................................ </td>
                <td>กรรมการ</td>
            </tr>
            <tr>
                <td></td>
                <td>4. ............................................................................ </td>
                <td>กรรมการและเลขานุการ (อาจารย์ที่ปรึกษา)</td>
            </tr>
        @endif
    </table>
</div>
{{-- 4.กำหนดให้มีการสอบเค้าโครง --}}
<div class="section">
    <table>
        <tr>
            <td colspan="2">
                <div>4. กำหนดให้มีการสอบเค้าโครง</div>
            </td>
        </tr>
        @foreach ($admins as $admin)
            @php
                $examSchedule = $examSchedules->where('id_teacher', $admin->id_teacher)->first();
            @endphp
            @if ($examSchedule)
                <tr>
                    <td style="width: 1.8em"></td>
                    <td>
                        <div>
                            ในวันที่<span class="dotted"> {{ thaidate('j', $examSchedule->exam_day) }} </span>
                            เดือน<span class="dotted"> {{ thaidate('F', $examSchedule->exam_day) }} </span>
                            พ.ศ.<span class="dotted"> {{ thaidate('Y', $examSchedule->exam_day) }} </span>
                            เวลา<span class="dotted"> {{ thaidate('H:i', $examSchedule->exam_time) }} </span>น.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div>
                            สถานที่<span class="dotted"> {{ $examSchedule->exam_room }} </span>
                            อาคาร<span class="dotted"> {{ $examSchedule->exam_building }} </span>
                            คณะ<span class="dotted"> {{ $examSchedule->exam_group }} </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="signature">
                        @php
                            $confirm = $projects->confirmTeachers
                                ->where('id_teacher', $admin->id_teacher)
                                ->where('id_position', 3)
                                ->where('id_document', $documentId)
                                ->where('confirm_status', 1)
                                ->first();
                        @endphp
                        @if ($confirm)
                            ลงชื่อ @if ($admin->signature_image)
                                <img class="signatureImage"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $admin->signature_image))) }}"
                                    alt="Signature Image">
                            @else
                                .........................................
                            @endif อาจารย์ผู้รับผิดชอบรายวิชา
                            <br>(<span class="dotted">
                                {{ $admin->prefix . ' ' . $admin->name . ' ' . $admin->surname }} </span>)
                            <br>วันที่<span class="dotted"> {{ $confirm->created_at->thaidate('j') }} </span>
                            เดือน<span class="dotted"> {{ $confirm->created_at->thaidate('F') }} </span>
                            พ.ศ.<span class="dotted"> {{ $confirm->created_at->thaidate('Y') }} </span>
                        @else
                            ลงชื่อ ......................................... อาจารย์ผู้รับผิดชอบรายวิชา
                            <br>( ......................................................... )
                            <br>วันที่ ....... เดือน ............... พ.ศ. ............
                        @endif

                    </td>
                </tr>
            @else
                <tr>
                    <td style="width: 1.8em"></td>
                    <td>
                        <div>
                            ในวันที่ ............ เดือน ............................ พ.ศ. ......................
                            เวลา
                            ...................... น.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div>
                            สถานที่ ............................ อาคาร ............................ คณะ
                            ...........................................
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="signature">
                        ลงชื่อ ......................................... อาจารย์ผู้รับผิดชอบรายวิชา
                        <br>( ............................................................. )
                        <br>วันที่ ....... เดือน ............... พ.ศ. ............
                    </td>
                </tr>
            @endif
        @endforeach
    </table>
</div>
{{-- 5.ความเห็นหัวหน้าสาขาวิชา --}}
<div class="section">
    <table>
        <tr>
            <td colspan="2">
                <div>5. ความเห็นหัวหน้าสาขาวิชา</div>
            </td>
        </tr>
        @foreach ($branchHeads as $branchHead)
            @php
                $branchHeadComments = $comments
                    ->where('id_teacher', $branchHead->id_teacher)
                    ->where('id_document', $documentId)
                    ->where('id_position', 4)
                    ->where('id_comment_list', 1);
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
                        <div>
                            <input type="checkbox"
                                {{ $branchHeadComments->first()->comment == 'ไม่อนุมัติ' ? 'checked' : '' }}>
                            <label> ไม่อนุมัติ </label>
                            @if ($branchHeadComments->first()->comment == 'ไม่อนุมัติ')
                                เนื่องจาก<span class="dotted"> {{ $branchHeadOtherComment->first()->comment }}
                                </span>
                            @else
                                เนื่องจาก
                                .....................................................................................................................
                                <br>............................................................................................................................................................
                                <br>............................................................................................................................................................
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="signature">
                        @if ($confirm)
                            ลงชื่อ @if ($branchHead->signature_image)
                                <img class="signatureImage"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $branchHead->signature_image))) }}"
                                    alt="Signature Image">
                            @else
                                .........................................
                            @endif หัวหน้าสาขาวิชา
                            <br>(<span class="dotted">
                                {{ $branchHead->prefix . ' ' . $branchHead->name . ' ' . $branchHead->surname }}
                            </span>)
                            <br>วันที่<span class="dotted"> {{ $confirm->created_at->thaidate('j') }}
                            </span>เดือน<span class="dotted">
                                {{ $confirm->created_at->thaidate('F') }} </span>พ.ศ.<span class="dotted">
                                {{ $confirm->created_at->thaidate('Y') }} </span>
                        @else
                            ลงชื่อ ......................................... หัวหน้าสาขาวิชา
                            <br>( ......................................................... )
                            <br>วันที่ ....... เดือน ............... พ.ศ. ............
                        @endif
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
                        <div>
                            <input type="checkbox">
                            <label> ไม่อนุมัติ เนื่องจาก
                                ......................................................................................................................
                                <br>............................................................................................................................................................
                                <br>............................................................................................................................................................
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="signature">
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
