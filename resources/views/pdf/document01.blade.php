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
        {{-- <img class="documentLogo" src="data:image/png;base64,{{ base64_encode(file_get_contents('/home/vol4_2/infinityfree.com/if0_37229336/htdocs/Asset/main/img/logo/RMUTI.png')) }}" alt="University Logo"> --}}
        <img class="documentLogo" src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public\Asset\main\img\logo\RMUTI.png'))); ?>" alt="University Logo">
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
    {{-- 2.อาจารย์ที่ปรึกษา --}}
    <div class="section">
        <table>
            <tr>
                <td colspan="2">
                    <div>2. อาจารย์ที่ปรึกษา</div>
                </td>
            </tr>

            @forelse ($projects->teachers as $index)
                @if ($index->pivot->id_position == 1)
                    <tr>
                        <td style="width: 1.8em"></td>
                        <td>
                            2.1 ชื่อ<span class="dotted">
                                {{ $index->prefix . ' ' . $index->name . ' ' . $index->surname }} </span>
                            ตำแหน่งทางวิชาการ<span class="dotted"> {{ $index->academic_position }} </span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            วุฒิการศึกษา<span class="dotted"> {{ $index->educational_qualification }} </span>
                            สาขา<span class="dotted"> {{ $index->branch }} </span>
                        </td>
                    </tr>
                @endif
            @empty
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
                        .............................................................
                    </td>
                </tr>
            @endforelse
        </table>
    </div>
    {{-- 3.อาจารย์ที่ปรึกษาร่วม --}}
    <div class="section">
        <table>
            <tr>
                <td colspan="2">3. อาจารย์ที่ปรึกษาร่วม (ถ้ามี)</td>
            </tr>
            @forelse ($projects->teachers->sortByDesc('pivot.id_position') as $index)
                @if ($index->pivot->id_position == 2)
                    <tr>
                        <td style="width: 1.8em"></td>
                        <td colspan="2">3.{{ $loop->iteration }} ชื่อ<span class="dotted">
                                {{ $index->prefix . ' ' . $index->name . ' ' . $index->surname }} </span>
                            ตำแหน่งทางวิชาการ<span class="dotted"> {{ $index->academic_position }} </span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2">วุฒิการศึกษา<span class="dotted"> {{ $index->educational_qualification }}
                            </span></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2">สาขา<span class="dotted"> {{ $index->branch }} </span></td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td style="width: 1.8em"></td>
                    <td>
                        3.1 ชื่อ ................................... นามสกุล ..................................
                        ตำแหน่งทางวิชาการ ............................
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>วุฒิการศึกษา ............................................................. สาขา
                        .............................................................</td>
                </tr>
                <tr>
                    <td></td>
                    <td>3.2 ชื่อ ................................... นามสกุล ..................................
                        ตำแหน่งทางวิชาการ ............................</td>
                </tr>
                <tr>
                    <td></td>
                    <td>วุฒิการศึกษา ............................................................. สาขา
                        .............................................................</td>
                </tr>
                <tr>
                    <td></td>
                    <td>3.3 ชื่อ ................................... นามสกุล ..................................
                        ตำแหน่งทางวิชาการ ............................</td>
                </tr>
                <tr>
                    <td></td>
                    <td>วุฒิการศึกษา ............................................................. สาขา
                        .............................................................</td>
                </tr>
            @endforelse
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
                                    ลงชื่อ<span class="dotted">{{ $member->name }}</span> นักศึกษา คนที่
                                    {{ $loop->parent->iteration + $index }}
                                    <br>(<span class="dotted">
                                        {{ $member->prefix . ' ' . $member->name . ' ' . $member->surname }} </span>)
                                    <br>วันที่<span class="dotted"> {{ $confirm->created_at->thaidate('j') }} </span>
                                    เดือน<span class="dotted"> {{ $confirm->created_at->thaidate('F') }} </span>
                                    พ.ศ.<span class="dotted"> {{ $confirm->created_at->thaidate('Y') }} </span>
                                @else
                                    ลงชื่อ ......................................... นักศึกษา คนที่
                                    {{ $loop->parent->iteration + $index }}
                                    <br>( ............................................................. )
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
    {{-- 4.ผู้รับเสนอ --}}
    <div class="section">
        @if ($projects->teachers->isNotEmpty())
            <table>
                <tr>
                    <td colspan="2">
                        <div>4. ผู้รับเสนอ</div>
                    </td>
                </tr>
                @foreach ($projects->teachers->sortBy('pivot.id_position')->chunk(2) as $chunk)
                    <tr>
                        @foreach ($chunk as $teacher)
                            @php
                                $confirm = $projects->confirmTeachers
                                    ->where('id_teacher', $teacher->id_teacher)
                                    ->where('id_position', $teacher->pivot->id_position)
                                    ->where('id_document', $documentId)
                                    ->where('confirm_status', 1)
                                    ->first();
                            @endphp
                            <td class="signature">
                                @if ($confirm)
                                    ลงชื่อ<span class="dotted"> {{ $teacher->name }} </span>
                                    {{ $teacher->pivot->id_position == 1 ? 'อาจารย์ที่ปรึกษา' : 'อาจารย์ที่ปรึกษาร่วม' }}
                                    <br>(<span class="dotted">
                                        {{ $teacher->prefix . ' ' . $teacher->name . ' ' . $teacher->surname }}
                                    </span>)
                                    <br>วันที่<span class="dotted"> {{ $confirm->created_at->thaidate('j') }}
                                    </span>เดือน<span class="dotted">
                                        {{ $confirm->created_at->thaidate('F') }} </span>พ.ศ.<span class="dotted">
                                        {{ $confirm->created_at->thaidate('Y') }} </span>
                                @else
                                    ลงชื่อ .........................................
                                    {{ $teacher->pivot->id_position == 1 ? 'อาจารย์ที่ปรึกษา' : 'อาจารย์ที่ปรึกษาร่วม' }}
                                    <br>( ............................................................. )
                                    <br>วันที่ ....... เดือน ............... พ.ศ. ............
                                @endif
                            </td>
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
                @endphp

                @if ($adminComments->isNotEmpty() || $adminOtherComment->isNotEmpty())
                    <tr>
                        <td style="width: 1.8em"></td>
                        <td>
                            <div>
                                <input type="checkbox"
                                    {{ $adminComments->where('comment', 'อนุมัติชื่อเรื่อง')->isNotEmpty() ? 'checked' : '' }}>
                                <label> อนุมัติชื่อเรื่อง</label>
                            </div>
                        </td>
                        <td>
                            <div>
                                <input type="checkbox"
                                    {{ $adminComments->where('comment', 'อนุมัติอาจารย์ที่ปรึกษา')->isNotEmpty() ? 'checked' : '' }}>
                                <label> อนุมัติอาจารย์ที่ปรึกษา</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div>
                                <input type="checkbox"
                                    {{ $adminComments->where('comment', 'ไม่อนุมัติ เนื่องจาก')->isNotEmpty() ? 'checked' : '' }}>
                                <label> ไม่อนุมัติ เนื่องจาก</label>
                            </div>
                        </td>
                        <td>
                            <div>
                                <input type="checkbox"
                                    {{ $adminComments->where('comment', 'มีคุณวุฒิทางการศึกษาไม่เป็นไปตามเกณฑ์')->isNotEmpty() ? 'checked' : '' }}>
                                <label> มีคุณวุฒิทางการศึกษาไม่เป็นไปตามเกณฑ์</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <div>
                                <input type="checkbox"
                                    {{ $adminComments->where('comment', 'มีจำนวนนักศึกษาที่รับผิดชอบเกินเกณฑ์ที่กำหนดไว้')->isNotEmpty() ? 'checked' : '' }}>
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
                                <br>(<span class="dotted">
                                    {{ $admin->prefix . ' ' . $admin->name . ' ' . $admin->surname }}
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
                        </td>
                    </tr>
                @else
                    {{-- ไม่มีความเห็นใด ๆ --}}
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
            @endforeach
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
                        <input type="checkbox"
                            {{ $branchHeadComments->first() == 'ไม่อนุมัติ' ? 'checked' : '' }}>
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
                        <br>วันที่<span class="dotted"> {{ $confirm->created_at->thaidate('j') }}
                        </span>เดือน<span class="dotted">
                            {{ $confirm->created_at->thaidate('F') }} </span>พ.ศ.<span class="dotted">
                            {{ $confirm->created_at->thaidate('Y') }} </span>
                    @else
                        ลงชื่อ ......................................... หัวหน้าสาขาวิชา
                        <br>( ............................................................. )
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
