<div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search" wire:model.live.debounce.150ms="search">
        <button class="btn btn-primary" type="submit"><i class='bx bx-search'></i></button>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>คำนำหน้า</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>ประเภทผู้ใช้งาน</th>
                <th>สถานะบัญชี</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $teacher)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $teacher->prefix }}</td>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->surname }}</td>
                <td>{{ $teacher->user_type }}</td>
                <td>
                    @if ($teacher->account_status == '1')
                    บัญชียังถูกใช้งาน
                    @else
                    บัญชีถูกยกเลิก
                    @endif
                </td>
                <td>
                    <a href="/admin/edit_and_detail_teacher/{{ $teacher->id_teacher }}" class="btn btn-primary"><i
                            class='bx bx-detail'></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>



    {{-- <div class="d-flex justify-content-center">
        {{ $teachers->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div> --}}
</div>
