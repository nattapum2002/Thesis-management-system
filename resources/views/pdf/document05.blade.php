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
        <div class="documentId">คกท.-คง.-05</div>
        <img class="documentLogo"
            src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public\Asset\main\img\logo\RMUTI.png'))); ?>"
            alt="University Logo">
        <div class="documentHead">
            คณะเกษตรศาสตร์และเทคโนโลยี
            <br>มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน วิทยาเขตสุรินทร์
            <br>แบบขอสอบสิ้นสุดโครงงาน ครั้งที่<span class="dotted">
                {{ count($examSchedules) > 0 ? count($examSchedules) : '1' }} </span>
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
                        หลักสูตร<span class="dotted"> {{ $member->course->course }} </span>สาขาวิชา<span class="dotted">
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
            <tr>
                <td colspan="2">
                    <div>
                        @if ($examSchedules->isNotEmpty())
                        ตามที่ข้าพเจ้าได้รับอนุมัติให้ทำโครงงานได้ตั้งแต่
                        วันที่<span class="dotted"> {{ thaidate('j', $examSchedules->first()->exam_day) }}
                        </span>
                        เดือน<span class="dotted"> {{ thaidate('F', $examSchedules->first()->exam_day) }}
                        </span>
                        พ.ศ.<span class="dotted"> {{ thaidate('Y', $examSchedules->first()->exam_day) }} </span>
                        ขณะนี้ข้าพเจ้าได้เขียน โครงงานฉบับร่างเสร็จแล้ว
                        จึงมีความประสงค์จะขออนุมัติสอบสิ้นสุดโครงงาน
                        @else
                        ตามที่ข้าพเจ้าได้รับอนุมัติให้ทำโครงงานได้ตั้งแต่
                        วันที่ ....... เดือน ............... พ.ศ. ............
                        ขณะนี้ข้าพเจ้าได้เขียน โครงงานฉบับร่างเสร็จแล้ว
                        จึงมีความประสงค์จะขออนุมัติสอบสิ้นสุดโครงงาน
                        @endif
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
                    <div>
                        ตามที่ข้าพเจ้าได้รับอนุมัติให้ทำโครงงานได้ตั้งแต่
                        วันที่ ....... เดือน ............... พ.ศ. ............
                        ขณะนี้ข้าพเจ้าได้เขียน โครงงานฉบับร่างเสร็จแล้ว จึงมีความประสงค์จะขออนุมัติสอบสิ้นสุดโครงงาน
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
            <tr>
                <td></td>
                <td colspan="2">
                    <div>
                        โดยได้ส่งสำเนาโครงงานฉบับร่าง จำนวน
                        <span class="dotted"> 1 </span>
                        ฉบับ เพื่อใช้ในการสอบสิ้นสุดโครงงาน
                    </div>
                </td>
            </tr>
        </table>
    </div>
    {{-- ลงชื่อ --}}
    <div class="section">
        @if ($projects->members->isNotEmpty())
        @foreach (range(1, count($projects->members)) as $i)
        <table class="signature">
            <tr>
                @foreach (range(1, 2) as $j)
                @php
                $index = ($i - 1) * 2 + ($j - 1);
                @endphp
                @if (isset($projects->members[$index]))
                @php
                $member = $projects->members[$index];
                $confirm = $projects->confirmStudents
                ->where('id_student', $member->id_student)
                ->where('id_document', $documentId)
                ->where('confirm_status', 1)
                ->first();
                @endphp
                <td class="signature">
                    @if ($confirm)
                    ลงชื่อ<span class="dotted"> {{ $member->name }} </span>นักศึกษา คนที่ {{ $index + 1 }}
                    <br>(<span class="dotted"> {{ $member->prefix . ' ' . $member->name . ' ' . $member->surname }}
                    </span>)
                    <br>วันที่<span class="dotted"> {{ $confirm->created_at->thaidate('j') }} </span>เดือน<span
                        class="dotted">
                        {{ $confirm->created_at->thaidate('F') }} </span>พ.ศ.<span class="dotted">
                        {{ $confirm->created_at->thaidate('Y') }} </span>
                    @else
                    ลงชื่อ ......................................... นักศึกษา คนที่
                    {{ $index + 1 }}
                    <br>(<span class="dotted"> {{ $member->prefix . ' ' . $member->name . ' ' . $member->surname }}
                    </span>)
                    <br>วันที่ ....... เดือน ............... พ.ศ. ............
                    @endif
                </td>
                @endif
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
        @if ($projects->teachers->isNotEmpty())
        <table>
            <tr>
                <td colspan="2">
                    <div>2. อาจารย์ที่ปรึกษาให้ความเห็นชอบแล้ว</div>
                </td>
            </tr>
            <tr>
                @foreach ($projects->teachers as $teacher)
                @php
                $confirm = $projects->confirmTeachers
                ->where('id_teacher', $teacher->id_teacher)
                ->where('id_position', 1)
                ->where('id_document', $documentId)
                ->where('confirm_status', 1)
                ->first();
                @endphp

                @if ($confirm != null)
                @break
                @endif
                @endforeach
                <td style="width: 1.8em"></td>
                <td class="signature">
                    @if ($confirm != null)
                    ลงชื่อ<span class="dotted"> {{ $teacher->name }} </span>อาจารย์ที่ปรึกษา
                    <br>(<span class="dotted">
                        {{ $teacher->prefix . ' ' . $teacher->name . ' ' . $teacher->surname }}
                    </span>)
                    <br>วันที่<span class="dotted"> {{ $confirm->created_at->thaidate('j') }} </span>เดือน<span
                        class="dotted">
                        {{ $confirm->created_at->thaidate('F') }} </span>พ.ศ.<span class="dotted">
                        {{ $confirm->created_at->thaidate('Y') }} </span>
                    @else
                    ลงชื่อ ......................................... อาจารย์ที่ปรึกษา
                    <br>(<span class="dotted">
                        {{ $teacher->prefix . ' ' . $teacher->name . ' ' . $teacher->surname }}
                    </span>)
                    <br>วันที่ ....... เดือน ............... พ.ศ. ............
                    @endif
                </td>
            </tr>
        </table>
        @else
        <table>
            <tr>
                <td colspan="2">
                    <div>2. อาจารย์ที่ปรึกษาให้ความเห็นชอบแล้ว</div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="signature">
                    ลงชื่อ .................................... อาจารย์ที่ปรึกษา
                    <br>( ......................................................... )
                    <br>วันที่ ....... เดือน ............... พ.ศ. ............
                </td>
            </tr>
        </table>
        @endif
    </div>
    {{-- 3.เสนอรายชื่อคณะกรรมการสอบสิ้นสุดโครงงาน --}}
    <div class="section">
        <table>
            <tr>
                <td colspan="3">
                    <div>3. เสนอรายชื่อคณะกรรมการสอบสิ้นสุดโครงงาน (3-4 คน) ดังนี้</div>
                </td>
            </tr>
            @if ($directors->isNotEmpty())
            @foreach ($directors as $director)
            <tr>
                <td style="width: 1.8em"></td>
                <td>
                    <div>
                        {{ $loop->iteration }}. <span class="dotted"> {{ $director->teacher->prefix .' '.
                            $director->teacher->name .' '.
                            $director->teacher->surname }} </span>
                    </div>
                </td>
                <td>
                    <div>
                        {{ $director->id_position == 7 ? $director->position->position . ' (อาจารย์ที่ปรึกษา)' :
                        $director->position->position }}
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
    {{-- 4.กำหนดให้มีการสอบสิ้นสุดโครงงาน --}}
    <div class="section">
        <table>
            <tr>
                <td colspan="2">
                    <div>4. กำหนดให้มีการสอบสิ้นสุดโครงงาน</div>
                </td>
            </tr>
            @if ($examSchedules->isNotEmpty())
            @foreach ($admins as $admin)
            @php
            $examSchedule = $examSchedules
            ->where('id_teacher', $admin->id_teacher)
            ->first();
            $confirm = $projects->confirmTeachers
            ->where('id_teacher', $admin->id_teacher)
            ->where('id_position', 3)
            ->where('id_document', $documentId)
            ->where('confirm_status', 1)
            ->first();
            @endphp
            @if ($examSchedule || $confirm)
            @break
            @endif
            @endforeach
            <tr>
                <td style="width: 1.8em"></td>
                <td>
                    <div>
                        ในวันที่<span class="dotted"> {{ thaidate('j', $examSchedule->exam_day) }} </span>
                        เดือน<span class="dotted"> {{ thaidate('F', $examSchedule->exam_day) }} </span>
                        พ.ศ.<span class="dotted"> {{ thaidate('Y', $examSchedule->exam_day) }} </span>
                        เวลา<span class="dotted"> {{ $examSchedule->exam_time }} </span>น.
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
                    @if ($confirm)
                    ลงชื่อ<span class="dotted"> {{ $admin->name }} </span>อาจารย์ผู้รับผิดชอบรายวิชา
                    <br>(<span class="dotted"> {{ $admins[$index]->prefix . ' ' . $admin->name . ' ' . $admin->surname
                        }} </span>)
                    <br>วันที่<span class="dotted"> {{ $confirm->created_at->thaidate('j') }} </span>
                    เดือน<span class="dotted"> {{ $confirm->created_at->thaidate('F') }} </span>
                    พ.ศ.<span class="dotted"> {{ $confirm->created_at->thaidate('Y') }} </span>
                    @else
                    ลงชื่อ ......................................... อาจารย์ผู้รับผิดชอบรายวิชา
                    <br>(<span class="dotted">
                        {{ $admin->prefix . ' ' . $admin->name . ' ' . $admin->surname }}
                    </span>)
                    <br>วันที่ ....... เดือน ............... พ.ศ. ............
                    @endif
                </td>
            </tr>
            @else
            <tr>
                <td style="width: 1.8em"></td>
                <td>
                    <div>
                        ในวันที่ ............ เดือน ............................ พ.ศ. ...................... เวลา
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
            $branchHeadComments = $comments->where('id_teacher', $branchHead->id_teacher)->where('id_document',
            $documentId)->where('id_position', 4)->where('id_comment_list', 1);
            $branchHeadOtherComment = $comments->where('id_teacher', $branchHead->id_teacher)->where('id_document',
            $documentId)->where('id_position', 4)->where('id_comment_list', 2);
            $confirm = $projects->confirmTeachers
            ->where('id_teacher', $branchHead->id_teacher)
            ->where('id_position', 3)
            ->where('id_document', $documentId)
            ->where('confirm_status', 1)
            ->first();
            @endphp
            @if ($branchHeadComments->isNotEmpty() || $branchHeadOtherComment->isNotEmpty() || $confirm)
            @break
            @endif
            @endforeach
            @if ($branchHeadComments->isNotEmpty())
            <tr>
                <td style="width: 1.8em"></td>
                <td>
                    <div>
                        <input type="checkbox" {{ $branchHeadComments->where('comment', 'อนุมัติ')->isNotEmpty() ?
                        'checked' : '' }}>
                        <label> อนุมัติ</label>
                    </div>
                    <div>
                        <input type="checkbox" {{ $branchHeadOtherComment->isNotEmpty() ? 'checked' : '' }}>
                        <label> ไม่อนุมัติ เนื่องจาก<span class="dotted"> {{ $branchHeadOtherComment->first()->comment
                                ?? ' ' }}
                            </span></label>
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="signature">
                    @if ($confirm)
                    ลงชื่อ<span class="dotted"> {{ $branchHead->name }} </span>หัวหน้าสาขาวิชา
                    <br>(<span class="dotted">
                        {{ $branchHead->prefix . ' ' . $branchHead->name . ' ' . $branchHead->surname }}
                    </span>)
                    <br>วันที่<span class="dotted"> {{ $confirm->created_at->thaidate('j') }} </span>เดือน<span
                        class="dotted">
                        {{ $confirm->created_at->thaidate('F') }} </span>พ.ศ.<span class="dotted">
                        {{ $confirm->created_at->thaidate('Y') }} </span>
                    @else
                    ลงชื่อ ......................................... หัวหน้าสาขาวิชา
                    <br>(<span class="dotted">
                        {{ $branchHead->prefix . ' ' . $branchHead->name . ' ' . $branchHead->surname }}
                    </span>)
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
        </table>
    </div>
</body>

</html>