<div>
    <section id="teacher-manage-document">
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @elseif (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row mb-3">
            <div class="col-lg-9 col-md-7 col-sm-12">
                <form wire:submit.prevent="find" class="d-flex">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="ค้นหาโปรเจค..." wire:model="search">
                        <button type="submit" class="btn btn-orange"><i class='bx bx-search'></i></button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-md-5 col-sm-12">
                <div class="mb-2">
                    <select class="form-select" wire:model.live.debounce.100ms="filterType">
                        <option value="0">ยังไม่ได้พิจารณา</option>
                        <option value="1">พิจารณาแล้ว</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="tab">
            <button class="tablinks" onclick="openTabs(event, 'doc01')">เอกสาร 01</button>
            <button class="tablinks" onclick="openTabs(event, 'doc02')">เอกสาร 02</button>
            <button class="tablinks" onclick="openTabs(event, 'doc03')">เอกสาร 03</button>
            <button class="tablinks" onclick="openTabs(event, 'doc04')">เอกสาร 04</button>
            <button class="tablinks" onclick="openTabs(event, 'doc05')">เอกสาร 05</button>
            <button class="tablinks" onclick="openTabs(event, 'doc06')">เอกสาร 06</button>
            <button class="tablinks" onclick="openTabs(event, 'doc07')">เอกสาร 07</button>
        </div>
        @foreach (range(1, 7) as $docId)
            <div id="doc0{{ $docId }}" class="tabcontent">
                @foreach ($projects as $projectItems)
                    @foreach ($projectItems->confirmteachers->groupBy('id_document') as $confirm_teacher)
                        @php
                            // Filter the collection to get only those with the specified id_teacher
                            $filteredConfirmTeachers = $confirm_teacher
                                ->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)
                                ->where('id_document', $docId)
                                ->where('confirm_status', $filterType)
                                ->groupBy('id_document')
                                ->map(function ($teachers) {
                                    // Return the first teacher in each group
                                    return $teachers->first();
                                });

                        @endphp
                        @if ($filteredConfirmTeachers->isNotEmpty())
                            <div class="accordion" id="accordion">
                                @foreach ($filteredConfirmTeachers as $documentId => $confirm_teachers)
                                    <div class="card">
                                        @switch($documentId)
                                            @case(3)
                                                <div class="card-header" id="heading{{ $projectItems->id_project }}"
                                                    style="cursor: pointer;" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $projectItems->id_project }}">
                                                    <h5>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}
                                                    </h5>
                                                    <span>
                                                        {{ 'คกท.-คง.-0' . $confirm_teachers->document->id_document . ' | ' . $confirm_teachers->document->document }}
                                                    </span>
                                                    <span class="float-end">
                                                        <i class="bx bx-chevron-down" style="font-size: 20px;"></i>
                                                    </span>
                                                </div>
                                                <div id="collapse{{ $projectItems->id_project }}" class="collapse"
                                                    aria-labelledby="heading{{ $projectItems->id_project }}"
                                                    data-bs-parent="#accordion">
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
                                                                    $teacherId = Auth::guard('teachers')->user()
                                                                        ->id_teacher;
                                                                    $confirmTeacher = $projectItems->confirmTeachers
                                                                        ->where('id_teacher', $teacherId)
                                                                        ->where('id_document', $documentId)
                                                                        ->first();
                                                                @endphp
                                                                @if (!in_array($confirmTeacher?->teacher->user_type, ['Admin', 'Branch head']))
                                                                    @if ($confirmTeacher?->confirm_status == 1)
                                                                        <a class="btn btn-primary disabled" href="#"
                                                                            role="button" aria-disabled="true"
                                                                            style="pointer-events: none;">อนุมัติแล้ว</a>
                                                                    @else
                                                                        <button class="btn btn-primary"
                                                                            wire:click="teacher_document({{ $confirmTeacher?->id_document }}, {{ $projectItems->id_project }})"
                                                                            role="button">อนุมัติ
                                                                        </button>
                                                                    @endif
                                                                @endif
                                                                @if (in_array($confirmTeacher?->teacher->user_type, ['Admin', 'Branch head']))
                                                                    <button class="btn btn-primary"
                                                                        wire:click="document({{ $documentId }}, {{ $projectItems->id_project }})">
                                                                        ตรวจสอบ
                                                                    </button>
                                                                @endif
                                                                @if (in_array($confirmTeacher?->id_position, [5, 6, 7]) && $confirmTeacher?->teacher->user_type != 'Admin')
                                                                    <a href="/pdf/03-score/{{ $projectItems->id_project }}"
                                                                        class="btn btn-warning" target="_blank">ดูผลการสอบ</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @break

                                            @case(4)
                                                <div class="card-header" id="heading{{ $projectItems->id_project }}"
                                                    style="cursor: pointer;" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $projectItems->id_project }}">
                                                    <h5>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}
                                                    </h5>
                                                    <span>
                                                        {{ 'คกท.-คง.-0' . $confirm_teachers->document->id_document . ' | ' . $confirm_teachers->document->document }}
                                                    </span>
                                                    <span class="float-end">
                                                        <i class="bx bx-chevron-down" style="font-size: 20px;"></i>
                                                    </span>
                                                </div>
                                                <div id="collapse{{ $projectItems->id_project }}" class="collapse"
                                                    aria-labelledby="heading{{ $projectItems->id_project }}"
                                                    data-bs-parent="#accordion">
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
                                                                    $teacherId = Auth::guard('teachers')->user()
                                                                        ->id_teacher;
                                                                    $confirmTeacher = $projectItems->confirmTeachers
                                                                        ->where('id_teacher', $teacherId)
                                                                        ->where('id_document', $documentId)
                                                                        ->first();
                                                                @endphp
                                                                @if (!in_array($confirmTeacher?->teacher->user_type, ['Branch head', 'Admin']))
                                                                    @if ($confirmTeacher?->confirm_status == 1)
                                                                        <a class="btn btn-primary disabled" href="#"
                                                                            role="button" aria-disabled="true"
                                                                            style="pointer-events: none;">อนุมัติแล้ว</a>
                                                                    @else
                                                                        <button class="btn btn-primary"
                                                                            wire:click="teacher_document({{ $confirmTeacher?->id_document }}, {{ $projectItems->id_project }})"
                                                                            role="button">อนุมัติ
                                                                        </button>
                                                                    @endif
                                                                @endif
                                                                @if (in_array($confirmTeacher?->teacher->user_type, ['Branch head', 'Admin']))
                                                                    <button class="btn btn-primary"
                                                                        wire:click="document({{ $documentId }}, {{ $projectItems->id_project }})">
                                                                        ตรวจสอบ
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @break

                                            @case(6)
                                                <div class="card-header" id="heading{{ $projectItems->id_project }}"
                                                    style="cursor: pointer;" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $projectItems->id_project }}">
                                                    <h5>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}
                                                    </h5>
                                                    <span>
                                                        {{ 'คกท.-คง.-0' . $confirm_teachers->document->id_document . ' | ' . $confirm_teachers->document->document }}
                                                    </span>
                                                    <span class="float-end">
                                                        <i class="bx bx-chevron-down" style="font-size: 20px;"></i>
                                                    </span>
                                                </div>
                                                <div id="collapse{{ $projectItems->id_project }}" class="collapse"
                                                    aria-labelledby="heading{{ $projectItems->id_project }}"
                                                    data-bs-parent="#accordion">
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
                                                                    $teacherId = Auth::guard('teachers')->user()
                                                                        ->id_teacher;
                                                                    $confirmTeacher = $projectItems->confirmTeachers
                                                                        ->where('id_teacher', $teacherId)
                                                                        ->where('id_document', $documentId)
                                                                        ->first();
                                                                @endphp
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        @if (!in_array($confirmTeacher?->teacher->user_type, ['Branch head', 'Admin']))
                                                                            @if ($confirmTeacher?->confirm_status == 1)
                                                                                <a class="btn btn-primary disabled"
                                                                                    href="#" role="button"
                                                                                    aria-disabled="true"
                                                                                    style="pointer-events: none;">อนุมัติแล้ว</a>
                                                                            @else
                                                                                <button class="btn btn-primary"
                                                                                    wire:click="teacher_document({{ $confirmTeacher?->id_document }}, {{ $projectItems->id_project }})"
                                                                                    role="button">อนุมัติ
                                                                                </button>
                                                                            @endif
                                                                        @endif
                                                                        @if (in_array($confirmTeacher?->teacher->user_type, ['Branch head', 'Admin']))
                                                                            <button class="btn btn-primary"
                                                                                wire:click="document({{ $documentId }}, {{ $projectItems->id_project }})">
                                                                                ตรวจสอบ
                                                                            </button>
                                                                        @endif
                                                                        @if (in_array($confirmTeacher?->id_position, [5, 6, 7]) && $confirmTeacher?->teacher->user_type != 'Admin')
                                                                            <a href="/pdf/06/{{ $projectItems->id_project }}"
                                                                                class="btn btn-warning"
                                                                                target="_blank">ดูผลการสอบ</a>
                                                                        @endif
                                                                    </div>
                                                                    <div>
                                                                        @if ($confirmTeacher?->teacher->user_type == 'Admin')
                                                                            @if ($projectItems->confirmteachers->where('id_document', 7)->count() > 0)
                                                                                <button class="btn btn-primary"
                                                                                    wire:click="create_document_07({{ $projectItems->id_project }})"
                                                                                    disabled>
                                                                                    สร้างเอกสาร 07 แล้ว
                                                                                </button>
                                                                            @else
                                                                                <button class="btn btn-primary"
                                                                                    wire:click="create_document_07({{ $projectItems->id_project }})">
                                                                                    สร้างเอกสาร 07
                                                                                </button>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @break

                                            @case(7)
                                                <div class="card-header" id="heading{{ $projectItems->id_project }}"
                                                    style="cursor: pointer;" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $projectItems->id_project }}">
                                                    <h5>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}
                                                    </h5>
                                                    <span>
                                                        {{ 'คกท.-คง.-0' . $confirm_teachers->document->id_document . ' | ' . $confirm_teachers->document->document }}
                                                    </span>
                                                    <span class="float-end">
                                                        <i class="bx bx-chevron-down" style="font-size: 20px;"></i>
                                                    </span>
                                                </div>
                                                <div id="collapse{{ $projectItems->id_project }}" class="collapse"
                                                    aria-labelledby="heading{{ $projectItems->id_project }}"
                                                    data-bs-parent="#accordion">
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
                                                                    $teacherId = Auth::guard('teachers')->user()
                                                                        ->id_teacher;
                                                                    $confirmTeacher = $projectItems->confirmTeachers
                                                                        ->where('id_teacher', $teacherId)
                                                                        ->where('id_document', $documentId)
                                                                        ->first();
                                                                @endphp
                                                                @if (!in_array($confirmTeacher?->teacher->user_type, ['Branch head', 'Admin']))
                                                                    @if ($confirmTeacher?->confirm_status == 1)
                                                                        <a class="btn btn-primary disabled" href="#"
                                                                            role="button" aria-disabled="true"
                                                                            style="pointer-events: none;">อนุมัติแล้ว</a>
                                                                    @else
                                                                        <button class="btn btn-primary"
                                                                            wire:click="teacher_document({{ $confirmTeacher?->id_document }}, {{ $projectItems->id_project }})"
                                                                            role="button">อนุมัติ
                                                                        </button>
                                                                    @endif
                                                                @endif
                                                                @if (in_array($confirmTeacher?->teacher->user_type, ['Branch head', 'Admin']))
                                                                    <button class="btn btn-primary"
                                                                        wire:click="document({{ $documentId }}, {{ $projectItems->id_project }})">
                                                                        ตรวจสอบ
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @break

                                            @default
                                                <div class="card-header" id="heading{{ $projectItems->id_project }}"
                                                    style="cursor: pointer;" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $projectItems->id_project }}">
                                                    <h5>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}
                                                    </h5>
                                                    <span>
                                                        {{ 'คกท.-คง.-0' . $confirm_teachers->document->id_document . ' | ' . $confirm_teachers->document->document }}
                                                    </span>
                                                    <span class="float-end">
                                                        <i class="bx bx-chevron-down" style="font-size: 20px;"></i>
                                                    </span>
                                                </div>
                                                <div id="collapse{{ $projectItems->id_project }}" class="collapse"
                                                    aria-labelledby="heading{{ $projectItems->id_project }}"
                                                    data-bs-parent="#accordion">
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
                                                                    $teacherId = Auth::guard('teachers')->user()
                                                                        ->id_teacher;
                                                                    $confirmTeacher = $projectItems->confirmTeachers
                                                                        ->where('id_teacher', $teacherId)
                                                                        ->where('id_document', $documentId)
                                                                        ->first();
                                                                @endphp
                                                                @if (!in_array($confirmTeacher?->teacher->user_type, ['Branch head', 'Admin']))
                                                                    @if ($confirmTeacher?->confirm_status == 1)
                                                                        <a class="btn btn-primary disabled" href="#"
                                                                            role="button" aria-disabled="true"
                                                                            style="pointer-events: none;">อนุมัติแล้ว</a>
                                                                    @else
                                                                        <button class="btn btn-primary"
                                                                            wire:click="teacher_document({{ $confirmTeacher?->id_document }}, {{ $projectItems->id_project }})"
                                                                            role="button">อนุมัติ
                                                                        </button>
                                                                    @endif
                                                                @endif
                                                                @if (in_array($confirmTeacher?->teacher->user_type, ['Branch head', 'Admin']))
                                                                    <button class="btn btn-primary"
                                                                        wire:click="document({{ $documentId }}, {{ $projectItems->id_project }})">
                                                                        ตรวจสอบ
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endswitch
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        @endforeach
    </section>
</div>
