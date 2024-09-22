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
        <div class="documentId">คกท.-คง.-04</div>
        {{-- <img class="documentLogo" src="data:image/png;base64,{{ base64_encode(file_get_contents('/home/vol4_2/infinityfree.com/if0_37229336/htdocs/Asset/main/img/logo/RMUTI.png')) }}" alt="University Logo"> --}}
        <img class="documentLogo" src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public\Asset\main\img\logo\RMUTI.png'))); ?>" alt="University Logo">
        <div class="documentHead">
            คณะเกษตรศาสตร์และเทคโนโลยี
            <br>มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน วิทยาเขตสุรินทร์
            <br>แบบขอส่งเค้าโครงของโครงงาน
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
                        <div>
                            ขออนุมัติชื่อเรื่องและแต่งตั้งอาจารย์ที่ปรึกษา ปัญหาพิเศษ โครงการพิเศษ โครงงานปริญญานิพนธ์
                        </div>
                    </td>
                </tr>
            </table>
        @endif
    </div>
    {{-- 1. ตามมติที่ประชุมคณะกรรมการสอบเค้าโครงของโครงงาน --}}
    <div class="section">
        <table>
            <tr>
                <td colspan="3">
                    <div>1. ตามมติที่ประชุมคณะกรรมการสอบเค้าโครงของโครงงาน</div>
                </td>
            </tr>
            @if ($projects->members->isNotEmpty())
                <tr>
                    <td style="width: 1.8em"></td>
                    <td colspan="2">
                        <div>
                            @if ($examSchedules->isNotEmpty())
                                ครั้งที่<span class="dotted"> {{ count($examSchedules) }} </span>
                                เมื่อวันที่<span class="dotted"> {{ thaidate('j', $examSchedules->first()->exam_day) }}
                                </span>
                                เดือน<span class="dotted"> {{ thaidate('F', $examSchedules->first()->exam_day) }}
                                </span>
                                พ.ศ.<span class="dotted"> {{ thaidate('Y', $examSchedules->first()->exam_day) }} </span>
                                บัดนี้ ข้าพเจ้าได้ดำเนินการแก้ไข
                                <br>ตามมติที่ประชุมแล้ว จึงขอส่งเค้าโครงฉบับแก้ไข จำนวน<span class="dotted"> 1
                                </span>ฉบับ
                            @else
                                ครั้งที่<span class="dotted"> {{ count($examSchedules) }} </span>เมื่อวันที่ .......
                                เดือน
                                ............... พ.ศ. ............ บัดนี้
                                ข้าพเจ้าได้ดำเนินการแก้ไข
                                <br>ตามมติที่ประชุมแล้ว จึงขอส่งเค้าโครงฉบับแก้ไข จำนวน<span class="dotted"> 1
                                </span>ฉบับ
                            @endif
                        </div>
                    </td>
                </tr>
            @else
                <tr>
                    <td style="width: 1.8em"></td>
                    <td colspan="2">
                        <div>
                            ครั้งที่<span class="dotted"> {{ count($examSchedules) }} </span>เมื่อวันที่ ....... เดือน
                            ............... พ.ศ. ............ บัดนี้
                            ข้าพเจ้าได้ดำเนินการแก้ไข
                            <br>ตามมติที่ประชุมแล้ว จึงขอส่งเค้าโครงฉบับแก้ไข จำนวน<span class="dotted"> 1 </span>ฉบับ
                        </div>
                    </td>
                </tr>
            @endif
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
                                        ลงชื่อ ......................................... นักศึกษา คนที่
                                        {{ $index + 1 }}
                                        <br>(<span class="dotted">
                                            {{ $member->prefix . ' ' . $member->name . ' ' . $member->surname }}
                                        </span>)
                                        <br>วันที่<span class="dotted"> {{ $confirm->created_at->thaidate('j') }}
                                        </span>เดือน<span class="dotted">
                                            {{ $confirm->created_at->thaidate('F') }} </span>พ.ศ.<span class="dotted">
                                            {{ $confirm->created_at->thaidate('Y') }} </span>
                                    @else
                                        ลงชื่อ ......................................... นักศึกษา คนที่
                                        {{ $index + 1 }}
                                        <br>( ............................................................. )
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
    {{-- 2. อาจารย์ที่ปรึกษาให้ความเห็นชอบแล้ว --}}
    <div class="section">
        <table>
            <tr>
                <td colspan="2">
                    <div>2. อาจารย์ที่ปรึกษาให้ความเห็นชอบแล้ว</div>
                </td>
            </tr>
            @if ($projects->confirmTeachers->whereIn('id_position', [1, 2])->isNotEmpty())
                @foreach ($projects->confirmTeachers->whereIn('id_position', [1, 2])->unique('id_teacher') as $confirm)
                    <tr>
                        <td style="width: 1.8em"></td>
                        <td class="signature">
                            <div>
                                ลงชื่อ @if ($confirm->teacher->signature_image)
                                    {{-- <img class="signatureImage" src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $confirm->teacher->signature_image))) }}" alt="Signature Image"> --}}
                                    <img class="signatureImage" src="data:image/png;base64,<?php echo base64_encode(file_get_contents(storage_path('app/public/' . $confirm->teacher->signature_image))); ?>"
                                        alt="Signature Image">
                                @else
                                    .........................................
                                @endif
                                {{ $confirm->id_position == 1 ? 'อาจารย์ที่ปรึกษา' : 'อาจารย์ที่ปรึกษาร่วม' }}
                                <br>(<span class="dotted">
                                    {{ $confirm->teacher->prefix .
                                        ' ' .
                                        $confirm->teacher->name .
                                        '
                                                                                                                                                                                                                                                                                                                                                                                                                                        ' .
                                        $confirm->teacher->surname }}
                                </span>)
                                <br>วันที่<span class="dotted"> {{ thaidate('j', $confirm->created_at) }} </span>
                                เดือน<span class="dotted"> {{ thaidate('F', $confirm->created_at) }} </span>
                                พ.ศ.<span class="dotted"> {{ thaidate('Y', $confirm->created_at) }} </span>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td style="width: 1.8em"></td>
                    <td class="signature">
                        <div>
                            ลงชื่อ .................................... อาจารย์ที่ปรึกษา
                            <br>( ......................................................... )
                            <br>วันที่ ....... เดือน ............... พ.ศ. ............
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="signature">
                        <div>
                            ลงชื่อ .................................... อาจารย์ที่ปรึกษาร่วม
                            <br>( ......................................................... )
                            <br>วันที่ ....... เดือน ............... พ.ศ. ............
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="signature">
                        <div>
                            ลงชื่อ .................................... อาจารย์ที่ปรึกษาร่วม
                            <br>( ......................................................... )
                            <br>วันที่ ....... เดือน ............... พ.ศ. ............
                        </div>
                    </td>
                </tr>
            @endif
        </table>
    </div>
    {{-- 3. คณะกรรมการสอบเค้าโครง ได้ดำเนินการตรวจสอบการแก้ไขเค้าโครง ให้เป็นไปตามมติที่ประชุม ของคณะกรรมการแล้ว --}}
    <div class="section">
        <table>
            <tr>
                <td colspan="2">
                    <div>
                        3. คณะกรรมการสอบเค้าโครง ได้ดำเนินการตรวจสอบการแก้ไขเค้าโครง ให้เป็นไปตามมติที่ประชุม
                        ของคณะกรรมการแล้ว
                    </div>
                </td>
            </tr>
            @if ($projects->confirmTeachers->whereIn('id_position', [5, 6, 7])->isNotEmpty())
                @foreach ($projects->confirmTeachers->whereIn('id_position', [5, 6, 7])->unique('id_teacher') as $confirm)
                    <tr>
                        <td style="width: 1.8em"></td>
                        <td class="signature">
                            <div>
                                ลงชื่อ @if ($confirm->teacher->signature_image)
                                    {{-- <img class="signatureImage" src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $confirm->teacher->signature_image))) }}" alt="Signature Image"> --}}
                                    <img class="signatureImage" src="data:image/png;base64,<?php echo base64_encode(file_get_contents(storage_path('app/public/' . $confirm->teacher->signature_image))); ?>"
                                        alt="Signature Image">
                                @else
                                    .........................................
                                @endif
                                {{ $confirm->id_position == 5
                                    ? 'ประธานกรรมการ'
                                    : ($confirm->id_position == 6
                                        ? 'กรรมการ'
                                        : 'กรรมการและเลขานุการ') }}
                                <br>(<span class="dotted">
                                    {{ $confirm->teacher->prefix .
                                        ' ' .
                                        $confirm->teacher->name .
                                        '
                                                                                                                                                                                                                                                                                                                                                                                                                                        ' .
                                        $confirm->teacher->surname }}
                                </span>)
                                <br>วันที่<span class="dotted"> {{ thaidate('j', $confirm->created_at) }} </span>
                                เดือน<span class="dotted"> {{ thaidate('F', $confirm->created_at) }} </span>
                                พ.ศ.<span class="dotted"> {{ thaidate('Y', $confirm->created_at) }} </span>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td style="width: 1.8em"></td>
                    <td class="signature">
                        <div>
                            ลงชื่อ ......................................... ประธานกรรมการ
                            <br>( ............................................................. )
                            <br>วันที่ ....... เดือน ............... พ.ศ. ............
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="signature">
                        <div>
                            ลงชื่อ ......................................... กรรมการ
                            <br>( ............................................................. )
                            <br>วันที่ ....... เดือน ............... พ.ศ. ............
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="signature">
                        <div>
                            ลงชื่อ ......................................... กรรมการ
                            <br>( ............................................................. )
                            <br>วันที่ ....... เดือน ............... พ.ศ. ............
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="signature">
                        <div>
                            ลงชื่อ ......................................... กรรมการและเลขานุการ
                            <br>( ............................................................. )
                            <br>วันที่ ....... เดือน ............... พ.ศ. ............
                        </div>
                    </td>
                </tr>
            @endif
        </table>
    </div>
    {{-- 4.ความเห็นของอาจารย์ผู้รับผิดชอบรายวิชา --}}
    <div class="section">
        <table>
            <tr>
                <td colspan="5">
                    <div>3. ความเห็นของอาจารย์ผู้รับผิดชอบรายวิชา</div>
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
                @break
            @endif
        @endforeach

        @if ($adminComments->isNotEmpty())
            <tr>
                <td style="width: 1.8em"></td>
                <td colspan="2">
                    <div>
                        <input type="checkbox"
                            {{ $adminComments->where('comment', 'เห็นชอบ')->isNotEmpty() ? 'checked' : '' }}>
                        <label> เห็นชอบ</label>
                    </div>
                </td>
                <td>
                    <div>
                        <input type="checkbox"
                            {{ $adminComments->where('comment', 'เห็นชอบแต่ให้มีการแก้ไขเพิ่มเติม')->isNotEmpty() ? 'checked' : '' }}>
                        <label> เห็นชอบแต่ให้มีการแก้ไขเพิ่มเติม</label>
                    </div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="width: 1.8em">
                    <div>ดังนี้</div>
                </td>
                <td colspan="3">
                    <div>
                        @if ($adminComments->where('comment', 'เห็นชอบแต่ให้มีการแก้ไขเพิ่มเติม')->isNotEmpty())
                            <span class="dotted">
                                {{ $adminOtherComment->where('id_document', 4)->first()->comment }} </span>
                        @else
                            .........................................................................................................................
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
                            ลงชื่อ @if ($confirm->teacher->signature_image)
                                {{-- <img class="signatureImage" src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $confirm->teacher->signature_image))) }}" alt="Signature Image"> --}}
                                <img class="signatureImage" src="data:image/png;base64,<?php echo base64_encode(file_get_contents(storage_path('app/public/' . $confirm->teacher->signature_image))); ?>"
                                    alt="Signature Image">
                            @else
                                .........................................
                            @endif อาจารย์ผู้รับผิดชอบรายวิชา
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
                <td colspan="2">
                    <div>
                        <input type="checkbox">
                        <label> เห็นชอบ</label>
                    </div>
                </td>
                <td>
                    <div>
                        <input type="checkbox">
                        <label> เห็นชอบแต่ให้มีการแก้ไขเพิ่มเติม</label>
                    </div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="width: 1.8em">
                    <div>ดังนี้</div>
                </td>
                <td colspan="3">
                    <div>
                        .........................................................................................................................
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
    </table>
