{{-- <div>

    <div class="card">
        <div class="card-header">
            <h3>ขออนุมัติชื่อเรื่องและแต่งตั้งที่ปรึกษา</h3>
        </div>
        <div class="card-body">
            <form wire:submit="getData" action="#">
                <div class="member">
                    <span class="title text-primary">สมาชิกกลุ่มปริญานิพนธ์</span>
                    <div class="fields">
                        <div class="input-group">
                            <label class="input-group-text">นักศึกษาลำดับที่ 1</label>
                            <input class="form-control" type="text" wire:model="id_members.0" disabled>
                        </div>
                        <div x-data="{ memberCount: 0 }">
                            <template x-for="i in memberCount" :key="i">
                                <div class="input-group">
                                    <label class="input-group-text">นักศึกษาลำดับที่ <span x-text="i + 1"></span></label>
                                    <input class="form-control" type="text" :name="'id_members[' + i + ']'"
                                        x-model="$wire.id_members[i]" placeholder="กรุณากรอกรหัสนักศึกษา">
                                </div>
                            </template>
                            <button class="btn btn-success" type="button"
                                @click="if(memberCount < 4) memberCount++">เพิ่มนักศึกษา</button>
                            <div x-show="memberCount > 0">
                                <button class="btn btn-danger" type="button"
                                    @click="if(memberCount > 0) {
                                        $wire.removeMember(memberCount);
                                        memberCount--;
                                    }">ลบนักศึกษา</button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="project-name">
                    <span class="title text-primary">ชื่อเรื่องโครงงานปริญญานิพนธ์</span>
                    <div class="fields">
                        <div class="input-group">
                            <label class="input-group-text">ภาษาไทย</label>
                            <input class="form-control" wire:model="project_name_th" type="text"
                                placeholder="กรุณากรอกชื่อโครงงาน">
                            @error('project_name_th')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label class="input-group-text">ภาษาอังกฤษ</label>
                            <input class="form-control" wire:model="project_name_eng" type="text"
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
                            <div class="input-group">
                                <select class="form-select" x-model="id_teacher[0]">
                                    <option selected>กรุณาเลือกที่ปรึกษาหลัก</option>
                                    @foreach ($teachers as $main_teacher)
                                        <option value="{{ $main_teacher->id_teacher }}"
                                            x-show="!id_teacher.includes('{{ $main_teacher->id_teacher }}')">
                                            {{ $main_teacher->name }} {{ $main_teacher->surname }}
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
                                <div class="input-group">
                                    <label class="input-group-text">อาจารย์ที่ปรึกษาร่วมลำดับที่ <span
                                            x-text="sup_teacher"></span></label>
                                    <select class="form-select" x-model="id_teacher[sup_teacher]">
                                        <option value="" selected>กรุณาเลือกที่ปรึกษาร่วม</option>
                                        @foreach ($teachers as $teacherItem)
                                            <option value="{{ $teacherItem->id_teacher }}"
                                                x-show="!id_teacher.includes('{{ $teacherItem->id_teacher }}')">
                                                {{ $teacherItem->name }} {{ $teacherItem->surname }}
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
                            @click="if(SubTeacherCount > 0) {
                                id_teacher[SubTeacherCount] = ''; // Clear the selected value
                                SubTeacherCount--;
                            }">ลบอาจารย์ที่ปรึกษาร่วม</button>
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
                                <div class="input-group">
                                    <label class="input-group-text">อาจารย์ที่ปรึกษาจากสถาศึกษาอื่น</label>
                                    <div class="input-group">
                                        <label class="input-group-text">คำนำหน้าชื่อ</label>
                                        <input class="form-control" type="text" placeholder="กรุณากรอกคำนำหน้าชื่อ">
                                    </div>
                                    <div class="input-group">
                                        <label class="input-group-text">ชื่อ</label>
                                        <input class="form-control" type="text" placeholder="กรุณากรอกชื่อ">
                                    </div>
                                    <div class="input-group">
                                        <label class="input-group-text">นามสกุล</label>
                                        <input class="form-control" type="text" placeholder="กรุณากรอกนามสกุล">
                                    </div>
                                    <div class="input-group">
                                        <label class="input-group-text">ตำแหน่งทางวิชาการ</label>
                                        <input class="form-control" type="text"
                                            placeholder="กรุณากรอกตำแหน่งทางวิชาการ">
                                    </div>
                                    <div class="input-group">
                                        <label class="input-group-text">วุฒิการศึกษา</label>
                                        <input class="form-control" type="text" placeholder="กรุณากรอกวุฒิการศึกษา">
                                    </div>
                                    <div class="input-group">
                                        <label class="input-group-text">สาขาที่จบการศึกษา</label>
                                        <input class="form-control" type="text"
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
                    <button type="submit" class="btn btn-orange" data-bs-toggle="modal">
                        ยืนยัน
                    </button>
                </div>

                <!-- confirmModal -->
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
                                    <label class="input-group-text" for="">ชื่อปริญญานิพนธ์ :</label>
                                    <div class="col-sm-5">
                                        <label class="input-group-text" for="">ชื่อภาษาไทย :
                                            {{ $project_name_th }}</label>
                                    </div>
                                    <div class="col-sm-5">
                                        <label class="input-group-text" for="">ชื่อภาษาอังกฤษ :
                                            {{ $project_name_eng }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="input-group-text" for="">มีสมาชิก</label>
                                    @foreach ($members as $memberitems)
                                        <div class="col-sm-5">
                                            {{ $memberitems->name }}<br>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <label class="input-group-text" for="">อาจารยที่ปรึกษาหลัก</label>
                                    @foreach ($mainTeacher as $main_teachersItem)
                                        <div class="col-sm-5">
                                            {{ $main_teachersItem->name }}<br>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <label class="input-group-text" for="">อาจารยที่ปรึกษาร่วม</label>
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
                                    class="btn btn-orange">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
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
</div> --}}

