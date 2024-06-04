<div>
    {{-- รายละเอียดบัญชี --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">รายละเอียดบัญชีอาจารย์</h3>
        </div>
        <div class="card-body">
            <div class="details">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 20%">หัวข้อ</th>
                            <th style="width: 40%">รายละเอียด</th>
                            <th style="width: 40%">แก้ไข</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>รูปภาพอาจารย์</th>
                            <td><i class='bx bx-user'></i></td>
                            <td>
                                <button class="btn btn-primary edit-button" data-target="teacher-image-field"><i
                                        class='bx bx-edit'></i></button>
                                <div class="input-field" id="teacher-image-field">
                                    <label class="form-label">รูปภาพอาจารย์</label>
                                    <input class="form-input" type="file" wire:model='teacher_image'
                                        placeholder="เลือกไฟล์" required>
                                    @error('teacher_image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="button-container">
                                        <button class="btn btn-success save-button"
                                            data-target="teacher-image-field">บันทึก</button>
                                        <button class="btn btn-danger cancel-button"
                                            data-target="teacher-image-field">ยกเลิก</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>คำนำหน้าชื่อ</th>
                            <td>นาย</td>
                            <td>
                                <button class="btn btn-primary edit-button" data-target="teacher-prefix-field"><i
                                        class='bx bx-edit'></i></button>
                                <div class="input-field" id="teacher-prefix-field">
                                    <label class="form-label">คำนำหน้าชื่อ</label>
                                    <input class="form-input" type="text" wire:model='prefix' placeholder="คำนำหน้าชื่อ"
                                        required>
                                    @error('prefix')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="button-container">
                                        <button class="btn btn-success save-button"
                                            data-target="teacher-prefix-field">บันทึก</button>
                                        <button class="btn btn-danger cancel-button"
                                            data-target="teacher-prefix-field">ยกเลิก</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>ชื่อ</th>
                            <td>อาจารย์ 1</td>
                            <td>
                                <button class="btn btn-primary edit-button" data-target="teacher-name-field"><i
                                        class='bx bx-edit'></i></button>
                                <div class="input-field" id="teacher-name-field">
                                    <label class="form-label">ชื่อ</label>
                                    <input class="form-input" type="text" wire:model='name' placeholder="กรุณากรอกชื่อ"
                                        required>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="button-container">
                                        <button class="btn btn-success save-button"
                                            data-target="teacher-name-field">บันทึก</button>
                                        <button class="btn btn-danger cancel-button"
                                            data-target="teacher-name-field">ยกเลิก</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>นามสกุล</th>
                            <td>นามสกุล</td>
                            <td>
                                <button class="btn btn-primary edit-button" data-target="teacher-surname-field"><i
                                        class='bx bx-edit'></i></button>
                                <div class="input-field" id="teacher-surname-field">
                                    <label class="form-label">นามสกุล</label>
                                    <input class="form-input" type="text" wire:model='surname'
                                        placeholder="กรุณากรอกนามสกุล" required>
                                    @error('surname')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="button-container">
                                        <button class="btn btn-success save-button"
                                            data-target="teacher-surname-field">บันทึก</button>
                                        <button class="btn btn-danger cancel-button"
                                            data-target="teacher-surname-field">ยกเลิก</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>รูปภาพลายเซ็น</th>
                            <td><i class='bx bx-user'></i></td>
                            <td>
                                <button class="btn btn-primary edit-button" data-target="signature-image-field"><i
                                        class='bx bx-edit'></i></button>
                                <div class="input-field" id="signature-image-field">
                                    <label class="form-label">รูปภาพลายเซ็น</label>
                                    <input class="form-input" type="file" wire:model='signature_image'
                                        placeholder="เลือกไฟล์" required>
                                    @error('signature_image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="button-container">
                                        <button class="btn btn-success save-button"
                                            data-target="signature-image-field">บันทึก</button>
                                        <button class="btn btn-danger cancel-button"
                                            data-target="signature-image-field">ยกเลิก</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>ตำแหน่งทางวิชาการ</th>
                            <td>อาจารย์</td>
                            <td>
                                <button class="btn btn-primary edit-button" data-target="academic-position-field"><i
                                        class='bx bx-edit'></i></button>
                                <div class="input-field" id="academic-position-field">
                                    <label class="form-label">ตำแหน่งทางวิชาการ</label>
                                    <select class="form-select" wire:model='academic_position' required>
                                        <option selected>กรุณาเลือกตำแหน่งทางวิชาการ</option>
                                        <option value="teacher">อาจารย์</option>
                                    </select>
                                    @error('academic_position')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="button-container">
                                        <button class="btn btn-success save-button"
                                            data-target="academic-position-field">บันทึก</button>
                                        <button class="btn btn-danger cancel-button"
                                            data-target="academic-position-field">ยกเลิก</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>วุฒิการศึกษา</th>
                            <td>อาจารย์</td>
                            <td>
                                <button class="btn btn-primary edit-button"
                                    data-target="educational-qualification-field"><i class='bx bx-edit'></i></button>
                                <div class="input-field" id="educational-qualification-field">
                                    <label class="form-label">วุฒิการศึกษา</label>
                                    <input class="form-input" wire:model='educational_qualification' type="text"
                                        placeholder="กรุณากรอกวุฒิการศึกษา" required>
                                    @error('educational_qualification')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="button-container">
                                        <button class="btn btn-success save-button"
                                            data-target="educational-qualification-field">บันทึก</button>
                                        <button class="btn btn-danger cancel-button"
                                            data-target="educational-qualification-field">ยกเลิก</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>สาขาที่จบการศึกษา</th>
                            <td>คอมพิวเตอร์</td>
                            <td>
                                <button class="btn btn-primary edit-button" data-target="branch-field"><i
                                        class='bx bx-edit'></i></button>
                                <div class="input-field" id="branch-field">
                                    <label class="form-label">สาขาที่จบการศึกษา</label>
                                    <input class="form-input" wire:model='branch' type="text"
                                        placeholder="กรุณากรอกสาขาที่จบการศึกษา" required>
                                    @error('branch')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="button-container">
                                        <button class="btn btn-success save-button"
                                            data-target="branch-field">บันทึก</button>
                                        <button class="btn btn-danger cancel-button"
                                            data-target="branch-field">ยกเลิก</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>เบอร์โทรศัพท์</th>
                            <td>0123456789</td>
                            <td>
                                <button class="btn btn-primary edit-button" data-target="tel-field"><i
                                        class='bx bx-edit'></i></button>
                                <div class="input-field" id="tel-field">
                                    <label class="form-label">เบอร์โทร</label>
                                    <input class="form-input" wire:model='tel' type="tel"
                                        placeholder="กรุณากรอกเบอร์โทร" maxlength="10" minlength="10" required>
                                    @error('tel')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="button-container">
                                        <button class="btn btn-success save-button"
                                            data-target="tel-field">บันทึก</button>
                                        <button class="btn btn-danger cancel-button"
                                            data-target="tel-field">ยกเลิก</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>อีเมล</th>
                            <td>teacher.admin@rmuti.ac.th</td>
                            <td>
                                <button class="btn btn-primary edit-button" data-target="email-field"><i
                                        class='bx bx-edit'></i></button>
                                <div class="input-field" id="email-field">
                                    <label class="form-label">อีเมล(อีเมลมหาลัย ถ้ามี)</label>
                                    <input class="form-input" wire:model='email' type="email"
                                        placeholder="กรุณากรอกอีเมล" required>
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="button-container">
                                        <button class="btn btn-success save-button"
                                            data-target="email-field">บันทึก</button>
                                        <button class="btn btn-danger cancel-button"
                                            data-target="email-field">ยกเลิก</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>ไอดีไลน์</th>
                            <td>line</td>
                            <td>
                                <button class="btn btn-primary edit-button" data-target="id-line-field"><i
                                        class='bx bx-edit'></i></button>
                                <div class="input-field" id="id-line-field">
                                    <label class="form-label">ไอดีไลน์</label>
                                    <input class="form-input" wire:model='id_line' type="text"
                                        placeholder="กรุณากรอกไอดีไลน์" required>
                                    @error('id_line')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="button-container">
                                        <button class="btn btn-success save-button"
                                            data-target="id-line-field">บันทึก</button>
                                        <button class="btn btn-danger cancel-button"
                                            data-target="id-line-field">ยกเลิก</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>รหัสผ่าน</th>
                            <td>รหัสผ่าน</td>
                            <td>
                                <button class="btn btn-primary edit-button" data-target="password-field"><i
                                        class='bx bx-edit'></i></button>
                                <div class="input-field" id="password-field">
                                    <label class="form-label">รหัสผ่าน</label>
                                    <input class="form-input" wire:model='password' type="password"
                                        placeholder="กรุณากรอกรหัสผ่าน" minlength="8" required>
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="button-container">
                                        <button class="btn btn-success save-button"
                                            data-target="password-field">บันทึก</button>
                                        <button class="btn btn-danger cancel-button"
                                            data-target="password-field">ยกเลิก</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>ประเภทบัญชีผู้ใช้</th>
                            <td colspan="2">อาจารย์</td>
                        </tr>
                        <tr>
                            <th>สถานะบัญชี</th>
                            <td colspan="2">ยังใช้งานบัญชี</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
