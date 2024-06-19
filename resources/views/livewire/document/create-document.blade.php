<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="card">
        <div class="card-header">
            <h3>ขออนุมัติชื่อเรื่องและแต่งตั้งที่ปรึกษา</h3>
        </div>
        <div class="card-body">
            <form wire:submit="create_document" action="#">
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
                            <button class="btn btn-danger" type="button"
                                @click="if(memberCount > 0) memberCount--">ลบนักศึกษา</button>
                        </div>
                    </div>
                </div>
                <div class="project-name">
                    <span class="title text-primary">ชื่อเรื่องโครงงานปริญญานิพนธ์</span>
                    <div class="fields">
                        <div class="input-fields">
                            <label class="form-label">ภาษาไทย</label>
                            <input class="form-input" type="text" placeholder="กรุณากรอกชื่อโครงงาน">
                        </div>
                        <div class="input-fields">
                            <label class="form-label">ภาษาอังกฤษ</label>
                            <input class="form-input" type="text" placeholder="กรุณากรอกชื่อโครงงาน">
                        </div>
                    </div>
                </div>
                <div class="main-advisor">
                    <span class="title text-primary">อาจารย์ที่ปรึกษาหลัก</span>
                    <div class="fields">
                        <div class="input-fields">
                            <select class="form-select">
                                <option selected>กรุณาเลือกที่ปรึกษาหลัก</option>
                                <option value="">อาจารย์ 1</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="co-advisor">
                    <span class="title text-primary">อาจารย์ที่ปรึกษาร่วม(ถ้ามี)</span>
                    <div class="fields-co-advisor">
                        <div class="input-fields">
                            <label class="form-label">อาจารย์ที่ปรึกษาร่วมลำดับที่ 1</label>
                            <select class="form-select">
                                <option selected>กรุณาเลือกที่ปรึกษาร่วม</option>
                                <option value="">อาจารย์ 1</option>
                            </select>
                        </div>
                    </div>
                    <div class="fields-co-advisor">
                        <div class="input-fields">
                            <label class="form-label">อาจารย์ที่ปรึกษาร่วมลำดับที่ 2</label>
                            <select class="form-select">
                                <option selected>กรุณาเลือกที่ปรึกษาร่วม</option>
                                <option value="">อาจารย์ 1</option>
                            </select>
                        </div>
                    </div>
                    <div class="fields-external_co-advisor">
                        <div class="input-fields">
                            <label class="form-label">อาจารย์ที่ปรึกษาร่วมลำดับที่ 3</label>
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
                                <input class="form-input" type="text" placeholder="กรุณากรอกตำแหน่งทางวิชาการ">
                            </div>
                            <div class="input-field">
                                <label class="form-label">วุฒิการศึกษา</label>
                                <input class="form-input" type="text" placeholder="กรุณากรอกวุฒิการศึกษา">
                            </div>
                            <div class="input-field">
                                <label class="form-label">สาขาที่จบการศึกษา</label>
                                <input class="form-input" type="text" placeholder="กรุณากรอกสาขาที่จบการศึกษา">
                            </div>
                        </div>
                    </div>
                    <div class="btn">
                        <button type="button" class="btn btn-success">เพิ่มอาจารย์ที่ปรึกษาร่วม</button>
                    </div>
                </div>
                <div class="btn-input">
                    <button type="button" class="btn btn-danger">ยกเลิก</button>
                    <button type="submit" class="btn btn-success">ขออนุมัติชื่อเรื่องและแต่งตั้งที่ปรึกษา</button>
                </div>
            </form>
        </div>
    </div>
</div>
