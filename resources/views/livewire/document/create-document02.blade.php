<div>
    <div class="card">
        <div class="card-header">
            <h3>แบบยื่นสอบหัวข้อและเค้าโครงของโครงงาน</h3>
        </div>
        <div class="card-body">
            <div>
            <div class="mb-3">
                <label for="selectProject">เลือกโครงงาน</label>
                <select wire:model.live="id_project" class="form-select" name="" id="">
                    <option value="none"selected>กรุณาเลือกโครงงาน</option>
                    @foreach ($selectProject as $SelectProject)
                        <option value="{{ $SelectProject->id_project }}">{{ $SelectProject->project_name_th }}</option>
                    @endforeach
                </select>
            </div>
            @if (session()->has('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div>
                @foreach ($project as $ProjectItems)
                    <div class="mb-3">
                        <label for="memberName">สมาชิกกลุ่ม</label>
                        <div>
                            @foreach ($members as $index => $member)
                                <input type="text" class="form-control mb-2 w-50"
                                    wire:model="members.{{ $index }}.id_student"
                                    value="{{ $member['id_student'] }} {{ $member['name'] }} {{ $member['surname'] }}"
                                    disabled>
                            @endforeach
                        </div>
                    </div>
                    @foreach ($teachers->where('pivot.id_position', 1) as $index => $mainTeacher)
                        <div class="mb-3">
                            <label for="teacherName">อาจารย์ที่ปรึกษาหลัก</label>
                            <input type="text" class="form-control w-50"
                                wire:model="teachers"
                                value="{{ $mainTeacher->name }} {{ $mainTeacher->surname }}" disabled>
                        </div>
                    @endforeach
                    <div class="mb-3">
                        <label for="teacherName">อาจารย์ที่ปรึกษาร่วม</label>
                        @foreach ($teachers->where('pivot.id_position', 2) as $index => $subTeacher)
                       
                            <input type="text" class="form-control mb-2 w-50"
                                value="{{ $subTeacher->name }} {{ $subTeacher->surname }}" disabled>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
            <button class="btn btn-primary" wire:click="create_document">สร้าง</button>
            <button class="btn btn-primary" wire:click="test">test</button>
        </div>
    </div>
</div>
