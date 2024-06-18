<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="card">
        <div class="card-header">
            <h3>ขออนุมัติชื่อเรื่องและแต่งตั้งที่ปรึกษา</h3>
        </div>
        <div class="card-body">
            <form action="#">
                <div class="member">
                    <span class="title text-primary">สมาชิกกลุ่มปริญานิพนธ์</span>
                    <div class="fields">
                        <div class="input-fields">
                            <label class="form-label">นักศึกษาลำดับที่ 1</label>
                            <label class="form-label">64222110108-4</label>
                            <label class="form-label">นาย ณัฐภูมิ ขำศรี</label>
                        </div>
                        <div class="input-fields">
                            <label class="form-label">นักศึกษาลำดับที่ 2</label>
                            <input class="form-input" type="text" wire:model="member1" placeholder="กรุณากรอกรหัสนักศึกษา">
                        </div>
                        <div class="input-fields">
                            <label class="form-label">นักศึกษาลำดับที่ 3</label>
                            <input class="form-input" type="text" wire:model="member2" placeholder="กรุณากรอกรหัสนักศึกษา">
                        </div>
                        <div class="input-fields">
                            <label class="form-label">นักศึกษาลำดับที่ 4</label>
                            <input class="form-input" type="text" wire:model="member3" placeholder="กรุณากรอกรหัสนักศึกษา">
                        </div>
                        <div class="input-fields">
                            <label class="form-label">นักศึกษาลำดับที่ 5</label>
                            <input class="form-input" type="text" wire:model="member4" placeholder="กรุณากรอกรหัสนักศึกษา">
                        </div>
                        <div class="btn">
                            <button type="button" class="btn btn-success">เพิ่มสมาชิก</button>
                        </div>
                    </div>
                    <span class="title text-primary">เป็นนักศึกษา</span>
                    <div class="fields">
                        <label class="text-primary">หลักสูตร</label>
                        <label>วิทยาการคอมพิวเตอร์</label>
                        <label class="text-primary">สาขา</label>
                        <label>เทคโนโลยีคอมพิวเตอร์</label>
                        <label class="text-primary">ระดับ</label>
                        <label>ปริญาตรี 4 ปี</label>
                        <label class="text-primary">ภาค</label>
                        <label>ปกติ</label>
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
                    <button type="button" class="btn btn-success">ขออนุมัติชื่อเรื่องและแต่งตั้งที่ปรึกษา</button>
                </div>
            </form>
        </div>
    </div>
</div>
