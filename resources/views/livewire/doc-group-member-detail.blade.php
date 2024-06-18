<div>
    <div class="card">
        <div class="card-header">
            <h3>คุณได้รับเชิญเป็นอาจารย์ที่ปรึกษาหลัก</h3>
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
                    @if ($project)

                    @foreach ($project->members as $member)
                    <tr>
                        <th>นักศึกษาลำดับที่ {{ $loop->iteration }}</th>
                        <td>
                            <b>ชื่อ : </b>{{ $member->prefix }} {{ $member->name }} {{ $member->surname }}
                            <b>รหัสนักศึกษา : </b>{{ $member->id_student }}<br>
                            <b>หลักสูตร : </b>{{ $member->course->course }} <b>สาขา : </b>{{ $member->course->branch
                            }}<br>
                            <b>ระดับ : </b>{{ $member->level->level }} <b>ภาค : </b>{{ $member->level->sector }}
                        </td>
                    </tr>
                    @endforeach

                    <tr>
                        <th>ชื่อเรื่องโครงงานปริญญานิพนธ์</th>
                        <td>
                            <b>ภาษาไทย : </b>{{ $project->project_name_th }}<br>
                            <b>ภาษาอังกฤษ : </b>{{ $project->project_name_en }}
                        </td>
                    </tr>

                    @if ($project->advisers->isNotEmpty())
                    @php
                    $mainAdviser = $project->advisers->first();
                    @endphp
                    <tr>
                        <th>อาจารย์ที่ปรึกษาหลัก</th>
                        <td>
                            <b>ชื่อ : </b>{{ $mainAdviser->prefix }} {{ $mainAdviser->name }} {{ $mainAdviser->surname
                            }}<br>
                            <b>ตำแหน่งทางวิชาการ : </b>{{ $mainAdviser->academic_position }}<br>
                            <b>วุฒิการศึกษา : </b>{{ $mainAdviser->educational_qualification }}<br>
                            <b>สาขาที่จบการศึกษา : </b>{{ $mainAdviser->branch }}
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="2">ไม่มีข้อมูลอาจารย์ที่ปรึกษาหลักสำหรับโปรเจกต์นี้</td>
                    </tr>
                    @endif
                    @else
                    <tr>
                        <td colspan="2">ไม่มีข้อมูลโปรเจกต์สำหรับผู้ใช้ปัจจุบัน</td>
                    </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>