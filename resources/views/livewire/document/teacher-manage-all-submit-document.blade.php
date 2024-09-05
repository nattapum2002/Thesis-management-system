{{-- <div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"></h3>
            <div class="card-tools">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <button class="btn btn-orange" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @foreach ($projects as $projectItems)
                @foreach ($projectItems->confirmteachers->groupBy('id_document') as $confirm_teacher)
                    @php
                        // Filter the collection to get only those with the specified id_teacher
                        $filteredConfirmTeachers = $confirm_teacher
                            ->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                            ->groupBy('id_document')
                            ->map(function ($teachers) {
                                // Return the first teacher in each group
                                return $teachers->first();
                            });
                    @endphp
                    @if ($filteredConfirmTeachers->isNotEmpty())
                        @foreach ($filteredConfirmTeachers as $documentId => $confirm_teachers)
                            <div class="card mb-3">
                                @switch($documentId)
                                    @case(3)
                                        <div class="card-body">
                                            <div class="nomal-document">
                                                <h5 class="card-title">
                                                    <strong>{{ $confirm_teachers->document->document }} กรรมการสอบ
                                                    </strong> |
                                                    โปรเจค: {{ $projectItems->project_name_th }},
                                                    {{ $projectItems->project_name_en }}
                                                </h5>
                                                <p class="card-text">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <p class="mb-1"><strong>สมาชิก:</strong></p>
                                                        <ul class="list-unstyled mb-3">
                                                            @foreach ($projectItems->confirmStudents->where('id_document', $documentId) as $confirmStudent)
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
                                                    <div class="col-md-3">
                                                        <label class="text-danger">หมายเหตุ : </label>
                                                        @foreach ($projectItems->comments->groupBy('id_document') as $commentId => $commentsGroup)
                                                            <div>
                                                                @foreach ($commentsGroup->where('id_document', $documentId) as $comment)
                                                                    <p class="text-danger">{{ $comment->comment }}</p>
                                                                    <p>โดย:
                                                                        {{ $comment->teacher->name . ' ' . $comment->teacher->surname }}
                                                                    </p>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="">
                                                        @php
                                                            $currentConfirmteacher = $projectItems->confirmTeachers->firstWhere(
                                                                'id_teacher',
                                                                Auth::guard('teachers')->user()->id_teacher,
                                                            );
                                                            $confirmTeacher = $projectItems->confirmTeachers
                                                                ->where(
                                                                    'id_teacher',
                                                                    Auth::guard('teachers')->user()->id_teacher,
                                                                )
                                                                ->where('id_document', $documentId)
                                                                ->first();
                                                        @endphp
                                                        @if ($confirmTeacher?->confirm_status == 1)
                                                            <a class="btn btn-primary disabled" href="#" role="button"
                                                                aria-disabled="true"
                                                                style="pointer-events: none;">อนุมัติแล้ว</a>
                                                        @else
                                                            <button class="btn btn-primary"
                                                                wire:click="teacher_document({{ $confirm_teachers->first()->id_document }}, {{ $projectItems->id_project }})"
                                                                role="button">อนุมัติ
                                                            </button>
                                                        @endif

                                                        @if ($currentConfirmteacher?->id_position == 3 || $currentConfirmteacher?->id_position == 4)
                                                            <button class="btn btn-primary"
                                                                wire:click="document({{ $documentId }}, {{ $projectItems->id_project }})">
                                                                ตรวจสอบ
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                    @break

                                    @case(4)
                                        <div class="card-body">
                                            <div class="nomal-document">
                                                <h5 class="card-title">
                                                    <strong>{{ $confirm_teachers->document->document }}
                                                        แบบขอส่งเค้าโครงของโครงงาน </strong> |
                                                    โปรเจค: {{ $projectItems->project_name_th }},
                                                    {{ $projectItems->project_name_en }}
                                                </h5>
                                                <p class="card-text">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <p class="mb-1"><strong>สมาชิก:</strong></p>
                                                        <ul class="list-unstyled mb-3">
                                                            @foreach ($projectItems->confirmStudents->where('id_document', $documentId) as $confirmStudent)
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
                                                     <div class="col-md-3">
                                                <label class="text-danger">หมายเหตุ : </label>
                                                @foreach ($projectItems->comments->groupBy('id_document') as $commentId => $commentsGroup)
                                                    <div>
                                                        @foreach ($commentsGroup->where('id_document', $documentId) as $comment)
                                                            <p class="text-danger">{{ $comment->comment }}</p>
                                                            <p>โดย:
                                                                {{ $comment->teacher->name . ' ' . $comment->teacher->surname }}
                                                            </p>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                                    <div class="">
                                                        @php
                                                            $currentConfirmteacher = $projectItems->confirmTeachers->firstWhere(
                                                                'id_teacher',
                                                                Auth::guard('teachers')->user()->id_teacher,
                                                            );
                                                        @endphp
                                                        @if ($currentConfirmteacher)
                                                            @if ($projectItems->confirmTeachers->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)->where('id_document', $documentId)->first()->confirm_status == true)
                                                                <a class="btn btn-primary disabled" href="#"
                                                                    role="button" aria-disabled="true"
                                                                    style="pointer-events: none;">อนุมัติแล้ว</a>
                                                            @else
                                                                <button class="btn btn-primary"
                                                                    wire:click="teacher_document({{ $confirm_teachers->first()->id_document }},{{ $projectItems->id_project }})"
                                                                    role="button">อนุมัติ</button>
                                                            @endif

                                                            @if ($currentConfirmteacher->id_position == 3 || $currentConfirmteacher->id_position == 4)
                                                                <button class="btn btn-primary"
                                                                    wire:click="document({{ $documentId }} ,{{ $projectItems->id_project }})">
                                                                    ตรวจสอบ
                                                                </button>
                                                                <button class="btn btn-danger"
                                                                    wire:click="not_approve({{ $documentId }} ,{{ $projectItems->id_project }} ,{{ $currentConfirmteacher->id_teacher }} ,{{ $currentConfirmteacher->id_position }})"
                                                                    role="button">ไม่อนุมัติ</button>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                    @break

                                    @case(6)
                                        <div class="card-body">
                                            <div class="nomal-document">
                                                <h5 class="card-title">
                                                    <strong>{{ $confirm_teachers->document->document }} กรรมการสอบสิ้นสุด
                                                    </strong> |
                                                    โปรเจค: {{ $projectItems->project_name_th }},
                                                    {{ $projectItems->project_name_en }}
                                                </h5>
                                                <p class="card-text">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <p class="mb-1"><strong>สมาชิก:</strong></p>
                                                        <ul class="list-unstyled mb-3">
                                                            @foreach ($projectItems->confirmStudents->where('id_document', $documentId) as $confirmStudent)
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
                                                    <div class="col-md-3">
                                                        <label class="text-danger">หมายเหตุ : </label>
                                                        @foreach ($projectItems->comments->groupBy('id_document') as $commentId => $commentsGroup)
                                                            <div>
                                                                @foreach ($commentsGroup->where('id_document', $documentId) as $comment)
                                                                    <p class="text-danger">{{ $comment->comment }}</p>
                                                                    <p>โดย:
                                                                        {{ $comment->teacher->name . ' ' . $comment->teacher->surname }}
                                                                    </p>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="">
                                                        @php
                                                            $currentConfirmteacher = $projectItems->confirmTeachers->firstWhere(
                                                                'id_teacher',
                                                                Auth::guard('teachers')->user()->id_teacher,
                                                            );
                                                            $confirmTeacher = $projectItems->confirmTeachers
                                                                ->where(
                                                                    'id_teacher',
                                                                    Auth::guard('teachers')->user()->id_teacher,
                                                                )
                                                                ->where('id_document', $documentId)
                                                                ->first();
                                                        @endphp
                                                        @if ($confirmTeacher?->confirm_status == 1)
                                                            <a class="btn btn-primary disabled" href="#" role="button"
                                                                aria-disabled="true"
                                                                style="pointer-events: none;">อนุมัติแล้ว</a>
                                                        @else
                                                            <button class="btn btn-primary"
                                                                wire:click="teacher_document({{ $confirm_teachers->first()->id_document }}, {{ $projectItems->id_project }})"
                                                                role="button">อนุมัติ
                                                            </button>
                                                        @endif

                                                        @if ($currentConfirmteacher?->id_position == 3 || $currentConfirmteacher?->id_position == 4)
                                                            <button class="btn btn-primary"
                                                                wire:click="document({{ $documentId }}, {{ $projectItems->id_project }})">
                                                                ตรวจสอบ
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                    @break

                                    @default
                                        <div class="card-body">
                                            <div class="nomal-document">
                                                <h5 class="card-title">
                                                    <strong>{{ $confirm_teachers->document->document }} </strong> |
                                                    โปรเจค: {{ $projectItems->project_name_th }},
                                                    {{ $projectItems->project_name_en }}
                                                </h5>
                                                <p class="card-text">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <p class="mb-1"><strong>สมาชิก:</strong></p>
                                                        <ul class="list-unstyled mb-3">
                                                            @foreach ($projectItems->confirmStudents->where('id_document', $documentId) as $confirmStudent)
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
                                                    <div class="col-md-3">
                                                        <label class="text-danger">หมายเหตุ : </label>
                                                        @foreach ($projectItems->comments->groupBy('id_document') as $commentId => $commentsGroup)
                                                            <div>
                                                                @foreach ($commentsGroup->where('id_document', $documentId) as $comment)
                                                                    <p class="text-danger">{{ $comment->comment }}</p>
                                                                    <p>โดย:
                                                                        {{ $comment->teacher->name . ' ' . $comment->teacher->surname }}
                                                                    </p>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="">
                                                        @php
                                                            $currentConfirmteacher = $projectItems->confirmTeachers->firstWhere(
                                                                'id_teacher',
                                                                Auth::guard('teachers')->user()->id_teacher,
                                                            );
                                                            $confirmTeacher = $projectItems->confirmTeachers
                                                                ->where(
                                                                    'id_teacher',
                                                                    Auth::guard('teachers')->user()->id_teacher,
                                                                )
                                                                ->where('id_document', $documentId)
                                                                ->first();
                                                        @endphp
                                                        @if ($confirmTeacher?->confirm_status == 1)
                                                            <a class="btn btn-primary disabled" href="#" role="button"
                                                                aria-disabled="true"
                                                                style="pointer-events: none;">อนุมัติแล้ว</a>
                                                        @else
                                                            <button class="btn btn-primary"
                                                                wire:click="teacher_document({{ $confirm_teachers->id_document }}, {{ $projectItems->id_project }})"
                                                                role="button">อนุมัติ
                                                            </button>
                                                        @endif

                                                        @if ($currentConfirmteacher?->id_position == 3 || $currentConfirmteacher?->id_position == 4)
                                                            <button class="btn btn-primary"
                                                                wire:click="document({{ $documentId }}, {{ $projectItems->id_project }})">
                                                                ตรวจสอบ
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                @endswitch
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @endforeach
            <div>
                <form wire:submit.prevent="not_approve_confirmed">
                    <div class="modal fade" id="not_approveModal" tabindex="-1"
                        aria-labelledby="not_approveModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">ไม่อนุมัติ</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row text-center mb-3">
                                        <div class="col-md-2">
                                            <label for="documentInput" class="col-form-label">เอกสาร:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="documentInput"
                                                value="{{ $not_approve_document->document }}" disabled>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="documentInput" class="col-form-label text-center">กลุ่ม:
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="documentInput"
                                                value="{{ $not_approve_project->project_name_th }}" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <input type="checkbox" name=""
                                            wire:model="not_approve_comment1"    id=""><span>มีวุฒิทางการศึกษาไม่เป็นไปตามเกณฑ์</span><br>
                                            <input type="checkbox" name=""
                                            wire:model="not_approve_comment2"    id=""><span>มีจำนวนนักศึกษาที่รับผิดชอบเกินเกณฑ์ที่กำหนดไว้</span><br>
                                            <input type="checkbox" name="" id="other_comment"
                                            wire:model="not_approve_comment3"    wire:click="$dispatch('toggleComment')"><span>อื่นๆ</span>
                                        </div>
                                    </div>
                                    <div class="mb-3" id="">
                                        <label for="message-text" class="col-form-label">หมายเหตุ:</label>
                                        <textarea class="form-control" wire:model="another_comment" id="message-text"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-orange">Send message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<div>
    <section id="teacher-manage-document">
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12 mb-2">
                <input type="text" class="form-control" placeholder="ค้นหาบทความ..."
                    wire:model.live.debounce.150ms="search">
            </div>
        </div>
        @foreach ($projects as $projectItems)
            @foreach ($projectItems->confirmteachers->groupBy('id_document') as $confirm_teacher)
                @php
                    // Filter the collection to get only those with the specified id_teacher
                    $filteredConfirmTeachers = $confirm_teacher
                        ->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                        ->groupBy('id_document')
                        ->map(function ($teachers) {
                            // Return the first teacher in each group
                            return $teachers->first();
                        });
                @endphp
                @if ($filteredConfirmTeachers->isNotEmpty())
                    @foreach ($filteredConfirmTeachers as $documentId => $confirm_teachers)
                        <div class="card">
                            @switch($documentId)
                                @case(3)
                                    <div class="card-header">
                                        <h5>
                                            {{ 'คกท.-คง.-0' . $confirm_teachers->document->id_document . ' | ' . $confirm_teachers->document->document }}
                                        </h5>
                                        <span>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <fieldset>
                                                    <legend>สมาชิก</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmStudents->where('id_document', $documentId) as $confirmStudent)
                                                            <li>
                                                                {{ $confirmStudent->student->name . ' ' . $confirmStudent->student->surname }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <fieldset>
                                                    <legend>ที่ปรึกษาหลัก</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 1)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <fieldset>
                                                    <legend>ประธานกรรมการ</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 5)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>กรรมการ</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 6)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>กรรมการและเลขานุการ</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 7)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <fieldset>
                                                    <legend>หัวหน้าสาขา</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 4)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>อาจารย์ประจำวิชา</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 3)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                            </div>
                                            <div class="col-12">
                                                <fieldset>
                                                    <legend>หมายเหตุ</legend>
                                                    <ul>
                                                        @foreach ($projectItems->comments->groupBy('id_document') as $commentId => $commentsGroup)
                                                            @foreach ($commentsGroup->where('id_document', $documentId) as $comment)
                                                                <li>
                                                                    <span>
                                                                        {{ $comment->comment . ' โดย ' . $comment->teacher->name . ' ' . $comment->teacher->surname }}
                                                                    </span>
                                                                </li>
                                                            @endforeach
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                @php
                                                    $currentConfirmteacher = $projectItems->confirmTeachers->firstWhere(
                                                        'id_teacher',
                                                        Auth::guard('teachers')->user()->id_teacher,
                                                    );
                                                    $confirmTeacher = $projectItems->confirmTeachers
                                                        ->where(
                                                            'id_teacher',
                                                            Auth::guard('teachers')->user()->id_teacher,
                                                        )
                                                        ->where('id_document', $documentId)
                                                        ->first();
                                                @endphp
                                                @if ($confirmTeacher?->confirm_status == 1)
                                                    <a class="btn btn-primary disabled" href="#" role="button"
                                                        aria-disabled="true" style="pointer-events: none;">อนุมัติแล้ว</a>
                                                @else
                                                    <button class="btn btn-primary"
                                                        wire:click="teacher_document({{ $confirm_teachers->first()->id_document }}, {{ $projectItems->id_project }})"
                                                        role="button">อนุมัติ
                                                    </button>
                                                @endif

                                                @if ($currentConfirmteacher->id_position == 3 || $currentConfirmteacher?->id_position == 4)
                                                    <button class="btn btn-primary"
                                                        wire:click="document({{ $documentId }}, {{ $projectItems->id_project }})">
                                                        ตรวจสอบ
                                                    </button>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                @break

                                @case(4)
                                    <div class="card-header">
                                        <h5>
                                            {{ 'คกท.-คง.-0' . $confirm_teachers->document->id_document . ' | ' . $confirm_teachers->document->document }}
                                        </h5>
                                        <span>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <fieldset>
                                                    <legend>สมาชิก</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmStudents->where('id_document', $documentId) as $confirmStudent)
                                                            <li>
                                                                {{ $confirmStudent->student->name . ' ' . $confirmStudent->student->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmStudent->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <fieldset>
                                                    <legend>ที่ปรึกษาหลัก</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 1)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>ที่ปรึกษาร่วม</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 2)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <fieldset>
                                                    <legend>ประธานกรรมการ</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 5)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>กรรมการ</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 6)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>กรรมการและเลขานุการ</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 7)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <fieldset>
                                                    <legend>หัวหน้าสาขา</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 4)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>อาจารย์ประจำวิชา</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 3)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                            </div>
                                            <div class="col-12">
                                                <fieldset>
                                                    <legend>หมายเหตุ</legend>
                                                    <ul>
                                                        @foreach ($projectItems->comments->groupBy('id_document') as $commentId => $commentsGroup)
                                                            @foreach ($commentsGroup->where('id_document', $documentId) as $comment)
                                                                <li>
                                                                    <span>
                                                                        {{ $comment->comment . ' โดย ' . $comment->teacher->name . ' ' . $comment->teacher->surname }}
                                                                    </span>
                                                                </li>
                                                            @endforeach
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                @php
                                                    $currentConfirmteacher = $projectItems->confirmTeachers->firstWhere(
                                                        'id_teacher',
                                                        Auth::guard('teachers')->user()->id_teacher,
                                                    );
                                                    $confirmTeacherStatus = $projectItems->confirmTeachers
                                                        ->where(
                                                            'id_teacher',
                                                            Auth::guard('teachers')->user()->id_teacher,
                                                        )
                                                        ->where('id_document', $documentId)
                                                        ->first()?->confirm_status;
                                                @endphp

                                                @if ($currentConfirmteacher)
                                                    @if ($confirmTeacherStatus)
                                                        <a class="btn btn-primary disabled" href="#" role="button"
                                                            aria-disabled="true" style="pointer-events: none;">อนุมัติแล้ว</a>
                                                    @else
                                                        <button class="btn btn-success"
                                                            wire:click="teacher_document({{ $documentId }}, {{ $projectItems->id_project }})"
                                                            role="button">อนุมัติ</button>
                                                    @endif

                                                    @if (in_array($currentConfirmteacher->id_position, [3, 4]))
                                                        <button class="btn btn-primary"
                                                            wire:click="document({{ $documentId }}, {{ $projectItems->id_project }})">
                                                            ตรวจสอบ
                                                        </button>
                                                        <button class="btn btn-danger"
                                                            wire:click="not_approve({{ $documentId }}, {{ $projectItems->id_project }}, {{ $currentConfirmteacher->id_teacher }}, {{ $currentConfirmteacher->id_position }})"
                                                            role="button">ไม่อนุมัติ</button>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @break

                                @case(6)
                                    <div class="card-header">
                                        <h5>
                                            {{ 'คกท.-คง.-0' . $confirm_teachers->document->id_document . ' | ' . $confirm_teachers->document->document }}
                                        </h5>
                                        <span>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <fieldset>
                                                    <legend>สมาชิก</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmStudents->where('id_document', $documentId) as $confirmStudent)
                                                            <li>
                                                                {{ $confirmStudent->student->name . ' ' . $confirmStudent->student->surname }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <fieldset>
                                                    <legend>ที่ปรึกษาหลัก</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 1)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <fieldset>
                                                    <legend>ประธานกรรมการ</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 5)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>กรรมการ</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 6)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>กรรมการและเลขานุการ</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 7)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <fieldset>
                                                    <legend>หัวหน้าสาขา</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 4)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>อาจารย์ประจำวิชา</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 3)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                            </div>
                                            <div class="col-12">
                                                <fieldset>
                                                    <legend>หมายเหตุ</legend>
                                                    <ul>
                                                        @foreach ($projectItems->comments->groupBy('id_document') as $commentId => $commentsGroup)
                                                            @foreach ($commentsGroup->where('id_document', $documentId) as $comment)
                                                                <li>
                                                                    <span>
                                                                        {{ $comment->comment . ' โดย ' . $comment->teacher->name . ' ' . $comment->teacher->surname }}
                                                                    </span>
                                                                </li>
                                                            @endforeach
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                @php
                                                    $teacherId = Auth::guard('teachers')->user()->id_teacher;
                                                    $confirmTeacher = $projectItems->confirmTeachers
                                                        ->where('id_teacher', $teacherId)
                                                        ->where('id_document', $documentId)
                                                        ->first();
                                                @endphp

                                                @if ($confirmTeacher?->confirm_status == 1)
                                                    <a class="btn btn-primary disabled" href="#" role="button"
                                                        aria-disabled="true" style="pointer-events: none;">อนุมัติแล้ว</a>
                                                @else
                                                    <button class="btn btn-primary"
                                                        wire:click="teacher_document({{ $confirmTeacher?->id_document }}, {{ $projectItems->id_project }})"
                                                        role="button">อนุมัติ
                                                    </button>
                                                @endif

                                                @if (in_array($confirmTeacher?->id_position, [3, 4]))
                                                    <button class="btn btn-primary"
                                                        wire:click="document({{ $documentId }}, {{ $projectItems->id_project }})">
                                                        ตรวจสอบ
                                                    </button>
                                                @endif
                                                    <button class="btn btn-primary" wire:click="create_document_07({{$projectItems->id_project}})">
                                                        สร้างเอกสาร 07 
                                                    </button>
                                            </div>
                                        </div>
                                    </div>
                                @break

                                @default
                                    <div class="card-header">
                                        <h5>
                                            {{ 'คกท.-คง.-0' . $confirm_teachers->document->id_document . ' | ' . $confirm_teachers->document->document }}
                                        </h5>
                                        <span>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <fieldset>
                                                    <legend>สมาชิก</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmStudents->where('id_document', $documentId) as $confirmStudent)
                                                            <li>
                                                                {{ $confirmStudent->student->name . ' ' . $confirmStudent->student->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmStudent->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <fieldset>
                                                    <legend>ที่ปรึกษาหลัก</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 1)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>ที่ปรึกษาร่วม</legend>
                                                    <ul>
                                                        @foreach ($projectItems->confirmTeachers->where('id_position', 2)->where('id_document', $documentId) as $confirmTeacher)
                                                            <li>
                                                                {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                <i
                                                                    class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-6 col-sm-12">
                                                        <fieldset>
                                                            <legend>หัวหน้าสาขา</legend>
                                                            <ul>
                                                                @foreach ($projectItems->confirmTeachers->where('id_position', 4)->where('id_document', $documentId) as $confirmTeacher)
                                                                    <li>
                                                                        {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                        <i
                                                                            class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-12 col-md-6 col-sm-12">
                                                        <fieldset>
                                                            <legend>อาจารย์ประจำวิชา</legend>
                                                            <ul>
                                                                @foreach ($projectItems->confirmTeachers->where('id_position', 3)->where('id_document', $documentId) as $confirmTeacher)
                                                                    <li>
                                                                        {{ $confirmTeacher->teacher->name . ' ' . $confirmTeacher->teacher->surname }}
                                                                        <i
                                                                            class="bx bxs-{{ $confirmTeacher->confirm_status ? 'check-circle' : 'x-circle' }}"></i>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <fieldset>
                                                    <legend>หมายเหตุ</legend>
                                                    <ul>
                                                        @foreach ($projectItems->comments->groupBy('id_document') as $commentId => $commentsGroup)
                                                            @foreach ($commentsGroup->where('id_document', $documentId) as $comment)
                                                                <li>
                                                                    <span>
                                                                        {{ $comment->comment . ' โดย ' . $comment->teacher->name . ' ' . $comment->teacher->surname }}
                                                                    </span>
                                                                </li>
                                                            @endforeach
                                                        @endforeach
                                                    </ul>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                @php
                                                    $teacherId = Auth::guard('teachers')->user()->id_teacher;
                                                    $confirmTeacher = $projectItems->confirmTeachers
                                                        ->where('id_teacher', $teacherId)
                                                        ->where('id_document', $documentId)
                                                        ->first();
                                                @endphp

                                                @if ($confirmTeacher?->confirm_status == 1)
                                                    <a class="btn btn-primary disabled" href="#" role="button"
                                                        aria-disabled="true" style="pointer-events: none;">อนุมัติแล้ว</a>
                                                @else
                                                    <button class="btn btn-success"
                                                        wire:click="teacher_document({{ $confirmTeacher->id_document }}, {{ $projectItems->id_project }})"
                                                        role="button">อนุมัติ
                                                    </button>
                                                @endif

                                                @if (in_array($confirmTeacher?->id_position, [3, 4]))
                                                    <button class="btn btn-primary"
                                                        wire:click="document({{ $documentId }}, {{ $projectItems->id_project }})">
                                                        ตรวจสอบ
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                            @endswitch
                        </div>
                    @endforeach
                @endif
            @endforeach
        @endforeach
        {{-- <form wire:submit.prevent="not_approve_confirmed">
            <div class="modal fade" id="not_approveModal" tabindex="-1" aria-labelledby="not_approveModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">ไม่อนุมัติ</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row text-center mb-3">
                                <div class="col-md-2">
                                    <label for="documentInput" class="col-form-label">เอกสาร:</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="documentInput"
                                        value="{{ $not_approve_document->document }}" disabled>
                                </div>
                                <div class="col-md-2">
                                    <label for="documentInput" class="col-form-label text-center">กลุ่ม:
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="documentInput"
                                        value="{{ $not_approve_project->project_name_th }}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="checkbox" name="" wire:model="not_approve_comment1"
                                        id=""><span>มีวุฒิทางการศึกษาไม่เป็นไปตามเกณฑ์</span><br>
                                    <input type="checkbox" name="" wire:model="not_approve_comment2"
                                        id=""><span>มีจำนวนนักศึกษาที่รับผิดชอบเกินเกณฑ์ที่กำหนดไว้</span><br>
                                    <input type="checkbox" name="" id="other_comment"
                                        wire:model="not_approve_comment3"
                                        wire:click="$dispatch('toggleComment')"><span>อื่นๆ</span>
                                </div>
                            </div>
                            <div class="mb-3" id="">
                                <label for="message-text" class="col-form-label">หมายเหตุ:</label>
                                <textarea class="form-control" wire:model="another_comment" id="message-text"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-orange">Send message</button>
                        </div>
                    </div>
                </div>
            </div>
        </form> --}}
    </section>
</div>
