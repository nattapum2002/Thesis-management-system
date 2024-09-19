<div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-4">
                    <h3>จัดการเอกสาร 01 ยื่นอนุมัติหัวข้อ</h3>
                </div>
                <div class="col-sm-5">
                    <a class="btn btn-success" href="{{ route('member.create.document-01') }}">เพิ่มเอกสาร 01</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="text-center">
                    <tr>
                        <th style="width: 20%">หัวข้อ</th>
                        <th style="width: 30%">สมาชิก</th>
                        <th style="width: 20%">ที่ปรึกษา</th>
                        <th style="width: auto">รายละเอียด</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    {{-- @foreach ($projects as $projectItems)
                        <tr class="">
                            <td>{{ $projectItems->project_name_th }} <br> {{ $projectItems->project_name_en }}</td>
                            <td>
                                @foreach ($projectItems->members as $memberItems)
                                    {{ $memberItems->name }} {{ $memberItems->surname }} {{ $memberItems->course->course}}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($projectItems->teachers->where('pivot.id_position', 1) as $teacherItems)
                                    <span>ที่ปรึกษาหลัก</span> {{ $teacherItems->name }}<br>
                                @endforeach
                                @foreach ($projectItems->teachers->where('pivot.id_position', 2) as $teacherItems)
                                    <span>ที่ปรึกษาร่วม</span> {{ $teacherItems->name }}<br>
                                @endforeach
                            </td>
                            <td>

                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
