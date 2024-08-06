<div>
    <section id="manage-exam-schedule">
        <div class="row">
            <div class="col-12">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" wire:model.live.debounce.150ms="search">
                    <button class="btn btn-orange" type="submit"><i class='bx bx-search'></i></button>
                </div>
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table text-nowrap table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <a wire:click="sortBy('id_exam_schedule')">
                                            <span>ID</span>
                                            <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a wire:click="sortBy('projects.project_name_th')">
                                            <span>ชื่อโปรเจค</span>
                                            <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a wire:click="sortBy('teachers.name')">
                                            <span>รายชื่อกรรมการ</span>
                                            <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a wire:click="sortBy('id_document')">
                                            <span>ประเภทการสอบ</span>
                                            <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a wire:click="sortBy('exam_time')">
                                            <span>เวลาสอบ</span>
                                            <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a wire:click="sortBy('exam_room')">
                                            <span>สถานที่สอบ</span>
                                            <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                        </a>
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exam_schedules as $exam_schedule)
                                    {{-- @dd($director->teacher) --}}
                                    <tr>
                                        <td>{{ $exam_schedule->id_exam_schedule }}</td>
                                        <td>
                                            <p>{{ $exam_schedule->project->project_name_th }}</p>
                                            <small>{{ $exam_schedule->project->project_name_en }}</small>
                                        </td>
                                        <td>

                                            @foreach ($directors->where('id_project', $exam_schedule->id_project)->sortBy('id_position') as $director)
                                                @if ($director->id_position == 5)
                                                    <p>{{ $director->teacher->prefix . ' ' . $director->teacher->name . ' ' . $director->teacher->surname }}
                                                    </p>
                                                @else
                                                    <small>{{ $director->teacher->prefix . ' ' . $director->teacher->name . ' ' . $director->teacher->surname }}</small><br>
                                                @endif
                                            @endforeach

                                        </td>
                                        <td>
                                            <p>{{ $exam_schedule->id_document == 3 ? 'สอบหัวข้อ' : 'สอบจบ' }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $exam_schedule->exam_time }}</p>
                                            <small>{{ $exam_schedule->exam_day }}</small>
                                        </td>
                                        <td>
                                            <p>{{ $exam_schedule->exam_room }}</p>
                                            <small>{{ $exam_schedule->exam_building . ' ' . $exam_schedule->exam_group }}</small>
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row gy-3">
                        <div class="col-12">
                            <p class="page-number">
                                แสดงกำหนดการ <b>{{ $exam_schedules->firstItem() }}</b>
                                ถึง <b>{{ $exam_schedules->lastItem() }}</b>
                                จากทั้งหมด <b>{{ $exam_schedules->total() }}</b> รายการ
                            </p>
                            {{ $exam_schedules->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
