<div>
    <section id="manage-project">
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
                                        <a wire:click="sortBy('id_project')">
                                            <span>ID</span>
                                            <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a wire:click="sortBy('project_name_th')">
                                            <span>ชื่อโปรเจค</span>
                                            <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a wire:click="sortBy('member.name')">
                                            <span>ชื่อนักศึกษา</span>
                                            <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a wire:click="sortBy('teacher.name')">
                                            <span>ชื่ออาจารย์ที่ปรึกษา</span>
                                            <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a wire:click="sortBy('project_status')">
                                            <span>สถานะการดำเนินงาน</span>
                                            <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                        </a>
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $project->id_project }}</td>
                                        <td>
                                            <p>{{ $project->project_name_th }}</p>
                                            <small>{{ $project->project_name_en }}</small>
                                        </td>
                                        <td>
                                            @foreach ($project->members as $member)
                                                <p>{{ $member->prefix }} {{ $member->name }} {{ $member->surname }}</p>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($project->advisers as $adviser)
                                                @if ($adviser->id_position == 1)
                                                    <p>{{ $adviser->teacher->prefix }} {{ $adviser->teacher->name }}
                                                        {{ $adviser->teacher->surname }}</p>
                                                @endif
                                            @endforeach
                                            @foreach ($project->advisers as $adviser)
                                                @if ($adviser->id_position == 2)
                                                    <small>{{ $adviser->teacher->prefix }}
                                                        {{ $adviser->teacher->name }}
                                                        {{ $adviser->teacher->surname }}</small><br>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $project->project_status }}</td>
                                        <td>
                                            <a class="btn btn-orange btn-sm" style="float: right;"
                                                href="/admin/detail_project/{{ $project->id_project }}">รายละเอียด</a>
                                            <div class="dropdown" style="float: right;">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class='bx bx-printer'></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item"
                                                            href="/pdf/01/{{ $project->id_project }}"
                                                            target="_blank">เอกสาร คกท.-คง.-01</a></li>
                                                    <li><a class="dropdown-item"
                                                            href="/pdf/02/{{ $project->id_project }}"
                                                            target="_blank">เอกสาร คกท.-คง.-02</a></li>
                                                    <li><a class="dropdown-item"
                                                            href="/pdf/03/{{ $project->id_project }}"
                                                            target="_blank">เอกสาร คกท.-คง.-03</a></li>
                                                    <li><a class="dropdown-item"
                                                            href="/pdf/04/{{ $project->id_project }}"
                                                            target="_blank">เอกสาร คกท.-คง.-04</a></li>
                                                    <li><a class="dropdown-item"
                                                            href="/pdf/05/{{ $project->id_project }}"
                                                            target="_blank">เอกสาร คกท.-คง.-05</a></li>
                                                    <li><a class="dropdown-item"
                                                            href="/pdf/06/{{ $project->id_project }}"
                                                            target="_blank">เอกสาร คกท.-คง.-06</a></li>
                                                    <li><a class="dropdown-item"
                                                            href="/pdf/07/{{ $project->id_project }}"
                                                            target="_blank">เอกสาร คกท.-คง.-07</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row gy-3">
                        <div class="col-12">
                            <p class="page-number">
                                แสดงโปรเจค <b>{{ $projects->firstItem() }}</b>
                                ถึง <b>{{ $projects->lastItem() }}</b>
                                จากทั้งหมด <b>{{ $projects->total() }}</b> โปรเจค
                            </p>
                            {{ $projects->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
