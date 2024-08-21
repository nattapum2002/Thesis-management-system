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
            @foreach ($projects as $projectItems)
                @foreach ($projectItems->confirmStudents->groupBy('id_document') as $documentId => $confirmStudents)
                    <div class="card mb-3">
                        @switch($documentId)
                            @case(3)
                            <div class="card-body">
                                <div class="unnormal-document">
                                    <h5 class="card-title">
                                        <strong>{{ $confirmStudents->first()->documents->document }} กรรมการสอบ</strong> |
                                        โปรเจค: {{ $projectItems->project_name_th }}, {{ $projectItems->project_name_en }}
                                    </h5>
                                    <p class="card-text">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p class="mb-1"><strong>สมาชิก:</strong></p>
                                            <ul class="list-unstyled mb-3">
                                                @foreach ($confirmStudents as $confirmStudent)
                                                    <li>
                                                        {{ $confirmStudent->student->name }}
                                                        {{ $confirmStudent->student->surname }}
                                                        {{-- @if ($confirmStudent->confirm_status == false)
                                                            <span class="badge bg-danger">ยังไม่ตอบรับ</span>
                                                        @else
                                                            <span class="badge bg-success">ตอบรับแล้ว</span>
                                                        @endif --}}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="mb-1"><strong>ที่ปรึกษาหลัก:</strong></p>
                                            <ul class="list-unstyled mb-3">
                                                @foreach ($projectItems->confirmTeachers->where('id_position', 1)->where('id_document', $documentId) as $teacherItems)
                                                    <li>
                                                        <span>{{ $teacherItems->teacher->name }}
                                                            {{ $teacherItems->teacher->surname }}</span>
                                                        @if ($teacherItems->confirm_status == false)
                                                            <span class="badge bg-danger">ยังไม่ตอบรับ</span>
                                                        @elseif ($teacherItems->confirm_status == true)
                                                            <span class="badge bg-success">ตอบรับแล้ว</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <p class="mb-1"><strong>ประธานกรรมการ:</strong></p>
                                            <ul class="list-unstyled mb-3">
                                                @foreach ($projectItems->confirmTeachers->where('id_position', 5)->where('id_document', $documentId) as $teacherItems)
                                                    <li>
                                                        <span>{{ $teacherItems->teacher->name }}
                                                            {{ $teacherItems->teacher->surname }}</span>
                                                        @if ($teacherItems->confirm_status == false)
                                                            <span class="badge bg-danger">ยังไม่ตอบรับ</span>
                                                        @elseif ($teacherItems->confirm_status == true)
                                                            <span class="badge bg-success">ตอบรับแล้ว</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <p class="mb-1"><strong>กรรมการ:</strong></p>
                                            <ul class="list-unstyled mb-3">
                                                @foreach ($projectItems->confirmTeachers->where('id_position', 6)->where('id_document', $documentId) as $teacherItems)
                                                    <li>
                                                        <span>{{ $teacherItems->teacher->name }}
                                                            {{ $teacherItems->teacher->surname }}</span>
                                                        @if ($teacherItems->confirm_status == false)
                                                            <span class="badge bg-danger">ยังไม่ตอบรับ</span>
                                                        @elseif ($teacherItems->confirm_status == true)
                                                            <span class="badge bg-success">ตอบรับแล้ว</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="mb-1"><strong>หัวหน้าสาขา</strong></p>
                                            <ul class="list-unstyled mb-3">
                                                @foreach ($projectItems->confirmTeachers->where('id_position', 4)->where('id_document', $documentId) as $confirmTeacher)
                                                    <li>
                                                        <span>{{ $confirmTeacher->teacher->name }}
                                                            {{ $confirmTeacher->teacher->surname }}</span>
                                                        @if ($confirmTeacher->confirm_status == false)
                                                            <span class="badge bg-danger">ยังไม่ตอบรับ</span>
                                                        @elseif ($confirmTeacher->confirm_status == true)
                                                            <span class="badge bg-success">ตอบรับแล้ว</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <p class="mb-1"><strong>อาจารย์ประจำวิชา</strong></p>
                                            <ul class="list-unstyled mb-3">
                                                @foreach ($projectItems->confirmTeachers->where('id_position', 3)->where('id_document', $documentId) as $confirmTeacher)
                                                    <li>
                                                        <span>{{ $confirmTeacher->teacher->name }}
                                                            {{ $confirmTeacher->teacher->surname }}</span>
                                                        @if ($confirmTeacher->confirm_status == false)
                                                            <span class="badge bg-danger">ยังไม่ตอบรับ</span>
                                                        @elseif ($confirmTeacher->confirm_status == true)
                                                            <span class="badge bg-success">ตอบรับแล้ว</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    </p>
                                </div>
                            </div>
                                @break
                            @case(4)
                            <div class="card-body">
                                <div class="unnormal-document">
                                    <h5 class="card-title">
                                        <strong>{{ $confirmStudents->first()->documents->document }} แบบขอส่งเค้าโครงของโครงงาน</strong> |
                                        โปรเจค: {{ $projectItems->project_name_th }}, {{ $projectItems->project_name_en }}
                                    </h5>
                                    <p class="card-text">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p class="mb-1"><strong>สมาชิก:</strong></p>
                                            <ul class="list-unstyled mb-3">
                                                @foreach ($confirmStudents as $confirmStudent)
                                                    <li>
                                                        {{ $confirmStudent->student->name }}
                                                        {{ $confirmStudent->student->surname }}
                                                        @if ($confirmStudent->confirm_status == false)
                                                            <span class="badge bg-danger">ยังไม่ตอบรับ</span>
                                                        @else
                                                            <span class="badge bg-success">ตอบรับแล้ว</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="mb-1"><strong>ที่ปรึกษาหลัก:</strong></p>
                                            <ul class="list-unstyled mb-3">
                                                @foreach ($projectItems->confirmTeachers->where('id_position', 1)->where('id_document', $documentId) as $teacherItems)
                                                    <li>
                                                        <span>{{ $teacherItems->teacher->name }}
                                                            {{ $teacherItems->teacher->surname }}</span>
                                                        @if ($teacherItems->confirm_status == false)
                                                            <span class="badge bg-danger">ยังไม่ตอบรับ</span>
                                                        @elseif ($teacherItems->confirm_status == true)
                                                            <span class="badge bg-success">ตอบรับแล้ว</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <p class="mb-1"><strong>ที่ปรึกษาร่วม:</strong></p>
                                            <ul class="list-unstyled mb-3">
                                                @foreach ($projectItems->confirmTeachers->where('id_position', 2)->where('id_document', $documentId) as $teacherItems)
                                                    <li>
                                                        <span>{{ $teacherItems->teacher->name }}
                                                            {{ $teacherItems->teacher->surname }}</span>
                                                        @if ($teacherItems->confirm_status == false)
                                                            <span class="badge bg-danger">ยังไม่ตอบรับ</span>
                                                        @elseif ($teacherItems->confirm_status == true)
                                                            <span class="badge bg-success">ตอบรับแล้ว</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                            
                                        </div>
                                        <div class="col-md-3">
                                            <p class="mb-1"><strong>ประธานกรรมการ:</strong></p>
                                            <ul class="list-unstyled mb-3">
                                                @foreach ($projectItems->confirmTeachers->where('id_position', 5)->where('id_document', $documentId) as $teacherItems)
                                                    <li>
                                                        <span>{{ $teacherItems->teacher->name }}
                                                            {{ $teacherItems->teacher->surname }}</span>
                                                        @if ($teacherItems->confirm_status == false)
                                                            <span class="badge bg-danger">ยังไม่ตอบรับ</span>
                                                        @elseif ($teacherItems->confirm_status == true)
                                                            <span class="badge bg-success">ตอบรับแล้ว</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <p class="mb-1"><strong>กรรมการ:</strong></p>
                                            <ul class="list-unstyled mb-3">
                                                @foreach ($projectItems->confirmTeachers->where('id_position', 6)->where('id_document', $documentId) as $teacherItems)
                                                    <li>
                                                        <span>{{ $teacherItems->teacher->name }}
                                                            {{ $teacherItems->teacher->surname }}</span>
                                                        @if ($teacherItems->confirm_status == false)
                                                            <span class="badge bg-danger">ยังไม่ตอบรับ</span>
                                                        @elseif ($teacherItems->confirm_status == true)
                                                            <span class="badge bg-success">ตอบรับแล้ว</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <p class="mb-1"><strong>เลขานุการ:</strong></p>
                                            <ul class="list-unstyled mb-3">
                                                @foreach ($projectItems->confirmTeachers->where('id_position', 7)->where('id_document', $documentId) as $teacherItems)
                                                    <li>
                                                        <span>{{ $teacherItems->teacher->name }}
                                                            {{ $teacherItems->teacher->surname }}</span>
                                                        @if ($teacherItems->confirm_status == false)
                                                            <span class="badge bg-danger">ยังไม่ตอบรับ</span>
                                                        @elseif ($teacherItems->confirm_status == true)
                                                            <span class="badge bg-success">ตอบรับแล้ว</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="mb-1"><strong>หัวหน้าสาขา</strong></p>
                                            <ul class="list-unstyled mb-3">
                                                @foreach ($projectItems->confirmTeachers->where('id_position', 4)->where('id_document', $documentId) as $confirmTeacher)
                                                    <li>
                                                        <span>{{ $confirmTeacher->teacher->name }}
                                                            {{ $confirmTeacher->teacher->surname }}</span>
                                                        @if ($confirmTeacher->confirm_status == false)
                                                            <span class="badge bg-danger">ยังไม่ตอบรับ</span>
                                                        @elseif ($confirmTeacher->confirm_status == true)
                                                            <span class="badge bg-success">ตอบรับแล้ว</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <p class="mb-1"><strong>อาจารย์ประจำวิชา</strong></p>
                                            <ul class="list-unstyled mb-3">
                                                @foreach ($projectItems->confirmTeachers->where('id_position', 3)->where('id_document', $documentId) as $confirmTeacher)
                                                    <li>
                                                        <span>{{ $confirmTeacher->teacher->name }}
                                                            {{ $confirmTeacher->teacher->surname }}</span>
                                                        @if ($confirmTeacher->confirm_status == false)
                                                            <span class="badge bg-danger">ยังไม่ตอบรับ</span>
                                                        @elseif ($confirmTeacher->confirm_status == true)
                                                            <span class="badge bg-success">ตอบรับแล้ว</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="">
                                            <form
                                                wire:submit="confirmDocument({{ $confirmStudents->first()->id_document }},{{ $projectItems->id_project }})">
                                                @php
                                                    $currentConfirmStudent = $confirmStudents->firstWhere(
                                                        'id_student',
                                                        Auth::guard('members')->user()->id_student,
                                                    );
                                                @endphp
    
                                                @if ($currentConfirmStudent)
                                                    @if ($currentConfirmStudent->confirm_status == true)
                                                        <a class="btn btn-primary disabled" href="#" role="button"
                                                            aria-disabled="true"
                                                            style="pointer-events: none;">ยืนยันแล้ว</a>
                                                    @else
                                                        <button class="btn btn-primary" type="submit"
                                                            role="button">ยืนยัน</button>
                                                    @endif
                                                @endif
                                                <a class="btn btn-danger" href="">ปฏิเสธ</a>
                                                {{-- @if (
                                                    $confirmStudents->every(fn($student) => $student->confirm_status == true) &&
                                                        $projectItems->confirmTeachers->where('id_document', $documentId)->where('id_project', $projectItems->id_project)->every(fn($teacher) => $teacher->confirm_status == true))
                                                    @switch($documentId)
                                                        @case(1)
                                                            <a class="btn btn-primary"
                                                                href="{{ route('create_document_02') }}">สร้างเอกสาร 02</a>
                                                        @break
    
                                                        @case(2)
                                                        @break
    
                                                        @default
                                                    @endswitch
                                                @else
                                                    @switch($documentId)
                                                        @case(1)
                                                            <button class="btn btn-primary" disabled>สร้างเอกสาร 02</button>
                                                        @break
    
                                                        @case(2)
                                                        @break
    
                                                        @default
                                                    @endswitch
                                                @endif --}}
                                            </form>
                                        </div>
                                    </div>
                                    </p>
                                </div>
                            </div>
                            @break

                            @default
                            <div class="card-body">
                                <div class="normal-document">
                                    <h5 class="card-title">
                                        <strong>{{ $confirmStudents->first()->documents->document }}</strong> |
                                        โปรเจค: {{ $projectItems->project_name_th }}, {{ $projectItems->project_name_en }}
                                    </h5>
                                    <p class="card-text">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p class="mb-1"><strong>สมาชิก:</strong></p>
                                            <ul class="list-unstyled mb-3">
                                                @foreach ($confirmStudents as $confirmStudent)
                                                    <li>
                                                        {{ $confirmStudent->student->name }}
                                                        {{ $confirmStudent->student->surname }}
                                                        @if ($confirmStudent->confirm_status == false)
                                                            <span class="badge bg-danger">ยังไม่ตอบรับ</span>
                                                        @else
                                                            <span class="badge bg-success">ตอบรับแล้ว</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="mb-1"><strong>ที่ปรึกษาหลัก:</strong></p>
                                            <ul class="list-unstyled mb-3">
                                                @foreach ($projectItems->confirmTeachers->where('id_position', 1)->where('id_document', $documentId) as $teacherItems)
                                                    <li>
                                                        <span>{{ $teacherItems->teacher->name }}
                                                            {{ $teacherItems->teacher->surname }}</span>
                                                        @if ($teacherItems->confirm_status == false)
                                                            <span class="badge bg-danger">ยังไม่ตอบรับ</span>
                                                        @elseif ($teacherItems->confirm_status == true)
                                                            <span class="badge bg-success">ตอบรับแล้ว</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <p class="mb-1"><strong>ที่ปรึกษาร่วม:</strong></p>
                                            <ul class="list-unstyled mb-3">
                                                @foreach ($projectItems->confirmTeachers->where('id_position', 2)->where('id_document', $documentId) as $teacherItems)
                                                    <li>
                                                        <span>{{ $teacherItems->teacher->name }}
                                                            {{ $teacherItems->teacher->surname }}</span>
                                                        @if ($teacherItems->confirm_status == false)
                                                            <span class="badge bg-danger">ยังไม่ตอบรับ</span>
                                                        @elseif ($teacherItems->confirm_status == true)
                                                            <span class="badge bg-success">ตอบรับแล้ว</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="mb-1"><strong>หัวหน้าสาขา</strong></p>
                                            <ul class="list-unstyled mb-3">
                                                @foreach ($projectItems->confirmTeachers->where('id_position', 4)->where('id_document', $documentId) as $confirmTeacher)
                                                    <li>
                                                        <span>{{ $confirmTeacher->teacher->name }}
                                                            {{ $confirmTeacher->teacher->surname }}</span>
                                                        @if ($confirmTeacher->confirm_status == false)
                                                            <span class="badge bg-danger">ยังไม่ตอบรับ</span>
                                                        @elseif ($confirmTeacher->confirm_status == true)
                                                            <span class="badge bg-success">ตอบรับแล้ว</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <p class="mb-1"><strong>อาจารย์ประจำวิชา</strong></p>
                                            <ul class="list-unstyled mb-3">
                                                @foreach ($projectItems->confirmTeachers->where('id_position', 3)->where('id_document', $documentId) as $confirmTeacher)
                                                    <li>
                                                        <span>{{ $confirmTeacher->teacher->name }}
                                                            {{ $confirmTeacher->teacher->surname }}</span>
                                                        @if ($confirmTeacher->confirm_status == false)
                                                            <span class="badge bg-danger">ยังไม่ตอบรับ</span>
                                                        @elseif ($confirmTeacher->confirm_status == true)
                                                            <span class="badge bg-success">ตอบรับแล้ว</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="">
                                            <form
                                                wire:submit="confirmDocument({{ $confirmStudents->first()->id_document }},{{ $projectItems->id_project }})">
                                                @php
                                                    $currentConfirmStudent = $confirmStudents->firstWhere(
                                                        'id_student',
                                                        Auth::guard('members')->user()->id_student,
                                                    );
                                                @endphp
    
                                                @if ($currentConfirmStudent)
                                                    @if ($currentConfirmStudent->confirm_status == true)
                                                        <a class="btn btn-primary disabled" href="#" role="button"
                                                            aria-disabled="true"
                                                            style="pointer-events: none;">ยืนยันแล้ว</a>
                                                    @else
                                                        <button class="btn btn-primary" type="submit"
                                                            role="button">ยืนยัน</button>
                                                    @endif
                                                @endif
                                                <a class="btn btn-danger" href="">ปฏิเสธ</a>
                                                @if (
                                                    $confirmStudents->every(fn($student) => $student->confirm_status == true) &&
                                                        $projectItems->confirmTeachers->where('id_document', $documentId)->where('id_project', $projectItems->id_project)->every(fn($teacher) => $teacher->confirm_status == true))
                                                    @switch($documentId)
                                                        @case(1)
                                                            <a class="btn btn-primary"
                                                                href="{{ route('create_document_02') }}">สร้างเอกสาร 02</a>
                                                        @break
    
                                                        @case(2)
                                                        @break
    
                                                        @default
                                                    @endswitch
                                                @else
                                                    @switch($documentId)
                                                        @case(1)
                                                            <button class="btn btn-primary" disabled>สร้างเอกสาร 02</button>
                                                        @break
    
                                                        @case(2)
                                                        @break
    
                                                        @default
                                                    @endswitch
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                    </p>
                                </div>
                            </div>

                        @endswitch
                        
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</div>
{{-- <table class="table">
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
                            <span>อาจารย์ประจำวิชา</span><br>
                            <span>{{ $confirmTeacher->teacher->name }} {{ $confirmTeacher->teacher->surname }}</span>
                            @if ($confirmTeacher->confirm_status == false)
                            <span class="text-danger"> (ยังไม่ยืนยัน)</span><br>
                            @elseif($confirmTeacher->confirm_status == true)
                            <span class="text-success"> (ยืนยันแล้ว)</span><br>
                            @endif
                        @elseif($confirmTeacher->id_position == 4)
                            <span>หัวหน้าสาขา</span><br> <span>{{ $confirmTeacher->teacher->name }}
                            {{ $confirmTeacher->teacher->surname }}</span>
                            @if ($confirmTeacher->confirm_status == false)
                            <span class="text-danger"> (ยังไม่ยืนยัน)</span><br>
                            @elseif($confirmTeacher->confirm_status == true)
                            <span class="text-success"> (ยืนยันแล้ว)</span><br>
                            @endif
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
</table> --}}
