<div>
    <section id="member-manage-document">
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12 mb-2">
                <input type="text" class="form-control" placeholder="ค้นหาชื่อโปรเจค..."
                    wire:model.live.debounce.150ms="search">
            </div>
        </div>
        @php
            $submission = $document_time->where('id_document', 1)->first();
        @endphp
        @if (
            $submission &&
                Carbon\Carbon::parse($submission->date_submission . ' ' . $submission->time_submission) > Carbon\Carbon::now())
            @if ($projects->first()->project_status == 'pending')
                <div class="row">
                    <div class="col-12 mb-2">
                        <div class="d-flex justify-content-end">
                            <button href="" class="btn btn-primary" disabled>สร้างเอกสาร
                                01(โปรเจคกำลังดำเนินงาน)</button>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12 mb-2">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('member.create.document-01') }}" class="btn btn-primary">สร้างเอกสาร
                                01</a>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="row">
                <div class="col-12 mb-2">
                    <div class="d-flex justify-content-end">
                        <button href="" class="btn btn-primary" disabled>สร้างเอกสาร
                            01(หมดเวลาส่งเอกสาร 01)</button>
                    </div>
                </div>
            </div>
        @endif

        @foreach ($projects as $projectItems)
            <div class="accordion" id="accordion">
                @foreach ($projectItems->confirmStudents->groupBy('id_document') as $documentId => $confirmStudents)
                    <div class="card">
                        @switch($documentId)
                            @case(3)
                                <div class="card-header" id="heading{{ $loop->index }}" style="cursor: pointer;"
                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}">
                                    <h5>
                                        {{ 'คกท.-คง.-0' . $confirmStudents->first()->documents->id_document . ' | ' . $confirmStudents->first()->documents->document }}
                                        ({{ $projectItems->project_status }})
                                    </h5>
                                    <span>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}</span>
                                    <span class="float-end">
                                        <i class="bx bx-chevron-down" style="font-size: 20px;"></i>
                                    </span>
                                </div>
                                <div id="collapse{{ $loop->index }}" class="collapse"
                                    aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <fieldset>
                                                    <legend>สมาชิก</legend>
                                                    <ul>
                                                        @foreach ($confirmStudents as $confirmStudent)
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
                                            <div class="col-lg-3 col-md-12 col-sm-12">
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
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
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
                                            <div class="col-12">
                                                {{-- <form
                                            wire:submit="confirmDocument({{ $confirmStudents->first()->id_document }}, {{ $projectItems->id_project }})"> --}}

                                                @php
                                                    $currentConfirmStudent = $confirmStudents->firstWhere(
                                                        'id_student',
                                                        Auth::guard('members')->user()->id_student,
                                                    );
                                                    $allStudentsConfirmed = $confirmStudents->every(
                                                        fn($student) => $student->confirm_status == true,
                                                    );
                                                    $allTeachersConfirmed = $projectItems->confirmTeachers
                                                        ->where('id_document', $documentId)
                                                        ->where('id_project', $projectItems->id_project)
                                                        ->every(fn($teacher) => $teacher->confirm_status == true);
                                                    $submissionDoc5 = $document_time->where('id_document', 5)->first();
                                                    $submissionDoc4 = $document_time->where('id_document', 4)->first();
                                                    $currentDateTime = Carbon\Carbon::now();

                                                    // Check if time has expired for both document 4 and 5
                                                    $isDoc5Expired =
                                                        $submissionDoc5 &&
                                                        Carbon\Carbon::parse(
                                                            $submissionDoc5->date_submission .
                                                                ' ' .
                                                                $submissionDoc5->time_submission,
                                                        ) < $currentDateTime;
                                                    $isDoc4Expired =
                                                        $submissionDoc4 &&
                                                        Carbon\Carbon::parse(
                                                            $submissionDoc4->date_submission .
                                                                ' ' .
                                                                $submissionDoc4->time_submission,
                                                        ) < $currentDateTime;
                                                        $commentAdmin = $projectItems->comments->where('id_document', 3)->where('id_position', 3 );
                                                        $commentBrancHead = $projectItems->comments->where('id_document', 3)->where('id_position', 4 );
                                                @endphp
                                                {{-- Check if time has passed for document 4 --}}
                                                <div class="mb-2">
                                                    @if ($submissionDoc4 && $isDoc4Expired)
                                                        <div class="d-flex justify-content-end">
                                                            <button class="btn btn-primary" disabled>สร้างเอกสาร 04
                                                                (หมดเวลา)</button>
                                                        </div>
                                                    @elseif($projectItems->confirmStudents->where('id_document', 4)->count() > 0)
                                                        <div class="d-flex justify-content-end">
                                                            <button class="btn btn-primary" disabled>สร้างเอกสาร 04
                                                                แล้ว</button>
                                                        </div>
                                                    @elseif($commentAdmin->pluck('comment')->contains('ไม่ผ่าน'))
                                                        <div class="d-flex justify-content-end">
                                                            <a class="btn btn-primary"
                                                                href="{{ route('member.create.document-04') }}">
                                                                สร้างเอกสาร 04(สร้างกรณีสอบหัวข้อไม่ผ่าน)
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    @if ($submissionDoc5 && $isDoc5Expired)
                                                        <div class="d-flex justify-content-end">
                                                            <button class="btn btn-primary" disabled>สร้างเอกสาร 05
                                                                (หมดเวลา)</button>
                                                        </div>
                                                    @elseif (($commentAdmin->pluck('comment')->contains('ผ่าน')||$commentAdmin->pluck('comment')->contains('ผ่าน/แก้ไขใหม่')) 
                                                            && ($commentBrancHead->pluck('comment')->contains('เห็นชอบ') || $commentBrancHead->pluck('comment')->contains('เห็นชอบให้มีการแก้ไข')))
                                                        @if ($projectItems->confirmStudents->where('id_document', 5)->count() > 0)
                                                            <div class="d-flex justify-content-end">
                                                                <button class="btn btn-primary" disabled>สร้างเอกสาร 05
                                                                    แล้ว</button>
                                                            </div>
                                                        @else
                                                            <div class="d-flex justify-content-end">
                                                                <div>
                                                                    <a class="btn btn-primary "
                                                                        href="{{ route('member.create.document-05') }}">
                                                                        สร้างเอกสาร 05
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="d-flex justify-content-end">
                                                            <div>
                                                                <button class="btn btn-primary" disabled>
                                                                    สร้างเอกสาร 05(รอการอนุมัติ)
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endif

                                                </div>


                                                {{-- Check if time has passed for document 5 --}}

                                                {{-- </form> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @break

                            @case(4)
                                <div class="card-header" id="heading{{ $loop->index }}" style="cursor: pointer;"
                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}">
                                    <h5>
                                        {{ 'คกท.-คง.-0' . $confirmStudents->first()->documents->id_document . ' | ' . $confirmStudents->first()->documents->document }}
                                        ({{ $projectItems->project_status }})
                                    </h5>
                                    <span>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}</span>
                                    <span class="float-end">
                                        <i class="bx bx-chevron-down" style="font-size: 20px;"></i>
                                    </span>
                                </div>
                                <div id="collapse{{ $loop->index }}" class="collapse"
                                    aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <fieldset>
                                                    <legend>สมาชิก</legend>
                                                    <ul>
                                                        @foreach ($confirmStudents as $confirmStudent)
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
                                            <div class="col-lg-3 col-md-12 col-sm-12">
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
                                        </div>
                                        <div class="row">
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
                                            <div class="col-12">
                                                <form
                                                    wire:submit="confirmDocument({{ $confirmStudents->first()->id_document }}, {{ $projectItems->id_project }})">

                                                    @php
                                                        $currentConfirmStudent = $confirmStudents->firstWhere(
                                                            'id_student',
                                                            Auth::guard('members')->user()->id_student,
                                                        );
                                                        $allStudentsConfirmed = $confirmStudents->every(
                                                            fn($student) => $student->confirm_status == true,
                                                        );
                                                        $allTeachersConfirmed = $projectItems->confirmTeachers
                                                            ->where('id_document', $documentId)
                                                            ->where('id_project', $projectItems->id_project)
                                                            ->every(fn($teacher) => $teacher->confirm_status == true);
                                                    @endphp

                                                    @if ($currentConfirmStudent)
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <button
                                                                    class="btn btn-success {{ $currentConfirmStudent->confirm_status ? 'disabled' : '' }}"
                                                                    type="submit">
                                                                    {{ $currentConfirmStudent->confirm_status ? 'ยืนยันแล้ว' : 'ยืนยัน' }}
                                                                </button>
                                                            </div>
                                                            <div class="d-flex justify-content-end">
                                                                <a href="/pdf/04/{{ $projectItems->id_project }}"
                                                                    class="btn btn-primary" target="_blank">PDF</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @break

                            @case(6)
                                <div class="card-header" id="heading{{ $loop->index }}" style="cursor: pointer;"
                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}">
                                    <h5>
                                        {{ 'คกท.-คง.-0' . $confirmStudents->first()->documents->id_document . ' | ' . $confirmStudents->first()->documents->document }}
                                        ({{ $projectItems->project_status }})
                                    </h5>
                                    <span>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}</span>
                                    <span class="float-end">
                                        <i class="bx bx-chevron-down" style="font-size: 20px;"></i>
                                    </span>
                                </div>
                                <div id="collapse{{ $loop->index }}" class="collapse"
                                    aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <fieldset>
                                                    <legend>สมาชิก</legend>
                                                    <ul>
                                                        @foreach ($confirmStudents as $confirmStudent)
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
                                            <div class="col-lg-3 col-md-12 col-sm-12">
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
                                        </div>
                                        <div class="row">
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
                                            <div class="col-12">
                                                <form
                                                    wire:submit="confirmDocument({{ $confirmStudents->first()->id_document }}, {{ $projectItems->id_project }})">

                                                    @php
                                                        $currentConfirmStudent = $confirmStudents->firstWhere(
                                                            'id_student',
                                                            Auth::guard('members')->user()->id_student,
                                                        );
                                                        $allStudentsConfirmed = $confirmStudents->every(
                                                            fn($student) => $student->confirm_status == true,
                                                        );
                                                        $allTeachersConfirmed = $projectItems->confirmTeachers
                                                            ->where('id_document', $documentId)
                                                            ->where('id_project', $projectItems->id_project)
                                                            ->every(fn($teacher) => $teacher->confirm_status == true);
                                                    @endphp

                                                    {{-- @if ($allTeachersConfirmed)
                                                <div class="d-flex justify-content-end">
                                                    <div>
                                                        @switch($documentId)
                                                            @case(1)
                                                                <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                                    href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-02') : '#' }}">
                                                                    สร้างเอกสาร 02
                                                                </a>
                                                            @break

                                                            @case(3)
                                                                @if (!3)
                                                                    <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                                        href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-04') : '#' }}">
                                                                        สร้างเอกสาร 04
                                                                    </a>
                                                                @elseif (!3 && !4)
                                                                    <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                                        href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-01') : '#' }}">
                                                                        สร้างเอกสาร 01
                                                                    </a>
                                                                @else
                                                                    <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                                        href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-05') : '#' }}">
                                                                        สร้างเอกสาร 05
                                                                    </a>
                                                                @endif
                                                            @break

                                                            @case(4)
                                                                <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                                    href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-03') : '#' }}">
                                                                    สร้างเอกสาร 03
                                                                </a>
                                                            @break

                                                            @case(6)
                                                                @if (!6)
                                                                    <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                                        href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-03') : '#' }}">
                                                                        สร้างเอกสาร 05
                                                                    </a>
                                                                @endif
                                                            @break

                                                            @default
                                                        @endswitch
                                                    </div>
                                                </div>
                                            @endif --}}
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @break

                            @case(7)
                                <div class="card-header" id="heading{{ $loop->index }}" style="cursor: pointer;"
                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}">
                                    <h5>
                                        {{ 'คกท.-คง.-0' . $confirmStudents->first()->documents->id_document . ' | ' . $confirmStudents->first()->documents->document }}
                                        ({{ $projectItems->project_status }})
                                    </h5>
                                    <span>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}</span>
                                    <span class="float-end">
                                        <i class="bx bx-chevron-down" style="font-size: 20px;"></i>
                                    </span>
                                </div>
                                <div id="collapse{{ $loop->index }}" class="collapse"
                                    aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <fieldset>
                                                    <legend>สมาชิก</legend>
                                                    <ul>
                                                        @foreach ($confirmStudents as $confirmStudent)
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
                                            <div class="col-lg-3 col-md-12 col-sm-12">
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
                                        </div>
                                        <div class="row">
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
                                            <div class="col-12">
                                                <form
                                                    wire:submit="confirmDocument({{ $confirmStudents->first()->id_document }}, {{ $projectItems->id_project }})">

                                                    @php
                                                        $currentConfirmStudent = $confirmStudents->firstWhere(
                                                            'id_student',
                                                            Auth::guard('members')->user()->id_student,
                                                        );
                                                        $allStudentsConfirmed = $confirmStudents->every(
                                                            fn($student) => $student->confirm_status == true,
                                                        );
                                                        $allTeachersConfirmed = $projectItems->confirmTeachers
                                                            ->where('id_document', $documentId)
                                                            ->where('id_project', $projectItems->id_project)
                                                            ->every(fn($teacher) => $teacher->confirm_status == true);
                                                    @endphp

                                                    @if ($currentConfirmStudent)
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <button
                                                                    class="btn btn-success {{ $currentConfirmStudent->confirm_status ? 'disabled' : '' }}"
                                                                    type="submit">
                                                                    {{ $currentConfirmStudent->confirm_status ? 'ยืนยันแล้ว' : 'ยืนยัน' }}
                                                                </button>
                                                            </div>





                                                            <div>
                                                                {{-- @switch($documentId) --}}
                                                                {{-- @case(1)
                                                                <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                                    href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-02') : '#' }}">
                                                                    สร้างเอกสาร 02
                                                                </a>
                                                            @break --}}

                                                                {{-- @case(3)
                                                                @if (!3)
                                                                    <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                                        href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-04') : '#' }}">
                                                                        สร้างเอกสาร 04
                                                                    </a>
                                                                @elseif (!3 && !4)
                                                                    <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                                        href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-01') : '#' }}">
                                                                        สร้างเอกสาร 01
                                                                    </a>
                                                                @else
                                                                    <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                                        href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-05') : '#' }}">
                                                                        สร้างเอกสาร 05
                                                                    </a>
                                                                @endif
                                                            @break

                                                            @case(4)
                                                                <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                                    href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-03') : '#' }}">
                                                                    สร้างเอกสาร 03
                                                                </a>
                                                            @break

                                                            @case(6)
                                                                @if (!6)
                                                                    <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                                        href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-06') : '#' }}">
                                                                        สร้างเอกสาร 05
                                                                    </a>
                                                                @endif
                                                            @break --}}

                                                                {{-- @default
                                                        @endswitch --}}
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <a href="/pdf/07/{{ $projectItems->id_project }}"
                                                                class="btn btn-primary" target="_blank">PDF</a>
                                                        </div>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @break

                            @default
                                <div class="card-header" id="heading{{ $loop->index }}" style="cursor: pointer;"
                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}">
                                    <h5>
                                        {{ 'คกท.-คง.-0' . $confirmStudents->first()->documents->id_document . ' | ' . $confirmStudents->first()->documents->document }}
                                        ({{ $projectItems->project_status }})
                                    </h5>
                                    <span>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}</span>
                                    <span class="float-end">
                                        <i class="bx bx-chevron-down" style="font-size: 20px;"></i>
                                    </span>
                                </div>
                                <div id="collapse{{ $loop->index }}" class="collapse"
                                    aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <fieldset>
                                                    <legend>สมาชิก</legend>
                                                    <ul>
                                                        @foreach ($confirmStudents as $confirmStudent)
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
                                                @if ($documentId == 1)
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
                                                @endif
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
                                        </div>
                                        <div class="row">
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
                                            <div class="col-12">
                                                <form
                                                    wire:submit="confirmDocument({{ $confirmStudents->first()->id_document }}, {{ $projectItems->id_project }})">

                                                    @php
                                                        $currentConfirmStudent = $confirmStudents->firstWhere(
                                                            'id_student',
                                                            Auth::guard('members')->user()->id_student,
                                                        );
                                                        $allStudentsConfirmed = $confirmStudents->every(
                                                            fn($student) => $student->confirm_status == true,
                                                        );
                                                        $allTeachersConfirmed = $projectItems->confirmTeachers
                                                            ->where('id_document', $documentId)
                                                            ->where('id_project', $projectItems->id_project)
                                                            ->every(fn($teacher) => $teacher->confirm_status == true);
                                                        $commentAdmin = $projectItems->comments->where('id_document', $documentId)->where('id_position', 3 );
                                                        $commentBrancHead = $projectItems->comments->where('id_document', $documentId)->where('id_position', 4 );
                                                    @endphp

                                                    @if ($currentConfirmStudent)
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <button
                                                                    class="btn btn-success {{ $currentConfirmStudent->confirm_status ? 'disabled' : '' }}"
                                                                    type="submit">
                                                                    {{ $currentConfirmStudent->confirm_status ? 'ยืนยันแล้ว' : 'ยืนยัน' }}
                                                                </button>
                                                            </div>
                                                            <div>
                                                                @switch($documentId)
                                                                    @case(1)
                                                                        @if ($projectItems->confirmStudents->where('id_document', 2)->count() > 0)
                                                                            <button class="btn btn-primary" href=""
                                                                                disabled>สร้างเอกสาร 02 แล้ว</button>
                                                                        @else
                                                                            <a class="btn btn-primary {{ ($commentAdmin->pluck('comment')->contains('อนุมัติชื่อเรื่อง') && $commentAdmin->pluck('comment')->contains('อนุมัติอาจารย์ที่ปรึกษา'))&&($commentBrancHead->pluck('comment')->contains('อนุมัติ')) ? '' : 'disabled' }}"
                                                                                href="{{ ($commentAdmin->pluck('comment')->contains('อนุมัติชื่อเรื่อง') && $commentAdmin->pluck('comment')->contains('อนุมัติอาจารย์ที่ปรึกษา'))&&($commentBrancHead->pluck('comment')->contains('อนุมัติ')) ? route('member.create.document-02') : '#' }}">
                                                                                {{ ($commentAdmin->pluck('comment')->contains('อนุมัติชื่อเรื่อง') && $commentAdmin->pluck('comment')->contains('อนุมัติอาจารย์ที่ปรึกษา'))&&($commentBrancHead->pluck('comment')->contains('อนุมัติ')) ? 'สร้างเอกสาร 02' : 'สร้างเอกสาร 2 (รอการอนุมัติ)' }}
                                                                            </a>
                                                                        @endif
                                                                        <a href="/pdf/01/{{ $projectItems->id_project }}"
                                                                            class="btn btn-primary" target="_blank">PDF</a>
                                                                    @break

                                                                    @case(2)
                                                                        <a href="/pdf/02/{{ $projectItems->id_project }}"
                                                                            class="btn btn-primary" target="_blank">PDF</a>
                                                                    @break

                                                                    @case(3)
                                                                        @if (!3)
                                                                            <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                                                href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-04') : '#' }}">
                                                                                สร้างเอกสาร 04
                                                                            </a>
                                                                        @elseif (!3 && !4)
                                                                            <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                                                href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-01') : '#' }}">
                                                                                สร้างเอกสาร 01
                                                                            </a>
                                                                        @else
                                                                            <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                                                href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-05') : '#' }}">
                                                                                สร้างเอกสาร 05
                                                                            </a>
                                                                        @endif
                                                                    @break

                                                                    @case(4)
                                                                        <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                                            href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-03') : '#' }}">
                                                                            สร้างเอกสาร 03
                                                                        </a>
                                                                    @break

                                                                    @case(5)
                                                                        <a href="/pdf/05/{{ $projectItems->id_project }}"
                                                                            class="btn btn-primary" target="_blank">PDF</a>
                                                                    @break

                                                                    @default
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endswitch
                        </div>
                    @endforeach
                </div>
            @endforeach
            <div class="d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <!-- Customize Previous Link -->
                        <li class="page-item {{ $projects->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $projects->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        <!-- Pagination Links -->
                        @foreach ($projects->links()->elements as $element)
                            @if (is_string($element))
                                <!-- Dots -->
                                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    <li class="page-item {{ $page == $projects->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                            @endif
                        @endforeach

                        <!-- Customize Next Link -->
                        <li class="page-item {{ !$projects->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $projects->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>
    </div>
