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
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-2">
                <input type="text" class="form-control" placeholder="ค้นหาบัญชีนักศึกษา..."
                    wire:model.live.debounce.150ms="search">
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
                                    <a wire:click="sortBy('id_student')">
                                        <span>รหัสนักศึกษา</span>
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
                                    <a wire:click="sortBy('id_course')">
                                        <span>หลักสูตร</span>
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
                            @foreach ($members as $member)
                                <tr>
                                    <td>{{ $member->id_student }}</td>
                                    <td>{{ $member->prefix }}</td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->surname }}</td>
                                    <td>{{ $member->course->course }}</td>
                                    <td>
                                        @if ($member->account_status == '1')
                                            <button wire:click='show("{{ $member->id_student }}")'
                                                class="btn btn-success swalDefaultSuccess"><i
                                                    class='bx bx-user-check'></i></button>
                                        @else
                                            <button wire:click='hide("{{ $member->id_student }}")'
                                                class="btn btn-danger swalDefaultError"><i
                                                    class='bx bx-user-x'></i></button>
                                        @endif
                                        <a href="{{ route('admin.approve.member', $member->id_student) }}"
                                            class="btn btn-orange"><i class='bx bx-detail'></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row gy-2">
                    <div class="col-lg-12">
                        <p class="page-number">
                            แสดงบัญชีสมาชิก <b>{{ $members->firstItem() }}</b>
                            ถึง <b>{{ $members->lastItem() }}</b>
                            จากทั้งหมด <b>{{ $members->total() }}</b> บัญชี
                        </p>
                        {{ $members->onEachSide(2)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
