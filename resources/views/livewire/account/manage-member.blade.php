<div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search" wire:model.live.debounce.150ms="search">
        <button class="btn btn-primary" type="submit"><i class='bx bx-search'></i></button>
    </div>
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table text-nowrap table-striped">
                <thead>
                    <tr>
                        <th>รหัสนักศึกษา</th>
                        <th>คำนำหน้า</th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>หลักสูตร</th>
                        <th>สถานะบัญชี</th>
                        <th></th>
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
                            <p class="text-success">อนุมัติ</p>
                            @else
                            <p class="text-danger">ถูกระงับ</p>
                            @endif
                        </td>
                        <td>
                            <a href="/admin/approve_member/{{ $member->id_student }}" class="btn btn-primary"><i
                                    class='bx bx-detail'></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