</div>
{{-- 5.ความเห็นหัวหน้าสาขาวิชา --}}
<div class="section">
    <table>
        <tr>
            <td colspan="5">
                <div>4. ความเห็นหัวหน้าสาขาวิชา</div>
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
                    <td colspan="2">
                        <div>
                            <input type="checkbox"
                                {{ $branchHeadComments->where('comment', 'เห็นชอบ')->isNotEmpty() ? 'checked' : '' }}>
                            <label> เห็นชอบ</label>
                        </div>
                    </td>
                    <td>
                        <div>
                            <input type="checkbox"
                                {{ $branchHeadComments->where('comment', 'เห็นชอบแต่ให้มีการแก้ไขเพิ่มเติม')->isNotEmpty() ? 'checked' : '' }}>
                            <label> เห็นชอบแต่ให้มีการแก้ไขเพิ่มเติม</label>
                        </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 1.8em">
                        <div>ดังนี้</div>
                    </td>
                    <td colspan="3">
                        <div>
                            @if ($branchHeadComments->where('comment', 'เห็นชอบแต่ให้มีการแก้ไขเพิ่มเติม')->isNotEmpty())
                                <span class="dotted">
                                    {{ $branchHeadOtherComment->where('id_document', 4)->first()->comment }}
                                </span>
                            @else
                                .........................................................................................................................
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
                                ลงชื่อ @if ($confirm->teacher->signature_image)
                                    {{-- <img class="signatureImage" src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $confirm->teacher->signature_image))) }}" alt="Signature Image"> --}}
                                    <img class="signatureImage" src="data:image/png;base64,<?php echo base64_encode(file_get_contents(storage_path('app/public/' . $confirm->teacher->signature_image))); ?>"
                                        alt="Signature Image">
                                @else
                                    .........................................
                                @endif หัวหน้าสาขาวิชา
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
                    <td colspan="2">
                        <div>
                            <input type="checkbox">
                            <label> เห็นชอบ</label>
                        </div>
                    </td>
                    <td>
                        <div>
                            <input type="checkbox">
                            <label> เห็นชอบแต่ให้มีการแก้ไขเพิ่มเติม</label>
                        </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 1.8em">
                        <div>ดังนี้</div>
                    </td>
                    <td colspan="3">
                        <div>
                            .........................................................................................................................
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
{{-- หมายเหตุ --}}
<div class="section">
    <div class="footer">
        หมายเหตุ นักศึกษาต้องดำเนินการแก้ไขให้ถูกต้องและนำส่งสาขาวิชาภายในเวลาไม่เกิน 30 วัน หลังจากสอบ
        เค้าโครงแล้ว
    </div>
</div>
</body>

</html>
