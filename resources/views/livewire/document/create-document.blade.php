<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="card">
        <div class="card-header">
            <h3>ขออนุมัติชื่อเรื่องและแต่งตั้งที่ปรึกษา</h3>
        </div>
        <div class="card-body">
            <form wire:submit="getData" action="#">
                <div class="member">
                    <span class="title text-primary">สมาชิกกลุ่มปริญานิพนธ์</span>
                    <div class="fields">
                        <div class="input-fields">
                            <label class="form-label">นักศึกษาลำดับที่ 1</label>
                            <input class="form-input" type="text" wire:model="id_members.0" disabled>
                        </div>
                        <div x-data="{ memberCount: 0 }">
                            <template x-for="i in memberCount" :key="i">
                                <div class="input-fields">
                                    <label class="form-label">นักศึกษาลำดับที่ <span x-text="i + 1"></span></label>
                                    <input class="form-input" type="text" :name="'id_members[' + i + ']'"
                                        x-model="$wire.id_members[i]" placeholder="กรุณากรอกรหัสนักศึกษา">
                                </div>
                            </template>
                            <button class="btn btn-success" type="button"
                                @click="if(memberCount < 4) memberCount++">เพิ่มนักศึกษา</button>
                            <div x-show = "memberCount > 0">
                                <button class="btn btn-danger" type="button"
                                    @click="if(memberCount > 0) memberCount--">ลบนักศึกษา</button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="project-name">
                    <span class="title text-primary">ชื่อเรื่องโครงงานปริญญานิพนธ์</span>
                    <div class="fields">
                        <div class="input-fields">
                            <label class="form-label">ภาษาไทย</label>
                            <input class="form-input" wire:model="project_name_th" type="text"
                                placeholder="กรุณากรอกชื่อโครงงาน">
                            @error('project_name_th')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-fields">
                            <label class="form-label">ภาษาอังกฤษ</label>
                            <input class="form-input" wire:model="project_name_eng" type="text"
                                placeholder="กรุณากรอกชื่อโครงงาน">
                            @error('project_name_eng')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div x-data="{ SubTeacherCount: 0, id_teacher: @entangle('id_teacher') }">
                    <div class="main-advisor">
                        <span class="title text-primary">อาจารย์ที่ปรึกษาหลัก</span>
                        <div class="fields">
                            <div class="input-fields">
                                <select class="form-select" x-model="id_teacher[0]">
                                    <option selected>กรุณาเลือกที่ปรึกษาหลัก</option>
                                    @foreach ($teachers as $main_teacher)
                                        <option value="{{ $main_teacher->id_teacher }}"
                                            x-show="!id_teacher.includes('{{ $main_teacher->id_teacher }}')">
                                            {{ $main_teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('id_teacher.0')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sub-advisor">
                        <span class="title text-primary">อาจารย์ที่ปรึกษาร่วม(ถ้ามี)</span>

                        <template x-for="sup_teacher in Array.from({ length: SubTeacherCount }, (_, i) => i + 1)"
                            :key="sup_teacher">
                            <div class="fields-co-advisor">
                                <div class="input-fields">
                                    <label class="form-label">อาจารย์ที่ปรึกษาร่วมลำดับที่ <span
                                            x-text="sup_teacher"></span></label>
                                    <select class="form-select" x-model="id_teacher[sup_teacher]">
                                        <option value="" selected>กรุณาเลือกที่ปรึกษาร่วม</option>
                                        @foreach ($teachers as $teacherItem)
                                            <option value="{{ $teacherItem->id_teacher }}"
                                                x-show="!id_teacher.includes('{{ $teacherItem->id_teacher }}')">
                                                {{ $teacherItem->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </template>
                        <button class="btn btn-success" type="button"
                            @click="if(SubTeacherCount < 3)SubTeacherCount++">เพิ่มอาจารย์ที่ปรึกษาร่วม</button>

                        <div x-show="SubTeacherCount > 0 ">
                            <button class="btn btn-danger" type="button"
                                @click="if(SubTeacherCount > 0)SubTeacherCount--">ลบอาจารย์ที่ปรึกษาร่วม</button>
                        </div>
                    </div>
                    <div>
                        @foreach ($id_teacher as $id_teacher_item)
                            {{ $id_teacher_item }}
                        @endforeach
                    </div>
                    <div class="fields-external_co-advisor">
                        <span class="title text-primary">อาจารย์ที่ปรึกษาจากสถาศึกษาอื่น</span>
                        <div x-data="{ outTeacher: 0 }">
                            <template x-for=" out_teacher in outTeacher" :key="out_teacher">
                                <div class="input-fields">
                                    <label class="form-label">อาจารย์ที่ปรึกษาจากสถาศึกษาอื่น</label>
                                    <div class="input-field">
                                        <label class="form-label">คำนำหน้าชื่อ</label>
                                        <input class="form-input" type="text" placeholder="กรุณากรอกคำนำหน้าชื่อ">
                                    </div>
                                    <div class="input-field">
                                        <label class="form-label">ชื่อ</label>
                                        <input class="form-input" type="text" placeholder="กรุณากรอกชื่อ">
                                    </div>
                                    <div class="input-field">
                                        <label class="form-label">นามสกุล</label>
                                        <input class="form-input" type="text" placeholder="กรุณากรอกนามสกุล">
                                    </div>
                                    <div class="input-field">
                                        <label class="form-label">ตำแหน่งทางวิชาการ</label>
                                        <input class="form-input" type="text"
                                            placeholder="กรุณากรอกตำแหน่งทางวิชาการ">
                                    </div>
                                    <div class="input-field">
                                        <label class="form-label">วุฒิการศึกษา</label>
                                        <input class="form-input" type="text" placeholder="กรุณากรอกวุฒิการศึกษา">
                                    </div>
                                    <div class="input-field">
                                        <label class="form-label">สาขาที่จบการศึกษา</label>
                                        <input class="form-input" type="text"
                                            placeholder="กรุณากรอกสาขาที่จบการศึกษา">
                                    </div>
                                </div>
                        </div>
                        </template>
                        <div class="button">
                            <button class="btn btn-success" type="button"
                                @click="if(outTeacher < 3)outTeacher++">เพิ่ม</button>

                            <div x-show="outTeacher > 0">
                                <button class="btn btn-danger" type="button"
                                    @click="if(outTeacher > 0)outTeacher--">ลบ</button>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="btn-input">
                    <button type="button" class="btn btn-danger">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary" data-bs-toggle="modal">
                        ยืนยัน
                    </button>
                </div>

                {{-- confirmModal --}}
                <div class="modal fade" id="confirmModal" wire:ignore.self tabindex="-1"
                    aria-labelledby="confirmModal" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">โปรดตัวสอบความถูกต้อง</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <label class="form-label" for="">ชื่อปริญญานิพนธ์ :</label>
                                    <div class="col-sm-5">
                                        <label class="form-label" for="">ชื่อภาษาไทย :
                                            {{ $project_name_th }}</label>
                                    </div>
                                    <div class="col-sm-5">
                                        <label class="form-label" for="">ชื่อภาษาอังกฤษ :
                                            {{ $project_name_eng }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="form-label" for="">มีสมาชิก</label>
                                    @foreach ($members as $memberitems)
                                        <div class="col-sm-5">
                                            {{ $memberitems->name }}<br>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <label class="form-label" for="">อาจารยที่ปรึกษาหลัก</label>
                                    @foreach ($mainTeacher as $main_teachersItem)
                                        <div class="col-sm-5">
                                            {{ $main_teachersItem->name }}<br>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <label class="form-label" for="">อาจารยที่ปรึกษาร่วม</label>
                                    @foreach ($sub_teachers as $sub_teachersItems)
                                        <div class="col-sm-5">
                                            {{ $sub_teachersItems->name }}<br>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" wire:click.prevent="confirmDocument"
                                    class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- confirmModal --}}
            </form>
        </div>
    </div>
    @script
        <script>
            $wire.on('openmodal', () => {
                const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
                confirmModal.show();
            });
        </script>
    @endscript
</div>
