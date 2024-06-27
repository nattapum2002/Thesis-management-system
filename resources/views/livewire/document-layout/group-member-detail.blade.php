<div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-4">
                    <h3>รายละเอียดกลุ่มปริญญานิพนธ์</h3>
                </div>
                <div class="col-sm-5">
                    <a class="btn btn-success" href="">เพิ่มเอกสาร 01</a>
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
                    @foreach ($projects as $projectItems)
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- @foreach ($project->members as $member)
<tr>
    <th>นักศึกษาลำดับที่ {{ $loop->iteration }}</th>
    <td>
        <b>ชื่อ : </b>{{ $member->prefix }} {{ $member->name }} {{ $member->surname }}
        <b>รหัสนักศึกษา : </b>{{ $member->id_student }}<br>
        <b>หลักสูตร : </b>{{ $member->course->course }} <b>สาขา :
        </b>{{ $member->course->branch }}<br>
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
@foreach ($project->advisers as $mainAdviser)
@if ($mainAdviser->id_position == 1)
    <tr>
        <th>อาจารย์{{ $mainAdviser->position->position }}</th>
        <td>
            <b>ชื่อ : </b>{{ $mainAdviser->teacher->prefix }}
            {{ $mainAdviser->teacher->name }} {{ $mainAdviser->teacher->surname }}<br>
            <b>ตำแหน่งทางวิชาการ : </b>{{ $mainAdviser->teacher->academic_position }}<br>
            <b>วุฒิการศึกษา : </b>{{ $mainAdviser->teacher->educational_qualification }}<br>
            <b>สาขาที่จบการศึกษา : </b>{{ $mainAdviser->teacher->branch }}
        </td>
    </tr>
@endif
@endforeach
@foreach ($project->advisers as $mainAdviser)
    @if ($mainAdviser->id_position == 2)
        <tr>
            <th>อาจารย์{{ $mainAdviser->position->position }}</th>
            <td>
                <b>ชื่อ : </b>{{ $mainAdviser->teacher->prefix }}
                {{ $mainAdviser->teacher->name }} {{ $mainAdviser->teacher->surname }}<br>
                <b>ตำแหน่งทางวิชาการ : </b>{{ $mainAdviser->teacher->academic_position }}<br>
                <b>วุฒิการศึกษา :
                </b>{{ $mainAdviser->teacher->educational_qualification }}<br>
                <b>สาขาที่จบการศึกษา : </b>{{ $mainAdviser->teacher->branch }}
            </td>
        </tr>
    @endif
@endforeach --}}
