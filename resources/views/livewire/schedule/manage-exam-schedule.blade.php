<div>
    @if (Auth::guard('teachers')->check())
        <section id="manage-exam-schedule">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="mb-2">
                        <input type="text" class="form-control" placeholder="ค้นหาการสอบ..."
                            wire:model.live.debounce.150ms="search">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-2">
                        <select class="form-select" wire:model.live.debounce.100ms="filterDirector">
                            @if (Auth::guard('teachers')->user()->user_type == 'Admin')
                                <option value="ทั้งหมด">ทั้งหมด</option>
                            @endif
                            <option value="กรรมการ">เป็นกรรมการ</option>
                            <option value="1">เป็นที่ปรึกษา</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-2">
                        <select class="form-select" wire:model.live.debounce.100ms="filterType">
                            <option value="ทุกประเภท">ทุกประเภท</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id_document }}">
                                    {{ $type->id_document == 3 ? 'สอบหัวข้อ' : 'สอบจบ' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
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
                                        <tr>
                                            <td>{{ $exam_schedule->id_exam_schedule }}</td>
                                            <td>
                                                <p>{{ $exam_schedule->project->project_name_th }}</p>
                                                <small>{{ $exam_schedule->project->project_name_en }}</small>
                                            </td>
                                            <td>
                                                @foreach ($directors->where('id_project', $exam_schedule->id_project)->where('id_document', $exam_schedule->id_document)->sortBy('id_position') as $director)
                                                    @php
                                                        $name =
                                                            $director->teacher->prefix .
                                                            ' ' .
                                                            $director->teacher->name .
                                                            ' ' .
                                                            $director->teacher->surname;
                                                    @endphp
                                                    {!! $director->id_position == 5 ? "<p>$name</p>" : "<small>$name</small><br>" !!}
                                                @endforeach
                                            </td>
                                            <td>
                                                <p>{{ $exam_schedule->id_document == 3 ? 'สอบหัวข้อ' : 'สอบจบ' }}</p>
                                            </td>
                                            <td>
                                                <p>{{ thaidate('H:i น.', $exam_schedule->exam_time) }}</p>
                                                <small>{{ thaidate('j M Y', $exam_schedule->exam_day) }}</small>
                                            </td>
                                            <td>
                                                <p>{{ $exam_schedule->exam_room }}</p>
                                                <small>{{ $exam_schedule->exam_building . ' ' . $exam_schedule->exam_group }}</small>
                                            </td>
                                            <td>
                                                @if (Auth::guard('teachers')->user()->user_type == 'Admin')
                                                    <a class="btn btn-orange btn-sm"
                                                        href="{{ route('admin.edit.detail.exam.schedule', $exam_schedule->id_exam_schedule) }}">
                                                        <i class="bx bx-detail"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row gy-2">
                            <div class="col-lg-12">
                                <p class="page-number">
                                    แสดงกำหนดการ <b>{{ $exam_schedules->firstItem() }}</b>
                                    ถึง <b>{{ $exam_schedules->lastItem() }}</b>
                                    จากทั้งหมด <b>{{ $exam_schedules->total() }}</b> รายการ
                                </p>
                                {{ $exam_schedules->onEachSide(2)->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section id="manage-exam-schedule">
            <div class="row">
                <div class="col-lg-9 col-md-6 col-sm-12">
                    <div class="mb-2">
                        <input type="text" class="form-control" placeholder="ค้นหาการสอบ..."
                            wire:model.live.debounce.150ms="search">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-2">
                        <select class="form-select" wire:model.live.debounce.100ms="filterType">
                            <option value="ทุกประเภท">ทุกประเภท</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id_document }}">
                                    {{ $type->id_document == 3 ? 'สอบหัวข้อ' : 'สอบจบ' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
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
                                        <tr>
                                            <td>{{ $exam_schedule->id_exam_schedule }}</td>
                                            <td>
                                                <p>{{ $exam_schedule->project->project_name_th }}</p>
                                                <small>{{ $exam_schedule->project->project_name_en }}</small>
                                            </td>
                                            <td>
                                                @foreach ($directors->where('id_project', $exam_schedule->id_project)->sortBy('id_position') as $director)
                                                    @php
                                                        $name =
                                                            $director->teacher->prefix .
                                                            ' ' .
                                                            $director->teacher->name .
                                                            ' ' .
                                                            $director->teacher->surname;
                                                    @endphp
                                                    {!! $director->id_position == 5 ? "<p>$name</p>" : "<small>$name</small><br>" !!}
                                                @endforeach
                                            </td>
                                            <td>
                                                <p>{{ $exam_schedule->id_document == 3 ? 'สอบหัวข้อ' : 'สอบจบ' }}</p>
                                            </td>
                                            <td>
                                                <p>{{ thaidate('H:i น.', $exam_schedule->exam_time) }}</p>
                                                <small>{{ thaidate('j M Y', $exam_schedule->exam_day) }}</small>
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
                        <div class="row gy-2">
                            <div class="col-lg-12">
                                <p class="page-number">
                                    แสดงกำหนดการ <b>{{ $exam_schedules->firstItem() }}</b>
                                    ถึง <b>{{ $exam_schedules->lastItem() }}</b>
                                    จากทั้งหมด <b>{{ $exam_schedules->total() }}</b> รายการ
                                </p>
                                {{ $exam_schedules->onEachSide(2)->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
