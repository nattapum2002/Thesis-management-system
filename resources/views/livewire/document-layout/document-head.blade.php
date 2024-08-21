<div>
    {{-- Do your work, then step back. --}}
    @foreach ($projects as $projectItems)
    <div class="card">
        <div class="card-body">
            <div class="card-title">{{ $projectItems->confirmTeachers->first()->document->document }} -
                {{ $projectItems->project_name_th }} {{ $projectItems->project_name_en }}</div>
            <div class="card-text">
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item"><strong>สมาชิก</strong></li>
                    @foreach ($projectItems->confirmStudents as $confirmStudent)
                        <li class="list-group-item">{{ $confirmStudent->student->name }}
                            {{ $confirmStudent->student->surname }}</li>
                    @endforeach
                </ul>
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item"><strong>ที่ปรึกษาหลัก</strong></li>
                    @foreach ($advisers->where('id_position', 1) as $mainTeacher)
                        <li class="list-group-item">{{ $mainTeacher->teacher->name }}
                            {{ $mainTeacher->teacher->surname }}</li>
                    @endforeach
                </ul>
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item"><strong>ที่ปรึกษาร่วม</strong></li>
                    @foreach ($advisers->where('id_position', 2) as $subTeacher)
                        <li class="list-group-item">{{ $subTeacher->teacher->name }}
                            {{ $subTeacher->teacher->surname }}</li>
                    @endforeach
                </ul>
@endforeach
</div>
