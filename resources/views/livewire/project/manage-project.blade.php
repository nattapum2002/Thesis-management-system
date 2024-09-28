<div>
    <section id="manage-project">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="mb-2">
                    <input type="text" class="form-control" placeholder="ค้นหาโปรเจค..."
                        wire:model.live.debounce.150ms="search">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="mb-2">
                    <select class="form-select" wire:model.live="filterAdviser">
                        @if (Auth::guard('teachers')->user()->user_type == 'Admin')
                            <option value="all">ทั้งหมด</option>
                        @endif
                        <option value="adviserAll">ที่ปรึกษาทั้งหมด</option>
                        <option value="1">ที่ปรึกษาหลัก</option>
                        <option value="2">ที่ปรึกษาร่วม</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="mb-2">
                    <select class="form-select" wire:model.live.debounce.100ms="filterStatus">
                        <option value="all">ทุกสถานะ</option>
                        @foreach ($status as $item)
                            <option value="{{ $item->project_status }}">{{ $item->project_status }}</option>
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
                                    @foreach (['id_project' => 'ID', 'project_name_th' => 'ชื่อโปรเจค', 'member.name' => 'ชื่อนักศึกษา', 'teacher.name' => 'ชื่ออาจารย์ที่ปรึกษา', 'project_status' => 'สถานะการดำเนินงาน'] as $field => $label)
                                        <th>
                                            <a wire:click="sortBy('{{ $field }}')">
                                                <span>{{ $label }}</span>
                                                <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                            </a>
                                        </th>
                                    @endforeach
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
                                                <p>{{ $member->prefix }} {{ $member->name }} {{ $member->surname }}
                                                </p>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($project->advisers->where('id_position', 1) as $adviser)
                                                <p>{{ $adviser->teacher->prefix }} {{ $adviser->teacher->name }}
                                                    {{ $adviser->teacher->surname }}</p>
                                            @endforeach
                                            @foreach ($project->advisers->where('id_position', 2) as $adviser)
                                                <small>{{ $adviser->teacher->prefix }}
                                                    {{ $adviser->teacher->name }}
                                                    {{ $adviser->teacher->surname }}</small><br>
                                            @endforeach
                                        </td>
                                        <td>{{ $project->project_status }}</td>
                                        <td>
                                            @php
                                                $userType = Auth::guard('teachers')->user()->user_type;
                                                $route = match ($userType) {
                                                    'Admin' => 'admin.detail.project',
                                                    'Branch head' => 'branch-head.detail.project',
                                                    default => 'teacher.detail.project',
                                                };
                                            @endphp

                                            <a class="btn btn-orange btn-sm"
                                                href="{{ route($route, $project->id_project) }}"><i
                                                    class='bx bx-detail'></i></a>

                                            {{-- <div class="dropdown" style="float: right;">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class='bx bx-printer'></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @foreach (range(1, 7) as $num)
                                                        <li><a class="dropdown-item"
                                                                href="/pdf/{{ sprintf('%02d', $num) }}/{{ $project->id_project }}"
                                                                target="_blank">เอกสาร
                                                                คกท.-คง.-{{ sprintf('%02d', $num) }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div> --}}

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row gy-2">
                        <div class="col-lg-12">
                            <p class="page-number">
                                แสดงโปรเจค <b>{{ $projects->firstItem() }}</b>
                                ถึง <b>{{ $projects->lastItem() }}</b>
                                จากทั้งหมด <b>{{ $projects->total() }}</b> โปรเจค
                            </p>
                            {{ $projects->onEachSide(2)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