<div>
    <section id="createDocument01">
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <form wire:submit="getData" action="#">
                    <fieldset class="projectName">
                        <legend class="title">ชื่อเรื่องโครงงานปริญญานิพนธ์</legend>
                        <div class="fields">
                            <div class="input-group">
                                <label class="input-group-text">ภาษาไทย</label>
                                <input class="form-control" wire:model="project_name_th" type="text"
                                    placeholder="กรุณากรอกชื่อโครงงาน">
                            </div>
                            @error('project_name_th')
                                <span class="text-danger text-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="fields">
                            <div class="input-group">
                                <label class="input-group-text">ภาษาอังกฤษ</label>
                                <input class="form-control" wire:model="project_name_eng" type="text"
                                    placeholder="กรุณากรอกชื่อโครงงาน">
                            </div>
                            @error('project_name_eng')
                                <span class="text-danger text-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </fieldset>
                    <fieldset class="members">
                        <legend class="title">สมาชิกกลุ่มปริญานิพนธ์</legend>
                        <div class="fields">
                            <div class="input-group">
                                <label class="input-group-text">1</label>
                                <input class="form-control" type="text" wire:model="id_members.0" disabled>
                            </div>
                        </div>
                        <div x-data="{ memberCount: 0 }">
                            <template x-for="i in memberCount" :key="i">
                                <div class="fields">
                                    <div class="input-group">
                                        <label class="input-group-text"><span x-text="i + 1"></span></label>
                                        <input class="form-control" type="text" :name="'id_members[' + i + ']'"
                                            x-model="$wire.id_members[i]" placeholder="กรุณากรอกรหัสนักศึกษา">
                                    </div>
                                </div>
                            </template>
                            <div>
                                <button class="btn btn-success" type="button" x-show="memberCount < 4"
                                    @click="if(memberCount < 4) memberCount++">เพิ่มนักศึกษา</button>
                                <button class="btn btn-danger" type="button" x-show="memberCount > 0"
                                    @click="if(memberCount > 0) {
                                        $wire.removeMember(memberCount);
                                        memberCount--;
                                    }">ลบนักศึกษา</button>
                            </div>
                        </div>
                    </fieldset>
                    <div x-data="{ SubTeacherCount: 0, id_teacher: @entangle('id_teacher') }">
                        <fieldset class="mainAdvisor">
                            <legend class="title">อาจารย์ที่ปรึกษาหลัก</legend>
                            <div class="fields">
                                <div class="input-group">
                                    <select class="form-select" x-model="id_teacher[0]">
                                        <option selected>กรุณาเลือกที่ปรึกษาหลัก</option>
                                        @foreach ($teachers as $main_teacher)
                                            <option value="{{ $main_teacher->id_teacher }}"
                                                x-show="!id_teacher.includes('{{ $main_teacher->id_teacher }}')">
                                                {{ $main_teacher->prefix . ' ' . $main_teacher->name . ' ' . $main_teacher->surname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('id_teacher.0')
                                    <span class="text-danger text-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </fieldset>
                        <fieldset class="subAdvisor">
                            <legend class="title">อาจารย์ที่ปรึกษาร่วม(ถ้ามี)</legend>
                            <template x-for="sup_teacher in Array.from({ length: SubTeacherCount }, (_, i) => i + 1)"
                                :key="sup_teacher">
                                <div class="fields">
                                    <div class="input-group">
                                        <label class="input-group-text"> <span x-text="sup_teacher"></span></label>
                                        <select class="form-select" x-model="id_teacher[sup_teacher]">
                                            <option value="" selected>กรุณาเลือกที่ปรึกษาร่วม</option>
                                            @foreach ($teachers as $teacherItem)
                                                <option value="{{ $teacherItem->id_teacher }}"
                                                    x-show="!id_teacher.includes('{{ $teacherItem->id_teacher }}')">
                                                    {{ $teacherItem->prefix . ' ' . $teacherItem->name . ' ' . $teacherItem->surname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </template>
                            <div>
                                <button class="btn btn-success" type="button" x-show="SubTeacherCount < 3 "
                                    @click="if(SubTeacherCount < 3)SubTeacherCount++">เพิ่มอาจารย์</button>
                                <button class="btn btn-danger" type="button" x-show="SubTeacherCount > 0 "
                                    @click="if(SubTeacherCount > 0) {
                                        id_teacher[SubTeacherCount] = ''; // Clear the selected value
                                        SubTeacherCount--;
                                    }">ลบอาจารย์</button>
                            </div>
                        </fieldset>
                    </div>
                    <fieldset class="outAdvisor">
                        <legend class="title">อาจารย์ที่ปรึกษาร่วมจากภายนอก(ถ้ามี)</legend>
                        <div x-data="{ outTeacher: 0 }">
                            <template x-for=" out_teacher in outTeacher" :key="out_teacher">
                                <div>
                                    <div class="fields">
                                        <div class="input-group">
                                            <label class="input-group-text">คำนำหน้าชื่อ</label>
                                            <input class="form-control" type="text"
                                                placeholder="กรุณากรอกคำนำหน้าชื่อ">
                                        </div>
                                    </div>
                                    <div class="fields">
                                        <div class="input-group">
                                            <label class="input-group-text">ชื่อ</label>
                                            <input class="form-control" type="text" placeholder="กรุณากรอกชื่อ">
                                        </div>
                                    </div>
                                    <div class="fields">
                                        <div class="input-group">
                                            <label class="input-group-text">นามสกุล</label>
                                            <input class="form-control" type="text"
                                                placeholder="กรุณากรอกนามสกุล">
                                        </div>
                                    </div>
                                    <div class="fields">
                                        <div class="input-group">
                                            <label class="input-group-text">ตำแหน่งทางวิชาการ</label>
                                            <input class="form-control" type="text"
                                                placeholder="กรุณากรอกตำแหน่งทางวิชาการ">
                                        </div>
                                    </div>
                                    <div class="fields">
                                        <div class="input-group">
                                            <label class="input-group-text">วุฒิการศึกษา</label>
                                            <input class="form-control" type="text"
                                                placeholder="กรุณากรอกวุฒิการศึกษา">
                                        </div>
                                    </div>
                                    <div class="fields">
                                        <div class="input-group">
                                            <label class="input-group-text">สาขาที่จบการศึกษา</label>
                                            <input class="form-control" type="text"
                                                placeholder="กรุณากรอกสาขาที่จบการศึกษา">
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <div>
                                <button class="btn btn-success" type="button" x-show="outTeacher < 1"
                                    @click="if(outTeacher < 3)outTeacher++">เพิ่มอาจารย์</button>
                                <button class="btn btn-danger" type="button" x-show="outTeacher > 0"
                                    @click="if(outTeacher > 0)outTeacher--">ลบอาจารย์</button>
                            </div>
                        </div>
                    </fieldset>

                    <div>
                        <button type="submit" class="btn btn-success" data-bs-target="#confirmModal"
                            data-bs-toggle="modal">ยืนยัน</button>
                        <button type="button" class="btn btn-danger">ยกเลิก</button>
                    </div>

                    <!-- confirmModal -->
                    <div class="modal fade" id="confirmModal" wire:ignore.self tabindex="-1"
                        aria-labelledby="confirmModal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabel">
                                        <i class='bx bx-info-circle'></i>
                                        โปรดตรวจสอบความถูกต้อง
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <fieldset class="projectName">
                                        <legend>ชื่อปริญญานิพนธ์</legend>
                                        <div class="input-group">
                                            <label class="input-group-text">ภาษาไทย</label>
                                            <span class="input-group-text">{{ $project_name_th }}</span>
                                        </div>
                                        <div class="input-group">
                                            <label class="input-group-text">ภาษาอังกฤษ</label>
                                            <span class="input-group-text">{{ $project_name_eng }}</span>
                                        </div>
                                    </fieldset>
                                    <fieldset class="members">
                                        <legend>มีสมาชิก</legend>
                                        @foreach ($members as $memberitems)
                                            <div class="input-group">
                                                <label class="input-group-text">{{ $loop->iteration }}</label>
                                                <span class="input-group-text">
                                                    {{ $memberitems->prefix . ' ' . $memberitems->name . ' ' . $memberitems->surname }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </fieldset>
                                    <fieldset class="mainAdvisor">
                                        <legend>อาจารยที่ปรึกษาหลัก</legend>
                                        @foreach ($mainTeacher as $main_teachersItem)
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    {{ $main_teachersItem->prefix . ' ' . $main_teachersItem->name . ' ' . $main_teachersItem->surname }}<br>
                                                </span>
                                            </div>
                                        @endforeach
                                    </fieldset>
                                    <fieldset class="subAdvisor">
                                        <legend>อาจารยที่ปรึกษาร่วม</legend>
                                        @foreach ($sub_teachers as $sub_teachersItems)
                                            <div class="input-group">
                                                <label class="input-group-text">{{ $loop->iteration }}</label>
                                                <span class="input-group-text">
                                                    {{ $sub_teachersItems->prefix . ' ' . $sub_teachersItems->name . ' ' . $sub_teachersItems->surname }}<br>
                                                </span>
                                            </div>
                                        @endforeach
                                    </fieldset>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-bs-target="#alertModal"
                                        data-bs-toggle="modal" data-bs-dismiss="modal">ยืนยัน</button>
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">ยกเลิก</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="alertModal" aria-hidden="true" aria-labelledby="alertModalLabel"
                        tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="alertModalLabel">
                                        <i class='bx bx-info-circle'></i>
                                        ยืนยันครั้งสุดท้าย
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    เมื่อยืนยันแล้ว ข้อมูลทั้งหมดจะถูกนำไปใช้ในเอกสารต่อๆไป<br>
                                    และจะ<b>ไม่สามารถ</b>ย้อนกลับมาแก้ไขได้
                                </div>
                                <div class="modal-footer">
                                    <button type="button" wire:click.prevent="confirmDocument"
                                        class="btn btn-success">ยืนยัน</button>
                                    <button class="btn btn-danger" data-bs-target="#confirmModal"
                                        data-bs-toggle="modal" data-bs-dismiss="modal">ยกเลิก</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- @script
            <script>
                $wire.on('openmodal', () => {
                    const confirmModal = new bootstrap.Modal(document.getElementById('alertModal'));
                    confirmModal.show();
                });
            </script>
        @endscript --}}
    </section>
</div>
