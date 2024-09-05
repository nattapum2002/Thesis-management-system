<div>
    <section id="project-status">
        <div class="row gy-2">
            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-12">
                        <div class="project">
                            <div class="card">
                                <div class="card-body">
                                    <h4>โปรเจคของนักศึกษา</h4>
                                    <div>
                                        <p>{{ $projectActive->project_name_th ?? 'ไม่พบโปรเจค' }}</p>
                                        <small>{{ $projectActive->project_name_en ?? '' }}</small>

                                        @if (!$projectActive)
                                            <a href="{{ route('member.create.document-01') }}"
                                                class="btn btn-orange mt-2">เพิ่มโปรเจค</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="member">
                            <div class="card">
                                <div class="card-body">
                                    <h4>สมาชิก</h4>
                                    <div>
                                        <p>
                                            @if ($projectActive)
                                                @foreach ($projectActive->members as $member)
                                                    {{ $member->prefix . ' ' . $member->name . ' ' . $member->surname }}<br>
                                                @endforeach
                                            @else
                                                ไม่พบสมาชิก
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="adviser">
                            <div class="card">
                                <div class="card-body">
                                    <h4>อาจารย์ที่ปรึกษา</h4>
                                    <div>
                                        @if ($projectActive)
                                            @php
                                                // จัดเรียง teachers ตาม id_position ใน advisers
                                                $sortedTeachers = $projectActive->teachers->sortBy(function (
                                                    $teacher,
                                                ) use ($advisers) {
                                                    return $advisers->firstWhere('id_teacher', $teacher->id_teacher)
                                                        ->id_position ?? PHP_INT_MAX;
                                                });
                                            @endphp

                                            @foreach ($sortedTeachers as $teacher)
                                                @php
                                                    $position =
                                                        $advisers->firstWhere('id_teacher', $teacher->id_teacher)
                                                            ->id_position ?? null;
                                                @endphp

                                                <p class="{{ $position == 1 ? 'main-adviser' : '' }}">
                                                    {{ $teacher->prefix . ' ' . $teacher->name . ' ' . $teacher->surname }}
                                                </p>
                                            @endforeach
                                        @else
                                            <p>ไม่พบอาจารย์ที่ปรึกษา</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="document">
                            <div class="card">
                                <div class="card-body table-responsive p-0">
                                    <h4>กำหนดการเอกสาร</h4>
                                    @if ($documentSchedules->count() > 0)
                                        <table class="table text-nowrap table-striped">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>วันที่</th>
                                                    <th>เวลา</th>
                                                    <th>ชื่อเอกสาร</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($documentSchedules as $documentSchedule)
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ thaidate('j M Y', $documentSchedule->date_submission) }}
                                                        </td>
                                                        <td>{{ thaidate('H:i น.', $documentSchedule->time_submission) }}
                                                        </td>
                                                        <td>
                                                            <p>{{ 'เอกสาร คกท.-คง.-0' . $documentSchedule->id_document }}
                                                            </p>
                                                            <small>{{ $documentSchedule->document->document }}</small>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p>ไม่พบกำหนดการเอกสาร</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="exam">
                            <div class="card">
                                <div class="card-body">
                                    <h4>ตารางการสอบ</h4>
                                    @if ($examCountDates)
                                        <div class="row gy-2 justify-content-center">
                                            <div class="col-lg-2 col-md-6 col-sm-4">
                                                <div class="examCountdown">
                                                    <span>
                                                        <p id="days">0</p> วัน
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-sm-4">
                                                <div class="examCountdown">
                                                    <span>
                                                        <p id="hours">0</p> ชั่วโมง
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-sm-4">
                                                <div class="examCountdown">
                                                    <span>
                                                        <p id="minutes">0</p> นาที
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-sm-4">
                                                <div class="examCountdown">
                                                    <span>
                                                        <p id="seconds">0</p> วินาที
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-12">
                                                <div class="card card-table">
                                                    <div class="card-body table-responsive p-0">
                                                        <table class="table text-nowrap">
                                                            <tbody>
                                                                <tr>
                                                                    <th>วันที่</th>
                                                                    <td>{{ thaidate('j M Y', $examCountDates->exam_day) }}
                                                                    </td>
                                                                    <th>เวลา</th>
                                                                    <td>
                                                                        {{ thaidate('H:i น.', $examCountDates->exam_time) }}
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>ประเภท</th>
                                                                    <td>{{ $examCountDates->id_document == 3 ? 'สอบหัวข้อ' : 'สอบจบ' }}
                                                                    </td>
                                                                    <th>ห้องสอบ</th>
                                                                    <td>{{ $examCountDates->exam_room }}</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>อาคาร</th>
                                                                    <td>{{ $examCountDates->exam_building }}</td>
                                                                    <th>คณะ</th>
                                                                    <td>{{ $examCountDates->exam_group }}</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>ปีการศึกษา</th>
                                                                    <td>{{ $examCountDates->year_published }}</td>
                                                                    <th>ภาคเรียน</th>
                                                                    <td>{{ $examCountDates->semester }}</td>
                                                                    <td></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row justify-content-center">
                                            <div class="col-12">
                                                <p>ไม่มีการสอบ</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="status">
                    <h4>สถานะโปรเจค</h4>
                    @if ($projectActive)
                        <div>
                            <!-- status 01 -->
                            <a href="{{ route('pdf01Generate', $projectActive->id_project) }}" target="_blank">
                                @php
                                    $studentConfirmed = $confirmStudents->where('id_document', 1)->first();
                                    $teacherConfirmed =
                                        $studentConfirmed &&
                                        $confirmTeachers
                                            ->where(
                                                'id_teacher',
                                                optional($teachers->where('user_type', 'Branch head')->first())
                                                    ->id_teacher,
                                            )
                                            ->where('id_document', 1)
                                            ->first();
                                @endphp

                                <div
                                    class="card {{ $teacherConfirmed ? 'completed' : ($studentConfirmed ? 'processing' : '') }}">
                                    <div class="card-body">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        <span>01</span>
                                                    </th>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <span>สมาชิก</span>
                                                                @foreach ($projectActive->members as $member)
                                                                    @if ($confirmStudents->where('id_student', $member->id_student)->where('id_document', 1)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $member->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $member->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>อาจารย์ที่ปรึกษา</span>
                                                                @foreach ($projectActive->advisers as $adviser)
                                                                    @if ($confirmTeachers->where('id_teacher', $adviser->id_teacher)->where('id_document', 1)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $adviser->teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $adviser->teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>อาจารย์ประจำวิชา</span>
                                                                @foreach ($teachers->where('user_type', 'Admin') as $teacher)
                                                                    @if ($confirmTeachers->where('id_teacher', $teacher->id_teacher)->where('id_document', 1)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>หัวหน้าสาขา</span>
                                                                @foreach ($teachers->where('user_type', 'Branch head') as $teacher)
                                                                    @if ($confirmTeachers->where('id_teacher', $teacher->id_teacher)->where('id_document', 1)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </a>
                            <!-- status 02 -->
                            <a href="{{ route('pdf02Generate', $projectActive->id_project) }}" target="_blank">
                                @php
                                    $studentConfirmed = $confirmStudents->where('id_document', 2)->first();
                                    $teacherConfirmed =
                                        $studentConfirmed &&
                                        $confirmTeachers
                                            ->where(
                                                'id_teacher',
                                                optional($teachers->where('user_type', 'Branch head')->first())
                                                    ->id_teacher,
                                            )
                                            ->where('id_document', 2)
                                            ->first();
                                @endphp

                                <div
                                    class="card {{ $teacherConfirmed ? 'completed' : ($studentConfirmed ? 'processing' : '') }}">

                                    <div class="card-body">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        <span>02</span>
                                                    </th>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <span>สมาชิก</span>
                                                                @foreach ($projectActive->members as $member)
                                                                    @if ($confirmStudents->where('id_student', $member->id_student)->where('id_document', 2)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $member->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $member->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>อาจารย์ที่ปรึกษา</span>
                                                                @foreach ($projectActive->advisers->where('id_position', 1) as $adviser)
                                                                    @if ($confirmTeachers->where('id_teacher', $adviser->id_teacher)->where('id_document', 2)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $adviser->teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $adviser->teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>อาจารย์ประจำวิชา</span>
                                                                @foreach ($teachers->where('user_type', 'Admin') as $teacher)
                                                                    @if ($confirmTeachers->where('id_teacher', $teacher->id_teacher)->where('id_document', 2)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>หัวหน้าสาขา</span>
                                                                @foreach ($teachers->where('user_type', 'Branch head') as $teacher)
                                                                    @if ($confirmTeachers->where('id_teacher', $teacher->id_teacher)->where('id_document', 2)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </a>
                            <!-- status 03 -->
                            <a href="#">
                                @php
                                    $directorConfirmed = $confirmTeachers
                                        ->where('id_teacher', optional($directors->first())->id_teacher)
                                        ->where('id_document', 3)
                                        ->first();
                                    $teacherConfirmed =
                                        $directorConfirmed &&
                                        $confirmTeachers
                                            ->where(
                                                'id_teacher',
                                                optional($teachers->where('user_type', 'Branch head')->first())
                                                    ->id_teacher,
                                            )
                                            ->where('id_document', 3)
                                            ->first();
                                @endphp
                                <div
                                    class="card {{ $teacherConfirmed ? 'completed' : ($directorConfirmed ? 'processing' : '') }}">
                                    <div class="card-body">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        <span>03</span>
                                                    </th>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <span>กรรมการ</span>
                                                                @foreach ($directors->where('id_document', 3) as $director)
                                                                    @if ($confirmTeachers->where('id_teacher', $director->id_teacher)->where('id_document', 3)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $director->teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $director->teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>อาจารย์ประจำวิชา</span>
                                                                @foreach ($teachers->where('user_type', 'Admin') as $teacher)
                                                                    @if ($confirmTeachers->where('id_teacher', $teacher->id_teacher)->where('id_document', 3)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>หัวหน้าสาขา</span>
                                                                @foreach ($teachers->where('user_type', 'Branch head') as $teacher)
                                                                    @if ($confirmTeachers->where('id_teacher', $teacher->id_teacher)->where('id_document', 3)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </a>
                            <!-- status 04 -->
                            <a href="{{ route('pdf04Generate', $projectActive->id_project) }}" target="_blank">
                                @php
                                    $studentConfirmed = $confirmStudents->where('id_document', 4)->first();
                                    $teacherConfirmed =
                                        $studentConfirmed &&
                                        $confirmTeachers
                                            ->where(
                                                'id_teacher',
                                                optional($teachers->where('user_type', 'Branch head')->first())
                                                    ->id_teacher,
                                            )
                                            ->where('id_document', 4)
                                            ->first();
                                @endphp

                                <div
                                    class="card {{ $teacherConfirmed ? 'completed' : ($studentConfirmed ? 'processing' : '') }}">

                                    <div class="card-body">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        <span>04</span>
                                                    </th>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <span>สมาชิก</span>
                                                                @foreach ($projectActive->members as $member)
                                                                    @if ($confirmStudents->where('id_student', $member->id_student)->where('id_document', 4)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $member->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $member->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>อาจารย์ที่ปรึกษา</span>
                                                                @foreach ($projectActive->advisers as $adviser)
                                                                    @if ($confirmTeachers->where('id_teacher', $adviser->id_teacher)->where('id_document', 4)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $adviser->teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $adviser->teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>กรรมการ</span>
                                                                @foreach ($directors->where('id_document', 3) as $director)
                                                                    @if ($confirmTeachers->where('id_teacher', $director->id_teacher)->where('id_document', 4)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $director->teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $director->teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>อาจารย์ประจำวิชา</span>
                                                                @foreach ($teachers->where('user_type', 'Admin') as $teacher)
                                                                    @if ($confirmTeachers->where('id_teacher', $teacher->id_teacher)->where('id_document', 4)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>หัวหน้าสาขา</span>
                                                                @foreach ($teachers->where('user_type', 'Branch head') as $teacher)
                                                                    @if ($confirmTeachers->where('id_teacher', $teacher->id_teacher)->where('id_document', 4)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </a>
                            <!-- status 05 -->
                            <a href="{{ route('pdf05Generate', $projectActive->id_project) }}" target="_blank">
                                @php
                                    $studentConfirmed = $confirmStudents->where('id_document', 5)->first();
                                    $teacherConfirmed =
                                        $studentConfirmed &&
                                        $confirmTeachers
                                            ->where(
                                                'id_teacher',
                                                optional($teachers->where('user_type', 'Branch head')->first())
                                                    ->id_teacher,
                                            )
                                            ->where('id_document', 5)
                                            ->first();
                                @endphp

                                <div
                                    class="card {{ $teacherConfirmed ? 'completed' : ($studentConfirmed ? 'processing' : '') }}">

                                    <div class="card-body">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        <span>05</span>
                                                    </th>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <span>สมาชิก</span>
                                                                @foreach ($projectActive->members as $member)
                                                                    @if ($confirmStudents->where('id_student', $member->id_student)->where('id_document', 5)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $member->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $member->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>อาจารย์ที่ปรึกษา</span>
                                                                @foreach ($projectActive->advisers->where('id_position', 1) as $adviser)
                                                                    @if ($confirmTeachers->where('id_teacher', $adviser->id_teacher)->where('id_document', 5)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $adviser->teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $adviser->teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>อาจารย์ประจำวิชา</span>
                                                                @foreach ($teachers->where('user_type', 'Admin') as $teacher)
                                                                    @if ($confirmTeachers->where('id_teacher', $teacher->id_teacher)->where('id_document', 5)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>หัวหน้าสาขา</span>
                                                                @foreach ($teachers->where('user_type', 'Branch head') as $teacher)
                                                                    @if ($confirmTeachers->where('id_teacher', $teacher->id_teacher)->where('id_document', 5)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </a>
                            <!-- status 06 -->
                            <a href="#">
                                @php
                                    $directorConfirmed = $confirmTeachers
                                        ->where('id_teacher', optional($directors->first())->id_teacher)
                                        ->where('id_document', 6)
                                        ->first();
                                    $teacherConfirmed =
                                        $directorConfirmed &&
                                        $confirmTeachers
                                            ->where(
                                                'id_teacher',
                                                optional($teachers->where('user_type', 'Branch head')->first())
                                                    ->id_teacher,
                                            )
                                            ->where('id_document', 6)
                                            ->first();
                                @endphp
                                <div
                                    class="card {{ $teacherConfirmed ? 'completed' : ($directorConfirmed ? 'processing' : '') }}">
                                    <div class="card-body">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        <span>06</span>
                                                    </th>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <span>กรรมการ</span>
                                                                @foreach ($directors->where('id_document', 6) as $director)
                                                                    @if ($confirmTeachers->where('id_teacher', $director->id_teacher)->where('id_document', 6)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $director->teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $director->teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>อาจารย์ประจำวิชา</span>
                                                                @foreach ($teachers->where('user_type', 'Admin') as $teacher)
                                                                    @if ($confirmTeachers->where('id_teacher', $teacher->id_teacher)->where('id_document', 6)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>หัวหน้าสาขา</span>
                                                                @foreach ($teachers->where('user_type', 'Branch head') as $teacher)
                                                                    @if ($confirmTeachers->where('id_teacher', $teacher->id_teacher)->where('id_document', 6)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </a>
                            <!-- status 07 -->
                            <a href="{{ route('pdf07Generate', $projectActive->id_project) }}" target="_blank">
                                @php
                                    $studentConfirmed = $confirmStudents->where('id_document', 7)->first();
                                    $teacherConfirmed =
                                        $studentConfirmed &&
                                        $confirmTeachers
                                            ->where(
                                                'id_teacher',
                                                optional($teachers->where('user_type', 'Branch head')->first())
                                                    ->id_teacher,
                                            )
                                            ->where('id_document', 7)
                                            ->first();
                                @endphp

                                <div
                                    class="card {{ $teacherConfirmed ? 'completed' : ($studentConfirmed ? 'processing' : '') }}">

                                    <div class="card-body">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        <span>07</span>
                                                    </th>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <span>สมาชิก</span>
                                                                @foreach ($projectActive->members as $member)
                                                                    @if ($confirmStudents->where('id_student', $member->id_student)->where('id_document', 7)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $member->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $member->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>อาจารย์ที่ปรึกษา</span>
                                                                @foreach ($projectActive->advisers->where('id_position', 1) as $adviser)
                                                                    @if ($confirmTeachers->where('id_teacher', $adviser->id_teacher)->where('id_document', 7)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $adviser->teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $adviser->teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>กรรมการ</span>
                                                                @foreach ($directors->where('id_document', 7) as $director)
                                                                    @if ($confirmTeachers->where('id_teacher', $director->id_teacher)->where('id_document', 7)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $director->teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $director->teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>อาจารย์ประจำวิชา</span>
                                                                @foreach ($teachers->where('user_type', 'Admin') as $teacher)
                                                                    @if ($confirmTeachers->where('id_teacher', $teacher->id_teacher)->where('id_document', 7)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                <span>หัวหน้าสาขา</span>
                                                                @foreach ($teachers->where('user_type', 'Branch head') as $teacher)
                                                                    @if ($confirmTeachers->where('id_teacher', $teacher->id_teacher)->where('id_document', 7)->first())
                                                                        <div class="confirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="unconfirmed">
                                                                            {{ $loop->iteration }}
                                                                            <span class="tooltipText">
                                                                                {{ $teacher->name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                        <p>ไม่พบโปรเจค</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>

@script
    <script>
        const examCountdown = () => {
            // ดึงข้อมูลจาก Blade
            const examDay =
                "{{ $examCountDates->exam_day ?? now()->addMonth()->startOfMonth()->format('Y-m-d') }}"; // รูปแบบ YYYY-MM-DD
            const examTime = "{{ $examCountDates->exam_time ?? '00:00:00' }}"; // รูปแบบ HH:MM:SS

            // สร้าง Date object โดยรวม examDay และ examTime เข้าด้วยกัน
            const countDateStr = `${examDay}T${examTime}Z`;
            const countDate = new Date(countDateStr).getTime();

            const now = new Date().getTime();
            const gap = countDate - now;

            const second = 1000;
            const minute = second * 60;
            const hour = minute * 60;
            const day = hour * 24;

            const textDay = Math.floor(gap / day);
            const textHour = Math.floor((gap % day) / hour);
            const textMinute = Math.floor((gap % hour) / minute);
            const textSecond = Math.floor((gap % minute) / second);

            document.getElementById('days').innerText = textDay;
            document.getElementById('hours').innerText = textHour;
            document.getElementById('minutes').innerText = textMinute;
            document.getElementById('seconds').innerText = textSecond;
        };

        setInterval(examCountdown, 1000);
    </script>
@endscript
