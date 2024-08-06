<div>
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
                        @foreach ($projectItems->confirmTeachers->where('id_position', 1) as $mainTeacher)
                            <li class="list-group-item">{{ $mainTeacher->teacher->name }}
                                {{ $mainTeacher->teacher->surname }}</li>
                        @endforeach
                    </ul>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item"><strong>ที่ปรึกษาร่วม</strong></li>
                        @foreach ($projectItems->confirmTeachers->where('id_position', 2) as $subTeacher)
                            <li class="list-group-item">{{ $subTeacher->teacher->name }}
                                {{ $subTeacher->teacher->surname }}</li>
                        @endforeach
                    </ul>
                    <div>
                        <form wire:submit.prevent="test">
                            <strong>เสนอชื่อกรรมการสอบเค้าโครง</strong>
                            <div x-data="{ id_teacher: @entangle('id_teacher') }">
                                <div class="main-director">
                                    <span class="title">ประธานกรรมการ</span>
                                    <div class="fields">
                                        <div class="input-fields">
                                            <select class="form-select" x-model="id_teacher[0]">
                                                <option selected>กรุณาเลือกที่ประธานกรรมการ</option>
                                                @foreach ($teachers as $main_director)
                                                    <option value="{{ $main_director->id_teacher }}"
                                                        x-show="!Object.values(id_teacher).includes('{{ $main_director->id_teacher }}')">
                                                        {{ $main_director->name }} {{ $main_director->surname }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-director">
                                    <span class="title">กรรมการ</span>
                                    <div class="fields">
                                        <div class="input-fields">
                                            <select class="form-select" x-model="id_teacher[1]">
                                                <option selected>กรุณาเลือกกรรมการ</option>
                                                @foreach ($teachers as $sub_director)
                                                    <option value="{{ $sub_director->id_teacher }}"
                                                        x-show="!Object.values(id_teacher).includes('{{ $sub_director->id_teacher }}')">
                                                        {{ $sub_director->name }} {{ $sub_director->surname }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-director">
                                    <span class="title">กรรมการ</span>
                                    <div class="fields">
                                        <div class="input-fields">
                                            <select class="form-select" x-model="id_teacher[2]">
                                                <option selected>กรุณาเลือกกรรมการ</option>
                                                @foreach ($teachers as $sub_director)
                                                    <option value="{{ $sub_director->id_teacher }}"
                                                        x-show="!Object.values(id_teacher).includes('{{ $sub_director->id_teacher }}')">
                                                        {{ $sub_director->name }} {{ $sub_director->surname }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-director">
                                    <span class="title">กรรมการและเลขานุการ(อาจารย์ที่ปรึกษา)</span>
                                    <div class="fields">
                                        <div class="input-fields">
                                            <select class="form-select" x-model="id_teacher[3]">
                                                <option selected>กรุณาเลือกกรรมการและเลขานุการ(อาจารย์ที่ปรึกษา)
                                                </option>
                                                @foreach ($teachers as $sub_director)
                                                    <option value="{{ $sub_director->id_teacher }}"
                                                        x-show="!Object.values(id_teacher).includes('{{ $sub_director->id_teacher }}')">
                                                        {{ $sub_director->name }} {{ $sub_director->surname }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <strong>กำหนดให้มีการสอบเค้าโครง</strong>
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">วัน/เดือน/ปี</span>
                                        <input type="date" class="form-control" name="date" id="date"
                                            wire:model="date">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">เวลา</span>
                                        <input type="time" class="form-control" name="time" id="time"
                                            wire:model="time">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">การศึกษา</span>
                                        <input type="text" class="form-control" name="year" id="year"
                                            wire:model="year">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">สถานที่</span>
                                        <input type="text" class="form-control" name="place" id="place"
                                            wire:model="place">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">อาคาร</span>
                                        <input type="text" class="form-control" name="building" id="building"
                                            wire:model="building">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">คณะ</span>
                                        <input type="text" class="form-control" name="group" id="group"
                                            wire:model="group">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-orange" type="submit">บันทึก</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    @endforeach
</div>
