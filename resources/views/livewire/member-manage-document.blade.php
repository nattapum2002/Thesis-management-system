<div>
    <section id="member-manage-document">
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
        <div class="row">
            <div class="col-12 mb-2">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('member.create.document-01') }}" class="btn btn-primary">สร้างเอกสาร 01</a>
                </div>
            </div>
        </div>
        @foreach ($projects as $projectItems)
            @foreach ($projectItems->confirmStudents->groupBy('id_document') as $documentId => $confirmStudents)
                <div class="card">
                    @switch($documentId)
                        @case(3)
                            <div class="card-header">
                                <h5>
                                    {{ 'คกท.-คง.-0' . $confirmStudents->first()->documents->id_document . ' | ' . $confirmStudents->first()->documents->document }}
                                </h5>
                                <span>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}</span>
                            </div>
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

                                            @if ($allTeachersConfirmed)
                                                @if ($projectItems->confirmStudents->where('id_document', 5)->count() > 0)
                                                    <div class="d-flex justify-content-end">
                                                        <button class="btn btn-primary" disabled>สร้างเอกสาร 05 แล้ว</button>
                                                    </div>
                                                @else
                                                    <div class="d-flex justify-content-end">
                                                        <div>
                                                            <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                                href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-05') : '#' }}">
                                                                สร้างเอกสาร 05
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="d-flex justify-content-end">
                                                    <div>
                                                        <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                            href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-05') : '#' }}">
                                                            สร้างเอกสาร 05(รอการอนุมัติ)
                                                        </a>
                                                        @if ($projectItems->confirmStudents->where('id_document', 4)->count() > 0)
                                                            <button class="btn btn-primary"
                                                                href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-04') : '#' }}"
                                                                disabled>
                                                                สร้างเอกสาร 04 แล้ว
                                                            </button>
                                                        @else
                                                            <a class="btn btn-primary"
                                                                href="{{route('member.create.document-04')}}">
                                                                สร้างเอกสาร 04(สร้างกรณีสอบหัวข้อไม่ผ่าน)
                                                            </a>
                                                        @endif

                                                    </div>
                                                </div>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @break

                        @case(4)
                            <div class="card-header">
                                <h5>
                                    {{ 'คกท.-คง.-0' . $confirmStudents->first()->documents->id_document . ' | ' . $confirmStudents->first()->documents->document }}
                                </h5>
                                <span>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}</span>
                            </div>
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
                                                        @unless ($currentConfirmStudent->confirm_status)
                                                            <a class="btn btn-danger" href="#">ปฏิเสธ</a>
                                                        @endunless
                                                    </div>
                                                </div>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @break

                        @case(6)
                            <div class="card-header">
                                <h5>
                                    {{ 'คกท.-คง.-0' . $confirmStudents->first()->documents->id_document . ' | ' . $confirmStudents->first()->documents->document }}
                                </h5>
                                <span>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}</span>
                            </div>
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

                                            @if ($allTeachersConfirmed)
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
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @break

                        @case(7)
                            <div class="card-header">
                                <h5>
                                    {{ 'คกท.-คง.-0' . $confirmStudents->first()->documents->id_document . ' | ' . $confirmStudents->first()->documents->document }}
                                </h5>
                                <span>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}</span>
                            </div>
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
                                                        @unless ($currentConfirmStudent->confirm_status)
                                                            <a class="btn btn-danger" href="#">ปฏิเสธ</a>
                                                        @endunless
                                                    </div>
                                                    <div>
                                                        @switch($documentId)
                                                            @case(1)
                                                                <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                                    href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-02') : '#' }}">
                                                                    สร้างเอกสาร 02
                                                                </a>
                                                            @break

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

                                                            @default
                                                        @endswitch
                                                    </div>
                                                </div>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @break

                        @default
                            <div class="card-header">
                                <h5>
                                    {{ 'คกท.-คง.-0' . $confirmStudents->first()->documents->id_document . ' | ' . $confirmStudents->first()->documents->document }}
                                </h5>
                                <span>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}</span>
                            </div>
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
                                </div>
                                <div class="row">
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
                                                        @unless ($currentConfirmStudent->confirm_status)
                                                            <a class="btn btn-danger" href="#">ปฏิเสธ</a>
                                                        @endunless
                                                    </div>
                                                    <div>
                                                        @switch($documentId)
                                                            @case(1)
                                                                @if ($projectItems->confirmStudents->where('id_document', 2)->count() > 0)
                                                                    <button class="btn btn-primary" href=""
                                                                        disabled>สร้างเอกสาร 02 แล้ว</button>
                                                                @else
                                                                    <a class="btn btn-primary {{ $allStudentsConfirmed && $allTeachersConfirmed ? '' : 'disabled' }}"
                                                                        href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-02') : '#' }}">
                                                                        {{ $allStudentsConfirmed && $allTeachersConfirmed ? 'สร้างเอกสาร 02' : 'สร้างเอกสาร 2 (รอการอนุมัติ)' }}
                                                                    </a>
                                                                @endif
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
                                                                        href="{{ $allStudentsConfirmed && $allTeachersConfirmed ? route('member.create.document-06') : '#' }}">
                                                                        สร้างเอกสาร 05
                                                                    </a>
                                                                @endif
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
                        @endswitch
                    </div>
                @endforeach
            @endforeach
        </section>
    </div>
