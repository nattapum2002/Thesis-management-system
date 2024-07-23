<div>
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $projects->count() }}</h3>
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
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $projects->where('project_status', 'In Progress')->count() }}</h3>
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
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $projects->where('project_status', 'Completed')->count() }}</h3>
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
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $projects->where('project_status', 'Cancelled')->count() }}</h3>
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
    <div class="row">
        <section class="col-md-7 connectedSortable">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class='bx bxs-user-account'></i>
                        บัญชีสมาชิก
                    </div>
                    <div class="card-tools">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/manage_member">
                                    จัดการบัญชีสมาชิก
                                    <i class='bx bxs-right-arrow'></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="memberChart" style="width:100%;max-width:600px"></canvas>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class='bx bxs-user-account'></i>
                                บทความปริญญานิพนธ์
                            </div>
                            <div class="card-tools">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/admin/approve_thesis">
                                            ...
                                            <i class='bx bxs-right-arrow'></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart text-center">
                                <canvas id="thesisChart" style="width:100%;max-width:600px"></canvas>
                                <p>บทความปริญญานิพนธ์</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <i class='bx bxs-user-account'></i>
                                ข่าวประชาสัมพันธ์
                            </div>
                            <div class="card-tools">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/admin/approve_news">
                                            ...
                                            <i class='bx bxs-right-arrow'></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart text-center">
                                <canvas id="newsChart" style="width:100%;max-width:600px"></canvas>
                                <p>ข่าวประชาสัมพันธ์</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="col-md-5 connectedSortable">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class='bx bxs-user-account'></i>
                        บัญชีอาจารย์
                    </div>
                    <div class="card-tools">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/manage_teacher">
                                    จัดการบัญชีอาจารย์
                                    <i class='bx bxs-right-arrow'></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart text-center">
                        <canvas id="teacherChart" style="width:100%;max-width:600px"></canvas>
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
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/approve_documents">
                                    อนุมัติเอกสาร
                                    <i class='bx bxs-right-arrow'></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    @if ($confirms->isNotEmpty())
                        <div class="chart">
                            <canvas id="confirmChart" style="width:100%;max-width:600px"></canvas>
                        </div>
                    @else
                        <div class="chart">
                            <p class="text-center">ไม่มีเอกสารให้พิจารณา</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
    <hr>
    <div class="row">
        <section class="col-md-6 connectedSortable">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class='bx bxs-user-account'></i>
                        ที่ปรึกษา
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="adviserChart" style="width:100%;max-width:600px"></canvas>
                    </div>
                </div>
            </div>
        </section>
        <section class="col-md-6 connectedSortable">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class='bx bxs-user-account'></i>
                        คณะกรรมการ
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart text-center">
                        <canvas id="directorChart" style="width:100%;max-width:600px"></canvas>
                        <p>คณะกรรมการ</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
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
                labels: ["ข่าวทั่วไป", "ชื่อหัวข้อ"],
                datasets: [{
                    backgroundColor: ["#1E90FF", "#000000"],
                    data: [{{ $news->where('type', 'ข่าวทั่วไป')->count() }},
                        {{ $news->where('type', 'ชื่อหัวข้อ')->count() }}
                    ]
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
