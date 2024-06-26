<div>
    {{-- จัดการโปรเจค --}}
    <div class="card">
        <div class="container">
            <h3>จัดการโปรเจค</h3>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" wire:model.live.debounce.150ms="search">
                <button class="btn btn-primary" type="submit"><i class='bx bx-search'></i></button>
            </div>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>ชื่อโปรเจค</th>
                        <th>ชื่อนักศึกษา</th>
                        <th>ชื่ออาจารย์ที่ปรึกษา</th>
                        <th>สถานะการดำเนินงาน</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
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
                            <p>{{ $adviser->teacher->prefix }} {{ $adviser->teacher->name }} {{
                                $adviser->teacher->surname }}</p>
                            @endif
                            @endforeach
                            @foreach ($project->advisers as $adviser)
                            @if ($adviser->id_position == 2)
                            <small>{{ $adviser->teacher->prefix }} {{ $adviser->teacher->name }} {{
                                $adviser->teacher->surname }}</small><br>
                            @endif
                            @endforeach
                        </td>
                        <td>{{ $project->project_status }}</td>
                        <td class="text-right">
                            <a class="btn btn-primary btn-sm" href="#">รายละเอียด</a>
                            <a class="btn btn-success btn-sm" href="#">อนุมัติหัวข้อ</a>
                            <a class="btn btn-danger btn-sm" href="#"
                                wire:click.prevent="delete({{ $project->id_project }})">ยกเลิกหัวข้อ</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- <div class="d-flex justify-content-center">
            {{ $articles->onEachSide(1)->links('pagination::bootstrap-4') }}
        </div> --}}
    </div>

    {{-- รายละเอียดโปรเจค --}}
    <div class="card">
        <div class="container">
            <h3>รายละเอียดโปรเจค</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 20%">หัวข้อ</th>
                        <th style="width: auto">รายละเอียด</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>ชื่อโปรเจค</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            <p>ระบบจัดการปริญญานิพนธ์</p>
                            <small>Thesis Management System</small>
                        </td>
                    </tr>
                    <tr>
                        <th>ชื่อนักศึกษา</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            <p>นายณัฐภูมิ ขำศรี</p>
                            <p>นักศึกษา 2</p>
                            <p>นักศึกษา 3</p>
                        </td>
                    </tr>
                    <tr>
                        <th>ชื่ออาจารย์ที่ปรึกษาหลัก</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            อาจารย์ 1
                        </td>
                    </tr>
                    <tr>
                        <th>ชื่ออาจารย์ที่ปรึกษาร่วม</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            <p>อาจารย์ 2</p>
                            <p>อาจารย์ 3</p>
                            <p>อาจารย์ 4</p>
                        </td>
                    </tr>
                    <tr>
                        <th>สถานะการดำเนินงาน</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            กำลังดำเนินการอนุมัติ 01
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
