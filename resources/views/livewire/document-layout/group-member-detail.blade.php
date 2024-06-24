<div>
    <div class="card">
        <div class="card-header">
            <h3>รายละเอียดกลุ่มปริญญานิพนธ์</h3>
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
                    @foreach ($project->advisers as $mainAdviser)
                    @if ($mainAdviser->id_position == 1)
                    <tr>
                        <th>อาจารย์{{$mainAdviser->position->position}}</th>
                        <td>
                            <b>ชื่อ : </b>{{ $mainAdviser->teacher->prefix }} {{ $mainAdviser->teacher->name }} {{
                            $mainAdviser->teacher->surname
                            }}<br>
                            <b>ตำแหน่งทางวิชาการ : </b>{{ $mainAdviser->teacher->academic_position }}<br>
                            <b>วุฒิการศึกษา : </b>{{ $mainAdviser->teacher->educational_qualification }}<br>
                            <b>สาขาที่จบการศึกษา : </b>{{ $mainAdviser->teacher->branch }}
                        </td>
                    </tr>
                    @endif
                    @endforeach@foreach ($project->advisers as $mainAdviser)
                    @if ($mainAdviser->id_position == 2)
                    <tr>
                        <th>อาจารย์{{$mainAdviser->position->position}}</th>
                        <td>
                            <b>ชื่อ : </b>{{ $mainAdviser->teacher->prefix }} {{ $mainAdviser->teacher->name }} {{
                            $mainAdviser->teacher->surname
                            }}<br>
                            <b>ตำแหน่งทางวิชาการ : </b>{{ $mainAdviser->teacher->academic_position }}<br>
                            <b>วุฒิการศึกษา : </b>{{ $mainAdviser->teacher->educational_qualification }}<br>
                            <b>สาขาที่จบการศึกษา : </b>{{ $mainAdviser->teacher->branch }}
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>