<div>
    <section id="small-boxs">
        <div class="row gy-2 align-items-center justify-content-center">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h2>{{ $projects->count() }}</h2>
                        <p>โปรเจคทังหมด</p>
                    </div>
                    <div class="icon">
                        <i class='bx bx-book'></i>
                    </div>
                    <a href="/admin/manage_project" class="small-box-footer">
                        รายละเอียดเพิ่มเติม
                        <i class='bx bxs-right-arrow'></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h2>{{ $projects->where('project_status', 'In Progress')->count() }}</h2>
                        <p>โปรเจคที่กําลังดําเนินการ</p>
                    </div>
                    <div class="icon">
                        <i class='bx bx-loader'></i>
                    </div>
                    <a href="/admin/manage_project" class="small-box-footer">
                        รายละเอียดเพิ่มเติม
                        <i class='bx bxs-right-arrow'></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h2>{{ $projects->where('project_status', 'Completed')->count() }}</h2>
                        <p>โปรเจคที่เสร็จสิ้น</p>
                    </div>
                    <div class="icon">
                        <i class='bx bx-check-circle'></i>
                    </div>
                    <a href="/admin/manage_project" class="small-box-footer">
                        รายละเอียดเพิ่มเติม
                        <i class='bx bxs-right-arrow'></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h2>{{ $projects->where('project_status', 'Cancelled')->count() }}</h2>
                        <p>โปรเจคที่ยกเลิก</p>
                    </div>
                    <div class="icon">
                        <i class='bx bx-x-circle'></i>
                    </div>
                    <a href="/admin/manage_project" class="small-box-footer">
                        รายละเอียดเพิ่มเติม
                        <i class='bx bxs-right-arrow'></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section id="admin-chart">
        <div class="row gy-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class='bx bxs-user-account'></i>
                            บัญชีสมาชิก
                        </div>
                        <div class="card-tools">
                            <a class="tools-link" href="/admin/manage_member">
                                <span>จัดการบัญชีสมาชิก</span>
                                <i class='bx bxs-right-arrow'></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart text-center">
                            <canvas id="memberChart"></canvas>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row gy-2">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="nav-icon bx bx-bookmarks"></i>
                                    บทความปริญญานิพนธ์
                                </div>
                                <div class="card-tools">
                                    <a class="tools-link" href="/admin/approve_thesis">
                                        <span>จัดการ...</span>
                                        <i class='bx bxs-right-arrow'></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart text-center">
                                    <canvas id="thesisChart"></canvas>
                                    <p>บทความปริญญานิพนธ์</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="nav-icon bx bx-news"></i>
                                    ข่าวประชาสัมพันธ์
                                </div>
                                <div class="card-tools">
                                    <a class="tools-link" href="/admin/approve_news">
                                        <span>จัดการ...</span>
                                        <i class='bx bxs-right-arrow'></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart text-center">
                                    <canvas id="newsChart"></canvas>
                                    <p>ข่าวประชาสัมพันธ์</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class='bx bxs-user-account'></i>
                            บัญชีอาจารย์
                        </div>
                        <div class="card-tools">
                            <a class="tools-link" href="/admin/manage_teacher">
                                <span>จัดการบัญชีอาจารย์</span>
                                <i class='bx bxs-right-arrow'></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart text-center">
                            <canvas id="teacherChart"></canvas>
                            <p>บัญชีอาจารย์</p>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class='bx bx-file-find'></i>
                            พิจารณาเอกสาร
                        </div>
                        <div class="card-tools">
                            <a class="tools-link" href="/admin/approve_documents">
                                <span>อนุมัติเอกสาร</span>
                                <i class='bx bxs-right-arrow'></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($confirms->isNotEmpty())
                            <div class="chart">
                                <canvas id="confirmChart"></canvas>
                            </div>
                        @else
                            <div class="chart">
                                <p class="text-center">ไม่มีเอกสารให้พิจารณา</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class='bx bxs-calendar'></i>
                            กำหนดการสอบ
                        </div>
                        <div class="card-tools">
                            <a class="tools-link" href="/admin/manage_exam_schedule">
                                <span>จัดการกำหนดการสอบ</span>
                                <i class='bx bxs-right-arrow'></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table text-nowrap table-striped">
                            <thead>
                                <tr>
                                    <th>วันที่</th>
                                    <th>เวลา</th>
                                    <th>ชื่อโปรเจค</th>
                                    <th>ประเภท</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($examSchedules as $examSchedule)
                                    <tr>
                                        <td>{{ $examSchedule->exam_day }}</td>
                                        <td>{{ $examSchedule->exam_time }}</td>
                                        <td>
                                            <p>{{ $examSchedule->project->project_name_th }}</p>
                                            <small>{{ $examSchedule->project->project_name_en }}</small>
                                        </td>
                                        <td>{{ $examSchedule->id_document == 3 ? 'สอบหัวข้อ' : 'สอบจบ' }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class='bx bxs-calendar'></i>
                            กำหนดการเอกสาร
                        </div>
                        <div class="card-tools">
                            <a class="tools-link" href="/admin/manage_document_schedule">
                                <span>จัดการกำหนดการเอกสาร</span>
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
                                    <th>ชื่อเอกสาร</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documentSchedules as $documentSchedule)
                                    <tr onclick="window.location.href='/admin/edit_and_detail_document_schedule/{{ $documentSchedule->id_submission }}'"
                                        style="cursor:pointer;">
                                        <td></td>
                                        <td>{{ $documentSchedule->date_submission }}</td>
                                        <td>{{ $documentSchedule->time_submission }}</td>
                                        <td>
                                            <p>{{ 'เอกสาร คกท.-คง.-0' . $documentSchedule->id_document }}</p>
                                            <small>{{ $documentSchedule->document->document }}</small>
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@script
    <script>
        new Chart(document.getElementById('memberChart').getContext('2d'), {
            type: "bar",
            data: {
                labels: ["หลักสูตรประกาศนียบัตรวิชาชีพชั้นสูง",
                    "หลักสูตรครุศาสตร์อุตสาหกรรมบัณฑิต",
                    "หลักสูตรวิทยาศาสตรบัณฑิต"
                ],
                datasets: [{
                    label: "ปวส.",
                    backgroundColor: "#FFA500",
                    data: [{{ $members->where('id_course', 1)->where('id_level', 1)->count() }},
                        {{ $members->where('id_course', 2)->where('id_level', 1)->count() }},
                        {{ $members->where('id_course', 3)->where('id_level', 1)->count() }}
                    ]
                }, {
                    label: "ปริญญาตรี 4 ปี",
                    backgroundColor: "#000080",
                    data: [{{ $members->where('id_course', 1)->where('id_level', 2)->count() }},
                        {{ $members->where('id_course', 2)->where('id_level', 2)->count() }},
                        {{ $members->where('id_course', 3)->where('id_level', 2)->count() }}
                    ]
                }, {
                    label: "เทียบโอน",
                    backgroundColor: "#808080",
                    data: [{{ $members->where('id_course', 1)->where('id_level', 3)->count() }},
                        {{ $members->where('id_course', 2)->where('id_level', 3)->count() }},
                        {{ $members->where('id_course', 3)->where('id_level', 3)->count() }}
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            }
        });
    </script>
@endscript

@script
    <script>
        new Chart(document.getElementById('teacherChart').getContext('2d'), {
            type: "doughnut",
            data: {
                labels: ["หัวหน้าสาขา", "อาจารย์ประจำวิชา", "อาจารย์"],
                datasets: [{
                    backgroundColor: ["#003366", "#008000", "#87CEEB"],
                    data: [{{ $teachers->where('user_type', 'Branch head')->count() }},
                        {{ $teachers->where('user_type', 'Admin')->count() }},
                        {{ $teachers->where('user_type', 'Teacher')->count() }}
                    ]
                }]
            }
        });
    </script>
@endscript

@script
    <script>
        new Chart(document.getElementById('thesisChart').getContext('2d'), {
            type: "doughnut",
            data: {
                labels: ["Software", "Hardware"],
                datasets: [{
                    backgroundColor: ["#008080", "#708090"],
                    data: [{{ $thesis->where('type', 'Software')->count() }},
                        {{ $thesis->where('type', 'Hardware')->count() }}
                    ]
                }]
            },
        });
    </script>
@endscript
@script
    <script>
        new Chart(document.getElementById('newsChart').getContext('2d'), {
            type: "doughnut",
            data: {
                labels: @json($chartNewsLabels),
                datasets: [{
                    backgroundColor: @json($chartColors),
                    data: @json($chartNewsData)
                }]
            }
        });
    </script>
@endscript

@script
    <script>
        new Chart(document.getElementById('confirmChart').getContext('2d'), {
            type: "doughnut",
            data: {
                labels: ["พิจารณาแล้ว", "ยังไม่พิจารณา"],
                datasets: [{
                    backgroundColor: ["#006400", "#FF0000"],
                    data: [
                        {{ $confirms->where('confirm_status', 1)->count() }},
                        {{ $confirms->where('confirm_status', 0)->count() }}
                    ]
                }]
            }
        });
    </script>
@endscript

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
                        {{ $advisers->where('project.project_status', 'In Progress')->where('id_position', 1)->count() }},
                        {{ $advisers->where('project.project_status', 'Completed')->where('id_position', 1)->count() }},
                        {{ $advisers->where('project.project_status', 'Cancelled')->where('id_position', 1)->count() }},
                    ]
                }, {
                    label: "ที่ปรึกษาร่วม",
                    backgroundColor: "#98FF98",
                    data: [
                        {{ $advisers->where('project.project_status', 'In Progress')->where('id_position', 2)->count() }},
                        {{ $advisers->where('project.project_status', 'Completed')->where('id_position', 2)->count() }},
                        {{ $advisers->where('project.project_status', 'Cancelled')->where('id_position', 2)->count() }},
                    ]
                }, {
                    label: "รวม",
                    backgroundColor: "#A9A9A9",
                    data: [
                        {{ $advisers->where('project.project_status', 'In Progress')->whereIn('id_position', [1, 2])->count() }},
                        {{ $advisers->where('project.project_status', 'Completed')->whereIn('id_position', [1, 2])->count() }},
                        {{ $advisers->where('project.project_status', 'Cancelled')->whereIn('id_position', [1, 2])->count() }},
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
