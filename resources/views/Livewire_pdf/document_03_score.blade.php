<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('Asset/main/img/logo/favicon.png') }}" type="image/png">
    <title>Document PDF</title>
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
                <br>แบบรายงานผลการสอบหัวข้อโครงงาน
                <br>-----------------------------------
            </div>
        </header>
        @foreach ($projects as $project)
            <div>
                <table>
                    @foreach ($project->confirmStudents->unique('id_student') as $confirmStudent)
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
                            <td></td>
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
                    <tr>
                        <td style="width: 60%; text-align: left;">หัวข้อพิจารณา</td>
                        <td style="width: 10%;">คะแนน</td>
                        <td style="width: 10%;">คนที่ 1</td>
                        <td style="width: 10%;">คนที่ 2</td>
                        <td style="width: 10%;">คนที่ 3</td>
                    </tr>
                    @foreach ($criterias as $index => $criterion)
                        <tr>
                            <td>{!! $criterion['name'] !!}</td>
                            <td>{{ $criterion['score'] }}</td>
                            <td>{{ $score_director_1[$index] ?? '' }}</td>
                            <td>{{ $score_director_2[$index] ?? '' }}</td>
                            <td>{{ $score_director_3[$index] ?? '' }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td style="text-align: right;">รวม</td>
                        <td>100</td>
                        <td>{{ $total_score_director_1 }}</td>
                        <td>{{ $total_score_director_2 }}</td>
                        <td>{{ $total_score_director_3 }}</td>
                    </tr>
                </table>
            </div>
            <div>
                <table>
                    <tr>
                        <td colspan="10">
                            <div>3. สรุปผลการสอบ</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 1.8em"></td>
                        <td colspan="9">
                            <div>
                                <input type="checkbox"{{ $approve == true ? 'checked' : '' }}>
                                <label> ผ่าน</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="9">
                            <div>
                                <input type="checkbox" {{ $approve_fix == true ? 'checked' : '' }}>
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
                            @if ($approve_fix == true)
                                <div>
                                    <span class="dotted">
                                        {{ $approve_fix_comment }}
                                    </span>
                                </div>
                            @else
                                <div>
                                    .........................................................................................................................
                                    <br>.........................................................................................................................
                                    <br>.........................................................................................................................
                                    <br>.........................................................................................................................
                                </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="9">
                            <div>
                                <input type="checkbox" {{ $not_approve == true ? 'checked' : '' }}>
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
                            @if ($not_approve == true)
                                <div>
                                    <span class="dotted">
                                        {{ $not_approve_comment }}
                                    </span>
                                </div>
                            @else
                                <div>
                                    .........................................................................................................................
                                    <br>.........................................................................................................................
                                    <br>.........................................................................................................................
                                    <br>.........................................................................................................................
                                </div>
                            @endif
                        </td>
                    </tr>
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
                                    ลงชื่อ
                                    {{ $teachers->where('id_position', 5)->first()->teacher->name . ' ' . $teachers->where('id_position', 5)->first()->teacher->surname }}
                                    ประธานกรรมการ
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
                                        ลงชื่อ {{ $directors->teacher->name . ' ' . $directors->teacher->surname }}
                                        กรรมการ
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
                                    ลงชื่อ
                                    {{ $teachers->where('id_position', 7)->first()->teacher->name . ' ' . $teachers->where('id_position', 7)->first()->teacher->surname }}
                                    กรรมการและเลขานุการ (อาจารย์ที่ปรึกษา)
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
                                    ลงชื่อ
                                    {{ $teachers->where('id_position', 3)->first()->teacher->name . ' ' . $teachers->where('id_position', 3)->first()->teacher->surname }}
                                    อาจารย์ประจำวิชา
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
