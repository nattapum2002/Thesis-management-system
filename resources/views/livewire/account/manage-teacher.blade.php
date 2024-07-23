<div>
    <div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search" wire:model.live.debounce.150ms="search">
            <button class="btn btn-primary" type="submit"><i class='bx bx-search'></i></button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <a href="/admin/add_teacher" class="btn btn-success">เพิ่มบัญชีอาจารย์</a>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table text-nowrap table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>คำนำหน้า</th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>ประเภทผู้ใช้งาน</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        {{-- @dd($teachers->where('user_type', $teacher->user_type)->count()) --}}
                        <tr>
                            <td>{{ $loop->iteration }}</td>
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

                                <a href="/admin/approve_teacher/{{ $teacher->id_teacher }}" class="btn btn-primary"><i
                                        class='bx bx-detail'></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $teachers->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
