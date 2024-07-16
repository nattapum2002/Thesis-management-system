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
        <div class="documentId">คกท.-คง.-01</div>
        <img class="documentLogo"
            src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public\Asset\main\img\logo\RMUTI.png'))); ?>"
            alt="University Logo">
        <div class="documentHead">
            คณะเกษตรศาสตร์และเทคโนโลยี
            <br>มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน วิทยาเขตสุรินทร์
            <br>แบบขออนุมัติชื่อเรื่อง ปัญหาพิเศษ โครงการพิเศษ โครงงานปริญญานิพนธ์ และแต่งตั้งอาจารย์ที่ปรึกษา
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
                        คนที่ {{ $loop->iteration }}<span class="dotted"> {{ $member->prefix . ' '
                            .
                            $member->name . ' ' .
                            $member->surname }}
                        </span>รหัส<span class="dotted"> {{ $member->id_student }} </span>
                    </div>
                </td>
            </tr>
            <tr>
                @if ($loop->last || $member->id_level != $projects->members[$index + 1]->id_level ||
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
                            @endif</label>
                        ภาค<span class="dotted"> ปกติ </span>
                    </div>
                </td>
                @endif
            </tr>
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
    {{-- 2.อาจารย์ที่ปรึกษา --}}
    <div class="section">
        @if ($projects->teachers->isNotEmpty())
        <table>
            <tr>
                <td colspan="2">
                    <div>2. อาจารย์ที่ปรึกษา</div>
                </td>
            </tr>
            @foreach ($projects->teachers as $index)
            @if ($index->pivot->id_position == 1)
            <tr>
                <td style="width: 1.8em"></td>
                <td>
                    2.1 ชื่อ<span class="dotted"> {{ $index->prefix . ' ' . $index->name . ' ' . $index->surname }}
                    </span>ตำแหน่งทางวิชาการ<span class="dotted"> {{
                        $index->academic_position }} </span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2">
                    วุฒิการศึกษา<span class="dotted"> {{ $index->educational_qualification }} </span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2">
                    สาขา<span class="dotted"> {{ $index->branch }}
                    </span>
                </td>
            </tr>
            @endif
            @endforeach
        </table>
        @else
        <table>
            <tr>
                <td colspan="2">
                    <div>2. อาจารย์ที่ปรึกษา</div>
                </td>
            </tr>
            <tr>
                <td style="width: 1.8em"></td>
                <td>
                    2.1 ชื่อ ................................... นามสกุล ..................................
                    ตำแหน่งทางวิชาการ ............................
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    วุฒิการศึกษา ............................................................. สาขา
                    ............................................................. </td>
            </tr>
        </table>
        @endif
    </div>
    {{-- 3.อาจารย์ที่ปรึกษาร่วม --}}
    <div class="section">
        @if ($projects->teachers->isNotEmpty())
        <table>
            <tr>
                <td colspan="2">
                    <div>3. อาจารย์ที่ปรึกษาร่วม (ถ้ามี)</div>
                </td>
            </tr>
            @foreach ($projects->teachers->sortByDesc('pivot.id_position') as $index)
            @if ($index->pivot->id_position == 2)
            <tr>
                <td style="width: 1.8em"></td>
                <td>3.{{ $loop->iteration }} ชื่อ<span class="dotted"> {{ $index->prefix . ' ' . $index->name . '
                        ' .
                        $index->surname }}
                    </span>ตำแหน่งทางวิชาการ<span class="dotted"> {{
                        $index->academic_position }} </span></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2">วุฒิการศึกษา<span class="dotted"> {{ $index->educational_qualification }} </span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2">สาขา<span class="dotted"> {{ $index->branch }} </span>
                </td>
            </tr>
            @endif
            @endforeach
        </table>
        @else
        <table>
            <tr>
                <td colspan="2">
                    <div>3. อาจารย์ที่ปรึกษาร่วม (ถ้ามี)</div>
                </td>
            </tr>
            <tr>
                <td style="width: 1.8em"></td>
                <td>
                    3.1 ชื่อ ................................... นามสกุล ..................................
                    ตำแหน่งทางวิชาการ ............................
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    วุฒิการศึกษา ............................................................. สาขา
                    .............................................................
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    3.2 ชื่อ ................................... นามสกุล ..................................
                    ตำแหน่งทางวิชาการ ............................
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    วุฒิการศึกษา ............................................................. สาขา
                    .............................................................
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    3.3 ชื่อ ................................... นามสกุล ..................................
                    ตำแหน่งทางวิชาการ ............................
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    วุฒิการศึกษา ............................................................. สาขา
                    .............................................................
                </td>
            </tr>
        </table>
        @endif
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
    {{-- 4.ผู้รับเสนอ --}}
    <div class="section">
        @if ($projects->teachers->isNotEmpty())
        <table>
            <tr>
                <td colspan="2">
                    <div>4. ผู้รับเสนอ</div>
                </td>
            </tr>
            @foreach (range(1, count($projects->teachers)) as $i)
            <tr>
                @foreach (range(1, 2) as $j)
                @php
                $index = ($i - 1) * 2 + ($j - 1);
                @endphp
                @if (isset($projects->teachers[$index]))
                @php
                $teacher = $projects->teachers[$index];
                $confirm = $projects->confirmTeachers
                ->where('id_teacher', $teacher->id_teacher)
                ->where('id_position', $teacher->pivot->id_position ? 1 : 2)
                ->where('id_document', $documentId)
                ->where('confirm_status', 1)
                ->first();
                @endphp
                <td class="signature">
                    @if ($confirm)
                    ลงชื่อ<span class="dotted"> {{ $teacher->name }} </span>{{ $teacher->pivot->id_position == 1 ?
                    'อาจารย์ที่ปรึกษา' : 'อาจารย์ที่ปรึกษาร่วม' }}
                    <br>(<span class="dotted">
                        {{ $teacher->prefix . ' ' . $teacher->name . ' ' . $teacher->surname }}
                    </span>)
                    <br>วันที่<span class="dotted"> {{ $confirm->created_at->thaidate('j') }} </span>เดือน<span
                        class="dotted">
                        {{ $confirm->created_at->thaidate('F') }} </span>พ.ศ.<span class="dotted">
                        {{ $confirm->created_at->thaidate('Y') }} </span>
                    @else
                    ลงชื่อ ......................................... {{ $teacher->pivot->id_position == 1 ?
                    'อาจารย์ที่ปรึกษา' : 'อาจารย์ที่ปรึกษาร่วม' }}
                    <br>(<span class="dotted">
                        {{ $teacher->prefix . ' ' . $teacher->name . ' ' . $teacher->surname }}
                    </span>)
                    <br>วันที่ ....... เดือน ............... พ.ศ. ............
                    @endif
                </td>
                @endif
                @endforeach
            </tr>
            @endforeach
        </table>
        @else
        <table>
            <tr>
                <td colspan="2">
                    <div>4. ผู้รับเสนอ</div>
                </td>
            </tr>
            <tr>
                <td class="signature">
                    ลงชื่อ .................................... อาจารย์ที่ปรึกษา
                    <br>( ......................................................... )
                    <br>วันที่ ....... เดือน ............... พ.ศ. ............
                </td>
                <td class="signature">
                    ลงชื่อ .................................... อาจารย์ที่ปรึกษาร่วม
                    <br>( ......................................................... )
                    <br>วันที่ ....... เดือน ............... พ.ศ. ............
                </td>
            </tr>
            <tr>
                <td class="signature">
                    ลงชื่อ .................................... อาจารย์ที่ปรึกษาร่วม
                    <br>( ......................................................... )
                    <br>วันที่ ....... เดือน ............... พ.ศ. ............
                </td>
                <td class="signature">
                    ลงชื่อ .................................... อาจารย์ที่ปรึกษาร่วม
                    <br>( ......................................................... )
                    <br>วันที่ ....... เดือน ............... พ.ศ. ............
                </td>
            </tr>
        </table>
        @endif
    </div>
    {{-- 5.ความเห็นของอาจารย์ผู้รับผิดชอบรายวิชา --}}
    <div class="section">
        <table>
            <tr>
                <td colspan="3">
                    <div>5. ความเห็นของอาจารย์ผู้รับผิดชอบรายวิชา</div>
                </td>
            </tr>
            @foreach ($admins as $admin)
            @php
            $adminComments = $comments->where('id_teacher', $admin->id_teacher)->where('id_document',
            1)->where('id_position', 3)->where('id_comment_list', 1)->sortBy('created_at');
            $adminOtherComment = $comments->where('id_teacher', $admin->id_teacher)->where('id_document',
            1)->where('id_position', 3)->where('id_comment_list', 2);
            @endphp

            @if ($adminComments->isNotEmpty() || $adminOtherComment->isNotEmpty())
            @break
            @endif

            @endforeach

            @if ($adminComments->isNotEmpty())
            <tr>
                <td style="width: 1.8em"></td>
                <td>
                    <div>
                        <input type="checkbox" {{ $adminComments->where('comment',
                        'อนุมัติชื่อเรื่อง')->isNotEmpty() ? 'checked' : '' }}>
                        <label> อนุมัติชื่อเรื่อง</label>
                    </div>
                </td>
                <td>
                    <div>
                        <input type="checkbox" {{ $adminComments->where('comment',
                        'อนุมัติอาจารย์ที่ปรึกษา')->isNotEmpty() ? 'checked' : '' }}>
                        <label> อนุมัติอาจารย์ที่ปรึกษา</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div>
                        <input type="checkbox" {{ $adminComments->where('comment', 'ไม่อนุมัติ เนื่องจาก')->isNotEmpty()
                        ? 'checked' : '' }}>
                        <label> ไม่อนุมัติ เนื่องจาก</label>
                    </div>
                </td>
                <td>
                    <div>
                        <input type="checkbox" {{ $adminComments->where('comment',
                        'มีคุณวุฒิทางการศึกษาไม่เป็นไปตามเกณฑ์')->isNotEmpty() ? 'checked' : '' }}>
                        <label> มีคุณวุฒิทางการศึกษาไม่เป็นไปตามเกณฑ์</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <div>
                        <input type="checkbox" {{ $adminComments->where('comment',
                        'มีจำนวนนักศึกษาที่รับผิดชอบเกินเกณฑ์ที่กำหนดไว้')->isNotEmpty() ? 'checked' : '' }}>
                        <label> มีจำนวนนักศึกษาที่รับผิดชอบเกินเกณฑ์ที่กำหนดไว้</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <div>
                        <input type="checkbox" {{ $adminOtherComment->isNotEmpty() ? 'checked' : '' }}>
                        <label> อื่นๆ</label>
                        @if ($adminOtherComment->isNotEmpty())
                        <span class="dotted"> {{ $adminOtherComment->first()->comment }} </span>
                        @else
                        ..........................................................................
                        @endif
                    </div>
                </td>
            </tr>
            <tr>
                @php
                $confirm = $projects->confirmTeachers
                ->where('id_teacher', $admin->id_teacher)
                ->where('id_position', 3)
                ->where('id_document', $documentId)
                ->where('confirm_status', 1)
                ->first();
                @endphp
                <td></td>
                <td class="signature" colspan="2">
                    @if ($confirm)
                    ลงชื่อ<span class="dotted"> {{ $admin->name }} </span>อาจารย์ผู้รับผิดชอบรายวิชา
                    <br>(<span class="dotted"> {{ $admins[$index]->prefix . ' ' . $admin->name . ' ' .
                        $admin->surname }} </span>)
                    <br>วันที่<span class="dotted"> {{ $confirm->created_at->thaidate('j') }} </span>เดือน<span
                        class="dotted">
                        {{ $confirm->created_at->thaidate('F') }} </span>พ.ศ.<span class="dotted">
                        {{ $confirm->created_at->thaidate('Y') }} </span>
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
                        <input type="checkbox">
                        <label> อนุมัติชื่อเรื่อง</label>
                    </div>
                </td>
                <td>
                    <div>
                        <input type="checkbox">
                        <label> อนุมัติอาจารย์ที่ปรึกษา</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div>
                        <input type="checkbox">
                        <label> ไม่อนุมัติ เนื่องจาก</label>
                    </div>
                </td>
                <td>
                    <div>
                        <input type="checkbox">
                        <label> มีคุณวุฒิทางการศึกษาไม่เป็นไปตามเกณฑ์</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <div>
                        <input type="checkbox">
                        <label> มีจำนวนนักศึกษาที่รับผิดชอบเกินเกณฑ์ที่กำหนดไว้</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <div>
                        <input type="checkbox">
                        <label> อื่นๆ ................. </label>
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="signature" colspan="2">
                    ลงชื่อ ......................................... อาจารย์ผู้รับผิดชอบรายวิชา
                    <br>( ............................................................. )
                    <br>วันที่ ....... เดือน ............... พ.ศ. ............
                </td>
            </tr>
            @endif
        </table>
    </div>
    {{-- 6.ความเห็นหัวหน้าสาขาวิชา --}}
    <div class="section">
        <table>
            <tr>
                <td colspan="2">
                    <div>6. ความเห็นหัวหน้าสาขาวิชา</div>
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
                        <input type="checkbox" {{ $branchHeadComments->first() == 'อนุมัติ' ? 'checked' : '' }}>
                        <label> อนุมัติ</label>
                    </div>
                    <div>
                        <input type="checkbox" {{ $branchHeadComments->first() == 'ไม่อนุมัติ' ? 'checked' : '' }}>
                        <label> ไม่อนุมัติ</label>
                        @if ($branchHeadComments->first() == 'ไม่อนุมัติ')
                        เนื่องจาก<span class="dotted"> {{ $branchHeadOtherComment->first()->comment }} </span>
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
                        <label> ไม่อนุมัติ</label>
                        เนื่องจาก
                        .....................................................................................................................
                        <br>............................................................................................................................................................
                        <br>............................................................................................................................................................
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