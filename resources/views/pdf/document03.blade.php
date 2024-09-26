<!DOCTYPE html>
<html lang="th">

<head>
    <meta http-equiv="Content-Language" content="th">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="{{ asset('Asset/main/img/logo/favicon.png') }}" type="image/png">
    <title>Document PDF</title>
    @include('pdf.css')
</head>

<body>
    <header>
        <div class="documentId">คกท.-คง.-03</div>
        {{-- <img class="documentLogo" src="data:image/png;base64,{{ base64_encode(file_get_contents('/home/vol4_2/infinityfree.com/if0_37229336/htdocs/Asset/main/img/logo/RMUTI.png')) }}" alt="University Logo"> --}}
        <img class="documentLogo" src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public\Asset\main\img\logo\RMUTI.png'))); ?>" alt="University Logo">
        <div class="documentHead">
            คณะเกษตรศาสตร์และเทคโนโลยี
            <br>มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน วิทยาเขตสุรินทร์
            <br>แบบรายงานผลการสอบเค้าโครงของโครงงาน
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
    {{-- 1.ผลการสอบเค้าโครงของโครงงานของคณะกรรมการ --}}
    <div class="section">
        <table>
            <tr>
                <td colspan="11" style="width: 50em">
                    <div>1. ผลการสอบเค้าโครงของโครงงานของคณะกรรมการ</div>
                </td>
            </tr>
            @if ($comments->isNotEmpty())
                @foreach ($directors as $director)
                    @foreach (range(3, 18) as $list)
                        @php
                            // $examSchedules->skip(1)->first()
                            $examSchedule = $examSchedules->first();
                            $comment[$list] = optional(
                                $comments
                                    ->where('id_teacher', $director->id_teacher)
                                    ->where('id_document', $documentId)
                                    ->where('id_position', 7)
                                    ->where('id_comment_list', $list)
                                    ->first(),
                            );
                        @endphp
                    @endforeach
                @endforeach
                <tr>
                    <td style="width: 1.8em"></td>
                    <td colspan="10">
                        <div>ครั้งที่<span class="dotted"> {{ count($examSchedules) }} </span>
                            เมื่อวันที่<span class="dotted">
                                {{ thaidate('j', $examSchedule->exam_day) }}
                            </span>
                            เดือน<span class="dotted"> {{ thaidate('F', $examSchedule->exam_day) }}
                            </span>
                            พ.ศ.<span class="dotted"> {{ thaidate('Y', $examSchedule->exam_day) }}
                            </span>
                        </div>
                    </td>
                </tr>
                {{-- 1.1 ชื่อเรื่อง --}}
                <tr>
                    <td></td>
                    <td colspan="10">1.1 ชื่อเรื่อง</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" style="width: 4em">
                        <div>
                            (ภาษาไทย)
                        </div>
                    </td>
                    <td colspan="8">
                        <div>
                            <span class="dotted"> {{ $projects->project_name_th }}
                            </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>
                            (ภาษาอังกฤษ)
                        </div>
                    </td>
                    <td colspan="8">
                        <div>
                            <span class="dotted"> {{ $projects->project_name_en }}
                            </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="7">
                        <div>ชื่อเรื่อง ภาษาไทย เหมาะสม รัดกุม สื่อความหมายกับเรื่องที่ทำ</div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox"
                                {{ isset($comment[3]) && $comment[3]->comment == 'ดี' ? 'checked' : '' }}>
                            <label>ดี </label>
                            <input type="checkbox"
                                {{ isset($comment[3]) && $comment[3]->comment != 'ดี' ? 'checked' : '' }}>
                            <label>ควรแก้ไข</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="7">
                        <div>ชื่อเรื่อง ภาษาอังกฤษ เหมาะสม รัดกุม สื่อความหมายกับเรื่องที่ทำ</div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox"
                                {{ isset($comment[4]) && $comment[4]->comment == 'ดี' ? 'checked' : '' }}>
                            <label>ดี </label>
                            <input type="checkbox"
                                {{ isset($comment[4]) && $comment[4]->comment != 'ดี' ? 'checked' : '' }}>
                            <label>ควรแก้ไข</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="10">
                        <div>ควรแก้ไขชื่อเรื่อง</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>
                            (ภาษาไทย)
                        </div>
                    </td>
                    <td colspan="8">
                        <div>
                            @if ($comment[3]->comment != 'ดี')
                                <span class="dotted"> {{ $comment[3]->comment }} <span>
                                    @else
                                        .........................................................................................................................
                                        <br>.........................................................................................................................
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>
                            (ภาษาอังกฤษ)
                        </div>
                    </td>
                    <td colspan="8">
                        <div>
                            @if ($comment[4]->comment != 'ดี')
                                <span class="dotted"> {{ $comment[4]->comment }} <span>
                                    @else
                                        .........................................................................................................................
                                        <br>.........................................................................................................................
                            @endif
                        </div>
                    </td>
                </tr>
                {{-- 1.2 ความเป็นมาและความสำคัญของปัญหา --}}
                <tr>
                    <td></td>
                    <td colspan="10">
                        <div>1.2 ความเป็นมาและความสำคัญของปัญหา</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 1.8em"></td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox"
                                {{ isset($comment[5]) && $comment[5]->comment == 'เหมาะสมเพียงพอ' ? 'checked' : '' }}>
                            <label>เหมาะสมเพียงพอ</label>
                        </div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox"
                                {{ isset($comment[5]) && $comment[5]->comment == 'ไม่เพียงพอ' ? 'checked' : '' }}>
                            <label>ไม่เพียงพอ</label>
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>ข้อเสนอแนะ</div>
                    </td>
                    <td colspan="8">
                        <div>
                            @if ($comment[6]->comment != null)
                                <span class="dotted"> {{ $comment[6]->comment }} <span>
                                    @else
                                        .........................................................................................................................
                                        <br>.........................................................................................................................
                            @endif
                        </div>
                    </td>
                </tr>
                {{-- 1.3 วัตถุประสงค์และขอบเขตของโครงงานปริญญานิพนธ์ --}}
                <tr>
                    <td></td>
                    <td colspan="10">
                        <div>1.3 วัตถุประสงค์และขอบเขตของโครงงานปริญญานิพนธ์</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox"
                                {{ isset($comment[7]) && $comment[7]->comment == 'เหมาะสมเพียงพอ' ? 'checked' : '' }}>
                            <label>เหมาะสมเพียงพอ</label>
                        </div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox"
                                {{ isset($comment[7]) && $comment[7]->comment == 'ไม่เพียงพอ' ? 'checked' : '' }}>
                            <label>ไม่เพียงพอ</label>
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>ข้อเสนอแนะ</div>
                    </td>
                    <td colspan="8">
                        <div>
                            @if ($comment[8]->comment != null)
                                <span class="dotted"> {{ $comment[8]->comment }} <span>
                                    @else
                                        .........................................................................................................................
                                        <br>.........................................................................................................................
                            @endif
                        </div>
                    </td>
                </tr>
                {{-- 1.4 ความเป็นได้ของวิธีการหรือแนวทางในการศึกษา --}}
                <tr>
                    <td></td>
                    <td colspan="10">
                        <div>1.4 ความเป็นได้ของวิธีการหรือแนวทางในการศึกษา</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox"
                                {{ isset($comment[9]) && $comment[9]->comment == 'มาก' ? 'checked' : '' }}>
                            <label>มาก</label>
                        </div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox"
                                {{ isset($comment[9]) && $comment[9]->comment == 'ปานกลาง' ? 'checked' : '' }}>
                            <label>ปานกลาง</label>
                        </div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox"
                                {{ isset($comment[9]) && $comment[9]->comment == 'น้อย' ? 'checked' : '' }}>
                            <label>น้อย</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>ข้อเสนอแนะ</div>
                    </td>
                    <td colspan="8">
                        <div>
                            @if ($comment[10]->comment != null)
                                <span class="dotted"> {{ $comment[10]->comment }} <span>
                                    @else
                                        .........................................................................................................................
                                        <br>.........................................................................................................................
                            @endif
                        </div>
                    </td>
                </tr>
                {{-- 1.5 การวางแผนการดำเนินโครงงาน --}}
                <tr>
                    <td></td>
                    <td colspan="10">
                        <div>1.5 การวางแผนการดำเนินโครงงาน</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox"
                                {{ isset($comment[11]) && $comment[11]->comment == 'ดี' ? 'checked' : '' }}>
                            <label>ดี </label>
                        </div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox"
                                {{ isset($comment[11]) && $comment[11]->comment == 'พอใช้' ? 'checked' : '' }}>
                            <label>พอใช้</label>
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>ข้อเสนอแนะ</div>
                    </td>
                    <td colspan="8">
                        <div>
                            @if ($comment[12]->comment != null)
                                <span class="dotted"> {{ $comment[12]->comment }} <span>
                                    @else
                                        .........................................................................................................................
                                        <br>.........................................................................................................................
                            @endif
                        </div>
                    </td>
                </tr>
                {{-- 1.6 ประโยชน์ที่คาดว่าจะได้รับ --}}
                <tr>
                    <td></td>
                    <td colspan="10">
                        <div>1.6 ประโยชน์ที่คาดว่าจะได้รับ</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox"
                                {{ isset($comment[13]) && $comment[13]->comment == 'มาก' ? 'checked' : '' }}>
                            <label>มาก</label>
                        </div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox"
                                {{ isset($comment[13]) && $comment[13]->comment == 'ปานกลาง' ? 'checked' : '' }}>
                            <label>ปานกลาง</label>
                        </div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox"
                                {{ isset($comment[13]) && $comment[13]->comment == 'น้อย' ? 'checked' : '' }}>
                            <label>น้อย</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>ข้อเสนอแนะ</div>
                    </td>
                    <td colspan="8">
                        <div>
                            @if ($comment[14]->comment != null)
                                <span class="dotted"> {{ $comment[14]->comment }} <span>
                                    @else
                                        .........................................................................................................................
                                        <br>.........................................................................................................................
                            @endif
                        </div>
                    </td>
                </tr>
                {{-- 1.7 โครงงานนี้มีความซ้ำซ้อนกับโครงงานอื่นหรือไม่ --}}
                <tr>
                    <td></td>
                    <td colspan="10">
                        <div>1.7 โครงงานนี้มีความซ้ำซ้อนกับโครงงานอื่นหรือไม่</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox"
                                {{ isset($comment[15]) && $comment[15]->comment == 'ไม่ซ้ำซ้อน' ? 'checked' : '' }}>
                            <label>ไม่ซ้ำซ้อน </label>
                        </div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox"
                                {{ isset($comment[15]) && $comment[15]->comment == 'ซ้ำซ้อน' ? 'checked' : '' }}>
                            <label>ซ้ำซ้อน</label>
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>ข้อเสนอแนะ</div>
                    </td>
                    <td colspan="8">
                        <div>
                            @if ($comment[16]->comment != null)
                                <span class="dotted"> {{ $comment[16]->comment }} <span>
                                    @else
                                        .........................................................................................................................
                                        <br>.........................................................................................................................
                            @endif
                        </div>
                    </td>
                </tr>
                {{-- 1.8 หัวข้อโครงงานนี้เหมาะสมที่จะเป็นโครงงานในระดับ ปวส./ ปริญญาตรี เพียงใด --}}
                <tr>
                    <td></td>
                    <td colspan="10">
                        <div>1.8 หัวข้อโครงงานนี้เหมาะสมที่จะเป็นโครงงานในระดับ ปวส./ ปริญญาตรี เพียงใด</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox"
                                {{ isset($comment[17]) && $comment[17]->comment == 'เหมาะสม' ? 'checked' : '' }}>
                            <label>เหมาะสม</label>
                        </div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox"
                                {{ isset($comment[17]) && $comment[17]->comment == 'ไม่เหมาะสม' ? 'checked' : '' }}>
                            <label>ไม่เหมาะสม</label>
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>ข้อเสนอแนะ</div>
                    </td>
                    <td colspan="8">
                        <div>
                            @if ($comment[18]->comment != null)
                                <span class="dotted"> {{ $comment[18]->comment }} <span>
                                    @else
                                        .........................................................................................................................
                                        <br>.........................................................................................................................
                            @endif
                        </div>
                    </td>
                </tr>
            @else
                <tr>
                    <td style="width: 1.8em"></td>
                    <td colspan="10">
                        <div>ครั้งที่ ....... เมื่อวันที่ ....... เดือน ............... พ.ศ. ............</div>
                    </td>
                </tr>
                {{-- 1.1 ชื่อเรื่อง --}}
                <tr>
                    <td></td>
                    <td colspan="10">1.1 ชื่อเรื่อง</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" style="width: 4em">
                        <div>
                            (ภาษาไทย)
                        </div>
                    </td>
                    <td colspan="8">
                        <div>
                            <span class="dotted"> {{ $projects->project_name_th }}
                            </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>
                            (ภาษาอังกฤษ)
                        </div>
                    </td>
                    <td colspan="8">
                        <div>
                            <span class="dotted"> {{ $projects->project_name_en }}
                            </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="7" style="width: 18em">
                        <div>ชื่อเรื่อง ภาษาไทย เหมาะสม รัดกุม สื่อความหมายกับเรื่องที่ทำ</div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox">
                            <label>ดี </label>
                            <input type="checkbox">
                            <label>ควรแก้ไข</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="7" style="width: 18em">
                        <div>ชื่อเรื่อง ภาษาอังกฤษ เหมาะสม รัดกุม สื่อความหมายกับเรื่องที่ทำ</div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox">
                            <label>ดี </label>
                            <input type="checkbox">
                            <label>ควรแก้ไข</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="10">
                        <div>ควรแก้ไขชื่อเรื่อง</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>
                            (ภาษาไทย)
                        </div>
                    </td>
                    <td colspan="8">
                        <div>
                            .........................................................................................................................
                            <br>.........................................................................................................................
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>
                            (ภาษาอังกฤษ)
                        </div>
                    </td>
                    <td colspan="8">
                        <div>
                            .........................................................................................................................
                            <br>.........................................................................................................................
                        </div>
                    </td>
                </tr>
                {{-- 1.2 ความเป็นมาและความสำคัญของปัญหา --}}
                <tr>
                    <td></td>
                    <td colspan="10" style="width: 18.5em">
                        <div>1.2 ความเป็นมาและความสำคัญของปัญหา</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 1.8em"></td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox">
                            <label>เหมาะสมเพียงพอ</label>
                        </div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox">
                            <label>ไม่เพียงพอ</label>
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>ข้อเสนอแนะ</div>
                    </td>
                    <td colspan="8">
                        <div>
                            .........................................................................................................................
                            <br>.........................................................................................................................
                        </div>
                    </td>
                </tr>
                {{-- 1.3 วัตถุประสงค์และขอบเขตของโครงงานปริญญานิพนธ์ --}}
                <tr>
                    <td></td>
                    <td colspan="10">
                        <div>1.3 วัตถุประสงค์และขอบเขตของโครงงานปริญญานิพนธ์</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox">
                            <label>เหมาะสมเพียงพอ</label>
                        </div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox">
                            <label>ไม่เพียงพอ</label>
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>ข้อเสนอแนะ</div>
                    </td>
                    <td colspan="8">
                        <div>
                            .........................................................................................................................
                            <br>.........................................................................................................................
                        </div>
                    </td>
                </tr>
                {{-- 1.4 ความเป็นได้ของวิธีการหรือแนวทางในการศึกษา --}}
                <tr>
                    <td></td>
                    <td colspan="10">
                        <div>1.4 ความเป็นได้ของวิธีการหรือแนวทางในการศึกษา</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox">
                            <label>มาก</label>
                        </div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox">
                            <label>ปานกลาง</label>
                        </div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox">
                            <label>น้อย</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>ข้อเสนอแนะ</div>
                    </td>
                    <td colspan="8">
                        <div>
                            .........................................................................................................................
                            <br>.........................................................................................................................
                        </div>
                    </td>
                </tr>
                {{-- 1.5 การวางแผนการดำเนินโครงงาน --}}
                <tr>
                    <td></td>
                    <td colspan="10">
                        <div>1.5 การวางแผนการดำเนินโครงงาน</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox">
                            <label>ดี </label>
                        </div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox">
                            <label>พอใช้</label>
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>ข้อเสนอแนะ</div>
                    </td>
                    <td colspan="8">
                        <div>
                            .........................................................................................................................
                            <br>.........................................................................................................................
                        </div>
                    </td>
                </tr>
                {{-- 1.6 ประโยชน์ที่คาดว่าจะได้รับ --}}
                <tr>
                    <td></td>
                    <td colspan="10">
                        <div>1.6 ประโยชน์ที่คาดว่าจะได้รับ</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox">
                            <label>มาก</label>
                        </div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox">
                            <label>ปานกลาง</label>
                        </div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox">
                            <label>น้อย</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>ข้อเสนอแนะ</div>
                    </td>
                    <td colspan="8">
                        <div>
                            .........................................................................................................................
                            <br>.........................................................................................................................
                        </div>
                    </td>
                </tr>
                {{-- 1.7 โครงงานนี้มีความซ้ำซ้อนกับโครงงานอื่นหรือไม่ --}}
                <tr>
                    <td></td>
                    <td colspan="10">
                        <div>1.7 โครงงานนี้มีความซ้ำซ้อนกับโครงงานอื่นหรือไม่</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox">
                            <label>ไม่ซ้ำซ้อน </label>
                        </div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox">
                            <label>ซ้ำซ้อน</label>
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>ข้อเสนอแนะ</div>
                    </td>
                    <td colspan="8">
                        <div>
                            .........................................................................................................................
                            <br>.........................................................................................................................
                        </div>
                    </td>
                </tr>
                {{-- 1.8 หัวข้อโครงงานนี้เหมาะสมที่จะเป็นโครงงานในระดับ ปวส./ ปริญญาตรี เพียงใด --}}
                <tr>
                    <td></td>
                    <td colspan="10">
                        <div>1.8 หัวข้อโครงงานนี้เหมาะสมที่จะเป็นโครงงานในระดับ ปวส./ ปริญญาตรี เพียงใด</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox">
                            <label>เหมาะสม</label>
                        </div>
                    </td>
                    <td colspan="3">
                        <div>
                            <input type="checkbox">
                            <label>ไม่เหมาะสม</label>
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <div>ข้อเสนอแนะ</div>
                    </td>
                    <td colspan="8">
                        <div>
                            .........................................................................................................................
                            <br>.........................................................................................................................
                        </div>
                    </td>
                </tr>

            @endif
        </table>
    </div>
    {{-- 2.คณะกรรมการสอบหัวข้อโครงงานมีความเห็นว่า --}}
    <div class="section">
        <table>
            <tr>
                <td colspan="10">
                    <div>2. คณะกรรมการสอบหัวข้อโครงงานมีความเห็นว่า</div>
                </td>
            </tr>
            @if ($comments->isNotEmpty())
                @foreach ($directors as $director)
                    @php
                        $result = $comments
                            ->where('id_teacher', $director->id_teacher)
                            ->where('id_document', $documentId)
                            ->where('id_position', 7)
                            ->where('id_comment_list', 1)
                            ->first();
                        $resultDetail = $comments
                            ->where('id_teacher', $director->id_teacher)
                            ->where('id_document', $documentId)
                            ->where('id_position', 7)
                            ->where('id_comment_list', 2)
                            ->first();
                    @endphp
                @endforeach
                <tr>
                    <td style="width: 1.8em"></td>
                    <td colspan="9">
                        <div>
                            <input type="checkbox"
                                {{ isset($result) && $result->comment == 'อนุมัติ' ? 'checked' : '' }}>
                            <label> อนุมัติ</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="9">
                        <div>
                            <input type="checkbox"
                                {{ isset($result) && $result->comment == 'ให้แก้ไขปรับปรุงและอนุมัติได้' ? 'checked' : '' }}>
                            <label> ให้แก้ไขปรับปรุงและอนุมัติได้</label>
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
                            @if (isset($resultDetail) && $result->comment == 'ให้แก้ไขปรับปรุงและอนุมัติได้')
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
                                {{ isset($result) && $result->comment == 'ไม่อนุมัติ' ? 'checked' : '' }}>
                            <label> ไม่อนุมัติ</label>
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
                            @if (isset($resultDetail) && $result->comment == 'ไม่อนุมัติ')
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
                    <td></td>
                    <td colspan="8">
                        <div>
                            @if (isset($resultDetail) && $result->comment == 'ไม่อนุมัติ')
                                และให้เสนอเค้าโครงของโครงงาน เป็นครั้งที่ {{ count($examSchedules) + 1 }}
                                เมื่อวันที่<span class="dotted">
                                    {{ thaidate('j', $examSchedules->first()->exam_day) }} </span>
                                เดือน<span class="dotted"> {{ thaidate('F', $examSchedules->first()->exam_day) }}
                                </span>
                                พ.ศ.<span class="dotted"> {{ thaidate('Y', $examSchedules->first()->exam_day) }}
                                </span>
                            @else
                                และให้เสนอเค้าโครงของโครงงาน เป็นครั้งที่ {{ count($examSchedules) + 1 }}
                                ในวันที่ .......
                                เดือน ...............
                                พ.ศ. ............
                            @endif
                        </div>
                    </td>
                </tr>
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
                        <td></td>
                        <td></td>
                        <td colspan="8">
                            <div>
                                @if ($confirm)
                                    ลงชื่อ @if ($director->teacher->signature_image)
                                        <img class="signatureImage"
                                            src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $director->teacher->signature_image))) }}"
                                            alt="Signature Image">
                                    @else
                                        .........................................
                                    @endif
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
                    <td colspan="9">
                        <div>
                            <input type="checkbox">
                            <label> อนุมัติ</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="9">
                        <div>
                            <input type="checkbox">
                            <label> ให้แก้ไขปรับปรุงและอนุมัติได้</label>
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
                            <label> ไม่อนุมัติ</label>
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
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="8">
                        <div>
                            และให้เสนอเค้าโครงของโครงงาน เป็นครั้งที่ {{ count($examSchedules) + 1 }}
                            ในวันที่ .......
                            เดือน ...............
                            พ.ศ. ............
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="8">
                        <div>
                            ลงชื่อ ......................................... ประธานกรรมการ
                            <br>( ............................................................. )
                            <br>วันที่ ....... เดือน ............... พ.ศ. ............
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="8">
                        <div>
                            ลงชื่อ ......................................... กรรมการ
                            <br>( ............................................................. )
                            <br>วันที่ ....... เดือน ............... พ.ศ. ............
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="8">
                        <div>
                            ลงชื่อ ......................................... กรรมการ
                            <br>( ............................................................. )
                            <br>วันที่ ....... เดือน ............... พ.ศ. ............
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="8">
                        <div>
                            ลงชื่อ ......................................... กรรมการและเลขานุการ (อาจารย์ที่ปรึกษา)
                            <br>( ............................................................. )
                            <br>วันที่ ....... เดือน ............... พ.ศ. ............
                        </div>
                    </td>
                </tr>
            @endif
        </table>
    </div>
    {{-- 3.ความเห็นของอาจารย์ผู้รับผิดชอบรายวิชา --}}
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
                    <tr>
                        <td style="width: 1.8em"></td>
                        <td style="width: 3em">
                            <div>
                                ครั้งที่<span class="dotted"> {{ count($examSchedules) }} </span>
                            </div>
                        </td>
                        <td>
                            <div>
                                <input type="checkbox"
                                    {{ $adminComments->where('comment', 'เห็นชอบ')->isNotEmpty() ? 'checked' : '' }}>
                                <label> เห็นชอบ</label>
                            </div>
                        </td>
                        <td>
                            <div>
                                <input type="checkbox"
                                    {{ $adminComments->where('comment', 'ให้แก้ไขตามที่เสนอแนะ')->isNotEmpty() ? 'checked' : '' }}>
                                <label> ให้แก้ไขตามที่เสนอแนะ</label>
                            </div>
                        </td>
                        <td></td>
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
                                    ลงชื่อ @if ($confirm->teacher->signature_image)
                                        <img class="signatureImage"
                                            src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $confirm->teacher->signature_image))) }}"
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
                        <td style="width: 3em">
                            <div>
                                ครั้งที่<span class="dotted"> {{ count($examSchedules) }} </span>
                            </div>
                        </td>
                        <td>
                            <div>
                                <input type="checkbox">
                                <label> เห็นชอบ</label>
                            </div>
                        </td>
                        <td>
                            <div>
                                <input type="checkbox">
                                <label> ให้แก้ไขตามที่เสนอแนะ</label>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="4">
                            <div>
                                และอนุมัติให้ทำการศึกษาได้ ตั้งแต่วันที่ ....... เดือน ............... พ.ศ. ............
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
    {{-- 4.ความเห็นหัวหน้าสาขาวิชา --}}
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
                        <td style="width: 3em">
                            <div>
                                ครั้งที่<span class="dotted"> {{ count($examSchedules) }} </span>
                            </div>
                        </td>
                        <td>
                            <div>
                                <input type="checkbox"
                                    {{ $branchHeadComments->where('comment', 'เห็นชอบ')->isNotEmpty() ? 'checked' : '' }}>
                                <label> เห็นชอบ</label>
                            </div>
                        </td>
                        <td>
                            <div>
                                <input type="checkbox"
                                    {{ $branchHeadComments->where('comment', 'ให้แก้ไขตามที่เสนอแนะ')->isNotEmpty() ? 'checked' : '' }}>
                                <label> ให้แก้ไขตามที่เสนอแนะ</label>
                            </div>
                        </td>
                        <td></td>
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
                                    ลงชื่อ @if ($confirm->teacher->signature_image)
                                        <img class="signatureImage"
                                            src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('app/public/' . $confirm->teacher->signature_image))) }}"
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
                        <td style="width: 3em">
                            <div>
                                ครั้งที่<span class="dotted"> {{ count($examSchedules) }} </span>
                            </div>
                        </td>
                        <td>
                            <div>
                                <input type="checkbox">
                                <label> เห็นชอบ</label>
                            </div>
                        </td>
                        <td>
                            <div>
                                <input type="checkbox">
                                <label> ให้แก้ไขตามที่เสนอแนะ</label>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="4">
                            <div>
                                และอนุมัติให้ทำการศึกษาได้ ตั้งแต่วันที่ ....... เดือน ............... พ.ศ. ............
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
