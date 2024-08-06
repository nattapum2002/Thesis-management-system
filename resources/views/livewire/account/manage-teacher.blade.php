<div>
    @if (session('danger'))
        <div class="alert alert-danger" role="alert">
            {{ session('danger') }}
        </div>
    @elseif (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search" wire:model.live.debounce.150ms="search">
            <button class="btn btn-orange" type="submit"><i class='bx bx-search'></i></button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-start">
                <a href="/admin/add_teacher" class="btn btn-success">เพิ่มบัญชีอาจารย์</a>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table text-nowrap table-striped">
                <thead>
                    <tr>
                        <th>
                            <a wire:click="sortBy('id_teacher')">
                                <span>ID</span>
                                <i class='bx bx-transfer-alt bx-rotate-90'></i>
                            </a>
                        </th>
                        <th>
                            <a wire:click="sortBy('prefix')">
                                <span>คำนำหน้า</span>
                                <i class='bx bx-transfer-alt bx-rotate-90'></i>
                            </a>
                        </th>
                        <th>
                            <a wire:click="sortBy('name')">
                                <span>ชื่อ</span>
                                <i class='bx bx-transfer-alt bx-rotate-90'></i>
                            </a>
                        </th>
                        <th>
                            <a wire:click="sortBy('surname')">
                                <span>นามสกุล</span>
                                <i class='bx bx-transfer-alt bx-rotate-90'></i>
                            </a>
                        </th>
                        <th>
                            <a wire:click="sortBy('user_type')">
                                <span>ประเภทบัญชี</span>
                                <i class='bx bx-transfer-alt bx-rotate-90'></i>
                            </a>
                        </th>
                        <th>
                            <a wire:click="sortBy('account_status')">
                                <span>สถานะ</span>
                                <i class='bx bx-transfer-alt bx-rotate-90'></i>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        {{-- @dd($teachers->where('user_type', $teacher->user_type)->count()) --}}
                        <tr>
                            <td>{{ $teacher->id_teacher }}</td>
                            <td>{{ $teacher->prefix }}</td>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->surname }}</td>
                            <td>{{ $teacher->user_type }}</td>
                            <td>
                                @php
                                    $teachersCount = $teachers->where('user_type', $teacher->user_type)->count();
                                    $isTeacherActive = $teacher->account_status == '1';
                                @endphp

                                @if ($teachersCount < 2)
                                    <a wire:click='{{ $isTeacherActive ? 'show' : 'hide' }}({{ $teacher->id_teacher }})'
                                        class="btn btn-{{ $isTeacherActive ? 'success' : 'danger' }} disabled">
                                        <i class='bx bx-{{ $isTeacherActive ? 'user-check' : 'user-x' }}'></i>
                                    </a>
                                @else
                                    <a wire:click='{{ $isTeacherActive ? 'show' : 'hide' }}({{ $teacher->id_teacher }})'
                                        class="btn btn-{{ $isTeacherActive ? 'success' : 'danger' }}">
                                        <i class='bx bx-{{ $isTeacherActive ? 'user-check' : 'user-x' }}'></i>
                                    </a>
                                @endif

                                <a href="/admin/approve_teacher/{{ $teacher->id_teacher }}" class="btn btn-orange"><i
                                        class='bx bx-detail'></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row gy-3">
            <div class="col-12">
                <p class="page-number">
                    แสดงบัญชีอาจารย์ <b>{{ $teachers->firstItem() }}</b>
                    ถึง <b>{{ $teachers->lastItem() }}</b>
                    จากทั้งหมด <b>{{ $teachers->total() }}</b> บัญชี
                </p>
                {{ $teachers->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
