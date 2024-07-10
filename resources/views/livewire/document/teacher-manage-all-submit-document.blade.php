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
                @foreach ($projectItems->confirmteachers->groupBy('id_document') as $documentId => $confirm_teachers)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                <strong>{{ $confirm_teachers->first()->document->document }}</strong> |
                                โปรเจค: {{ $projectItems->project_name_th }}, {{ $projectItems->project_name_en }}
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
                                        @foreach ($projectItems->confirmTeachers->where('id_position', 1) as $teacherItems)
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
                                        @foreach ($projectItems->confirmTeachers->where('id_position', 2) as $teacherItems)
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
                                        @foreach ($projectItems->confirmTeachers->where('id_position', 4) as $confirmTeacher)
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
                                        wire:submit="teacher_document({{ $confirm_teachers->first()->id_document }},{{ $projectItems->id_project }})">
                                        @php
                                            $currentConfirmteacher = $projectItems->confirmTeachers->firstWhere(
                                                'id_teacher',
                                                Auth::guard('teachers')->user()->id_teacher,
                                            );
                                        @endphp

                                        @if ($currentConfirmteacher)
                                            @if ($projectItems->confirmTeachers->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)->where('id_document', $documentId)->every(fn($teacher) => $teacher->confirm_status == true))
                                                <a class="btn btn-primary disabled" href="#" role="button"
                                                    aria-disabled="true" style="pointer-events: none;">อนุมัติแล้ว</a>
                                            @else
                                                <button class="btn btn-primary" type="submit"
                                                    role="button">อนุมัติ</button>
                                            @endif

                                            @if ($currentConfirmteacher->id_position == 3 || $currentConfirmteacher->id_position == 4)
                                                <button class="btn btn-danger"
                                                    wire:click="not_approve({{ $documentId }} ,{{ $projectItems->id_project }} ,{{ $currentConfirmteacher->id_teacher }} ,{{$currentConfirmteacher->id_position}})"
                                                    role="button">ไม่อนุมัติ</button>
                                            @endif
                                        @endif



                                        @if (
                                            $projectItems->teachers->every(fn($teacher) => $teacher->confirm_status == true) &&
                                                $projectItems->confirmStudents->every(fn($student) => $student->confirm_status == true))
                                            5555555
                                        @else
                                            2222
                                        @endif
                                    </form>
                                </div>
                            </div>
                            </p>
                        </div>
                    </div>
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
                                    {{-- <div class="row">
                                        <div class="col">
                                            <input type="checkbox" name=""
                                            wire:model="not_approve_comment1"    id=""><span>มีวุฒิทางการศึกษาไม่เป็นไปตามเกณฑ์</span><br>
                                            <input type="checkbox" name=""
                                            wire:model="not_approve_comment2"    id=""><span>มีจำนวนนักศึกษาที่รับผิดชอบเกินเกณฑ์ที่กำหนดไว้</span><br>
                                            <input type="checkbox" name="" id="other_comment"
                                            wire:model="not_approve_comment3"    wire:click="$dispatch('toggleComment')"><span>อื่นๆ</span>
                                        </div>
                                    </div> --}}
                                        <div class="mb-3" id="">
                                            <label for="message-text" class="col-form-label">หมายเหตุ:</label>
                                            <textarea class="form-control" wire:model="another_comment" id="message-text"></textarea>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Send message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $wire.on('not_approve_comment', () => {
            //
            const not_approveModal = new bootstrap.Modal(document.getElementById('not_approveModal'));
            not_approveModal.show();
        });
    </script>
@endscript
{{-- // $wire.on('toggleComment', () => {
    //     const comment = document.getElementById('comment');
    //     const other_comment = document.getElementById('other_comment');
    //     if(other_comment.checked == true){
    //         alert(other_comment);
    //     }
    // }); --}}