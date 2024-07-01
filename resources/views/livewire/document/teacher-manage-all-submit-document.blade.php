<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"></h3>
            <div class="card-tools">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <button class="btn btn-primary" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="text-center">
                    <tr>
                        <th style="width: 20%">หัวข้อ</th>
                        <th style="width: 20%">สมาชิก</th>
                        <th style="width: 30%">ที่ปรึกษา</th>
                        <th style="width: 30%">อาจารย์</th>
                        <th style="width: auto">รายละเอียด</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($projects as $projectItems)
                        <tr class="">
                            <td>{{ $projectItems->project_name_th }} <br> {{ $projectItems->project_name_en }}</td>
                            <td>
                                @foreach ($projectItems->confirmStudents as $confirmStudent)
                                    {{ $confirmStudent->student->name }} {{ $confirmStudent->student->surname }}
                                    @if ($confirmStudent->confirm_status == false)
                                        <span class="text-danger"> (ยังไม่ยืนยัน)</span>
                                    @elseif($confirmStudent->confirm_status == true)
                                        <span class="text-success"> (ยืนยันแล้ว)</span>
                                    @endif
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                <span>ที่ปรึกษาหลัก</span><br>
                                @foreach ($projectItems->teachers->where('pivot.id_position', 1) as $teacherItems)
                                    <span>{{ $teacherItems->name }} {{ $teacherItems->surname }}</span>
                                    @if ($teacherItems->confirm_status == false)
                                        <span class="text-danger"> (ยังไม่ยืนยัน)</span>
                                    @elseif ($teacherItems->confirm_status == true)
                                        <span class="text-success"> (ยืนยันแล้ว)</span>
                                    @endif
                                    @unless ($loop->last)
                                        <br>
                                    @endunless
                                @endforeach
                                <br><span>ที่ปรึกษาร่วม</span><br>
                                @foreach ($projectItems->teachers->where('pivot.id_position', 2) as $teacherItems)
                                    <span>{{ $teacherItems->name }} {{ $teacherItems->surname }}</span>
                                    @if ($teacherItems->confirm_status == false)
                                        <span class="text-danger"> (ยังไม่ยืนยัน)</span>
                                    @elseif($teacherItems->confirm_status == true)
                                        <span class="text-success"> (ยืนยันแล้ว)</span>
                                    @endif
                                    @unless ($loop->last)
                                        <br>
                                    @endunless
                                @endforeach
                            </td>
                            <td>
                                @foreach ($projectItems->confirmTeachers as $confirmTeacher)
                                    @if ($confirmTeacher->id_position == 3)
                                        <span>อาจารย์ประจำวิชา</span> {{ $confirmTeacher->teacher->name }}
                                        {{ $confirmTeacher->teacher->surname }}<br>
                                    @elseif($confirmTeacher->id_position == 4)
                                        <span>หัวหน้าสาขา</span> {{ $confirmTeacher->teacher->name }}
                                        {{ $confirmTeacher->teacher->surname }}<br>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @if ($projectItems->confirmStudents->isNotEmpty())
                                    {{ $projectItems->confirmStudents->first()->documents->document }}<br>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

