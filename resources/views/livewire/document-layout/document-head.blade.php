{{-- <div>
    @foreach ($projects as $projectItems)
        <div class="card">
            <div class="card-body">
                <div class="card-title">{{ $projectItems->confirmTeachers->first()->document->document }} -
                    {{ $projectItems->project_name_th }} {{ $projectItems->project_name_en }}</div>
                <div class="card-text">
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item"><strong>สมาชิก</strong></li>
                        @foreach ($projectItems->confirmStudents as $confirmStudent)
                            <li class="list-group-item">
                                {{ $confirmStudent->student->prefix . ' ' . $confirmStudent->student->name . ' ' . $confirmStudent->student->surname }}
                            </li>
                        @endforeach
                    </ul>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item"><strong>ที่ปรึกษาหลัก</strong></li>
                        @foreach ($advisers->where('id_position', 1) as $mainTeacher)
                            <li class="list-group-item">
                                {{ $mainTeacher->teacher->prefix . ' ' . $mainTeacher->teacher->name . ' ' . $mainTeacher->teacher->surname }}
                            </li>
                        @endforeach
                    </ul>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item"><strong>ที่ปรึกษาร่วม</strong></li>
                        @foreach ($advisers->where('id_position', 2) as $subTeacher)
                            <li class="list-group-item">
                                {{ $subTeacher->teacher->prefix . ' ' . $subTeacher->teacher->name . ' ' . $subTeacher->teacher->surname }}
                            </li>
                        @endforeach
                    </ul>
    @endforeach
</div> --}}

<div>
    <section id="document-head">
        @foreach ($projects as $projectItems)
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ $projectItems->confirmTeachers->first()->document->document }}</h5>
                    <span>{{ $projectItems->project_name_th . ' | ' . $projectItems->project_name_en }}</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <fieldset>
                                <legend>สมาชิก</legend>
                                <ul>
                                    @foreach ($projectItems->confirmStudents as $confirmStudent)
                                        <li>
                                            <p>{{ $confirmStudent->student->prefix . ' ' . $confirmStudent->student->name . ' ' . $confirmStudent->student->surname }}
                                            </p>
                                            <small>{{ 'ระดับ ' . $confirmStudent->student->level->level . ' ภาค ' . $confirmStudent->student->level->sector . ' ' . $confirmStudent->student->course->course }}</small>
                                        </li>
                                    @endforeach
                                </ul>
                            </fieldset>
                            <fieldset>
                                <legend>ที่ปรึกษาหลัก</legend>
                                <ul>
                                    @foreach ($advisers->where('id_position', 1) as $mainTeacher)
                                        <li>
                                            {{ $mainTeacher->teacher->prefix . ' ' . $mainTeacher->teacher->name . ' ' . $mainTeacher->teacher->surname }}
                                        </li>
                                    @endforeach
                                </ul>
                            </fieldset>
                            <fieldset>
                                <legend>ที่ปรึกษาร่วม</legend>
                                <ul>
                                    @foreach ($advisers->where('id_position', 2) as $subTeacher)
                                        <li>
                                            {{ $subTeacher->teacher->prefix . ' ' . $subTeacher->teacher->name . ' ' . $subTeacher->teacher->surname }}
                                        </li>
                                    @endforeach
                                </ul>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
</div>
