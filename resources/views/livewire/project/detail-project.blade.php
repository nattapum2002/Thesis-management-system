<div>
    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table text-nowrap table-striped">
                <thead>
                    <tr>
                        <th style="min-width: 160px">หัวข้อ</th>
                        <th>รายละเอียด</th>
                        <th style="min-width: 160px"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>ชื่อโปรเจค</th>
                        <td>
                            <p>{{ $project->project_name_th }}</p>
                            <small>{{ $project->project_name_en }}</small>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>ชื่อนักศึกษา</th>
                        <td>
                            @foreach ($project->members as $member)
                                <p>{{ $member->prefix }} {{ $member->name }} {{ $member->surname }}</p>
                            @endforeach
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>ชื่ออาจารย์ที่ปรึกษาหลัก</th>
                        <td>
                            @foreach ($project->advisers as $adviser)
                                @if ($adviser->id_position == 1)
                                    <p>{{ $adviser->teacher->prefix . ' ' . $adviser->teacher->name . ' ' . $adviser->teacher->surname }}
                                @endif
                            @endforeach
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>ชื่ออาจารย์ที่ปรึกษาร่วม</th>
                        <td>
                            @foreach ($project->advisers as $adviser)
                                @if ($adviser->id_position == 2)
                                    <p>{{ $adviser->teacher->prefix . ' ' . $adviser->teacher->name . ' ' . $adviser->teacher->surname }}
                                @endif
                            @endforeach
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>สถานะการดำเนินงาน</th>
                        <td>
                            <p>{{ $project->project_status }}</p>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>หมายเหตุ</th>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-orange dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class='bx bx-printer'></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/pdf/01/{{ $project->id_project }}"
                                            target="_blank">เอกสาร คกท.-คง.-01</a></li>
                                    <li><a class="dropdown-item" href="/pdf/02/{{ $project->id_project }}"
                                            target="_blank">เอกสาร คกท.-คง.-02</a></li>
                                    <li><a class="dropdown-item" href="/pdf/03/{{ $project->id_project }}"
                                            target="_blank">เอกสาร คกท.-คง.-03</a></li>
                                    <li><a class="dropdown-item" href="/pdf/04/{{ $project->id_project }}"
                                            target="_blank">เอกสาร คกท.-คง.-04</a></li>
                                    <li><a class="dropdown-item" href="/pdf/05/{{ $project->id_project }}"
                                            target="_blank">เอกสาร คกท.-คง.-05</a></li>
                                    <li><a class="dropdown-item" href="/pdf/06/{{ $project->id_project }}"
                                            target="_blank">เอกสาร คกท.-คง.-06</a></li>
                                    <li><a class="dropdown-item" href="/pdf/07/{{ $project->id_project }}"
                                            target="_blank">เอกสาร คกท.-คง.-07</a></li>
                                </ul>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
