<div>
    <section id="teacher-chart">
        <div class="row gy-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class='bx bxs-user-account'></i>
                            ที่ปรึกษา
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="adviserChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class='bx bxs-user-account'></i>
                            คณะกรรมการ
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart text-center">
                            <canvas id="directorChart"></canvas>
                            <p>คณะกรรมการ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="schedule">
        <div class="row gy-2">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class='bx bxs-calendar'></i>
                            รายละเอียดที่ปรึกษา
                        </div>
                        <div class="card-tools">
                            <a class="tools-link" href="{{ route('teacher.manage.project') }}">
                                <span>จัดการรายละเอียดที่ปรึกษา</span>
                                <i class='bx bxs-right-arrow'></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table text-nowrap table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>ชื่อโปรเจค</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td></td>
                                        <td>{{ $project->id_project }}</td>
                                        <td>
                                            <p>{{ $project->project_name_th }}</p>
                                            <small>{{ $project->project_name_en }}</small>
                                        </td>
                                        <td>{{ $project->project_status }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="row">
                        <div class="col-lg-12">
                            <p class="page-number">
                                แสดงกำหนดการ <b>{{ $documentSchedules->firstItem() }}</b>
                                ถึง <b>{{ $documentSchedules->lastItem() }}</b>
                                จากทั้งหมด <b>{{ $documentSchedules->total() }}</b> กำหนดการ
                            </p>
                            {{ $documentSchedules->onEachSide(2)->links('pagination::bootstrap-4') }}
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class='bx bxs-calendar'></i>
                            ตารางสอบ
                        </div>
                        <div class="card-tools">
                            <a class="tools-link" href="{{ route('teacher.manage.exam.schedule') }}">
                                <span>รายละเอียดตารางสอบ</span>
                                <i class='bx bxs-right-arrow'></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table text-nowrap table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>วันที่</th>
                                    <th>เวลา</th>
                                    <th>ชื่อโปรเจค</th>
                                    <th>ประเภท</th>
                                    <th>ตำแหน่ง</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($examSchedules as $examSchedule)
                                    <tr>
                                        <td></td>
                                        <td>{{ thaidate('j M Y', $examSchedule->exam_day) }}</td>
                                        <td>{{ thaidate('H:i น.', $examSchedule->exam_time) }}</td>
                                        <td>
                                            <p>{{ $examSchedule->project->project_name_th }}</p>
                                            <small>{{ $examSchedule->project->project_name_en }}</small>
                                        </td>
                                        <td>{{ $examSchedule->id_document == 3 ? 'สอบหัวข้อ' : 'สอบจบ' }}</td>
                                        <td>
                                            {{ $directors->where('id_project', $examSchedule->id_project)->where('id_document', $examSchedule->id_document)->first()->position->position ?? '' }}
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="row">
                        <div class="col-lg-12">
                            <p class="page-number">
                                แสดงกำหนดการ <b>{{ $examSchedules->firstItem() }}</b>
                                ถึง <b>{{ $examSchedules->lastItem() }}</b>
                                จากทั้งหมด <b>{{ $examSchedules->total() }}</b> กำหนดการ
                            </p>
                            {{ $examSchedules->onEachSide(2)->links('pagination::bootstrap-4') }}
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
</div>

@script
    <script>
        new Chart(document.getElementById('adviserChart').getContext('2d'), {
            type: "bar",
            data: {
                labels: ["โปรเจคที่กําลังดําเนินการ",
                    "โปรเจคที่เสร็จสิ้น",
                    "โปรเจคที่ยกเลิก"
                ],
                datasets: [{
                    label: "ที่ปรึกษาหลัก",
                    backgroundColor: "#4B0082",
                    data: [
                        {{ $advisers->where('project.project_status', 'pending')->where('id_position', 1)->count() }},
                        {{ $advisers->where('project.project_status', 'completed')->where('id_position', 1)->count() }},
                        {{ $advisers->where('project.project_status', 'reject')->where('id_position', 1)->count() }},
                    ]
                }, {
                    label: "ที่ปรึกษาร่วม",
                    backgroundColor: "#98FF98",
                    data: [
                        {{ $advisers->where('project.project_status', 'pending')->where('id_position', 2)->count() }},
                        {{ $advisers->where('project.project_status', 'completed')->where('id_position', 2)->count() }},
                        {{ $advisers->where('project.project_status', 'reject')->where('id_position', 2)->count() }},
                    ]
                }, {
                    label: "รวม",
                    backgroundColor: "#A9A9A9",
                    data: [
                        {{ $advisers->where('project.project_status', 'pending')->whereIn('id_position', [1, 2])->count() }},
                        {{ $advisers->where('project.project_status', 'completed')->whereIn('id_position', [1, 2])->count() }},
                        {{ $advisers->where('project.project_status', 'reject')->whereIn('id_position', [1, 2])->count() }},
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }
        });
    </script>
@endscript

@script
    <script>
        new Chart(document.getElementById('directorChart').getContext('2d'), {
            type: "pie",
            data: {
                labels: ["ประธาน", "กรรมการ", "กรรมการและเลขานุการ"],
                datasets: [{
                    backgroundColor: ["#FFD700", "#003366", "#C0C0C0"],
                    data: [
                        {{ $directors->where('id_position', 5)->count() }},
                        {{ $directors->where('id_position', 6)->count() }},
                        {{ $directors->where('id_position', 7)->count() }}
                    ]
                }]
            }
        });
    </script>
@endscript
