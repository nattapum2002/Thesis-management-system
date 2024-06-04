<div>
    {{-- จัดการบัญชี --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">จัดการบัญชีอาจารย์</h3>
            <div class="btn btn-success btn-sm" href="#">เพิ่มบัญชี</div>
            <div class="card-tools">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <button class="btn btn-primary" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: auto">#</th>
                        <th style="width: auto">ชื่อ</th>
                        <th style="width: auto">ประเภทบัญชี</th>
                        <th style="width: auto">สถานะบัญชี</th>
                        <th style="width: auto"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>อาจารย์ 1</td>
                        <td>อาจารย์</td>
                        <td>ยังใช้งานบัญชี</td>
                        <td class="text-right">
                            <a class="btn btn-primary btn-sm" href="#">รายละเอียด</a>
                            <a class="btn btn-secondary btn-sm" href="#">แก้ไขบัญชี</a>
                            <a class="btn btn-danger btn-sm" href="#">ยกเลิกบัญชี</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

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
                            <th style="width: auto">รายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>รูปภาพอาจารย์</th>
                            <td><i class='bx bx-user'></i></td>
                        </tr>
                        <tr>
                            <th>ชื่อ</th>
                            <td>อาจารย์ 1</td>
                        </tr>
                        <tr>
                            <th>ตำแหน่งทางวิชาการ</th>
                            <td>อาจารย์</td>
                        </tr>
                        <tr>
                            <th>ระดับการศึกษา</th>
                            <td>อาจารย์</td>
                        </tr>
                        <tr>
                            <th>สาขาที่จบการศึกษา</th>
                            <td>คอมพิวเตอร์</td>
                        </tr>
                        <tr>
                            <th>เบอร์โทรศัพท์</th>
                            <td>0123456789</td>
                        </tr>
                        <tr>
                            <th>อีเมล</th>
                            <td>teacher.admin@rmuti.ac.th</td>
                        </tr>
                        <tr>
                            <th>ไอดีไลน์</th>
                            <td>line</td>
                        </tr>
                        <tr>
                            <th>ประเภทบัญชี</th>
                            <td><a href="#"><i class='bx bx-edit'></i></a>อาจารย์</td>
                        </tr>
                        <tr>
                            <th>สถานะบัญชี</th>
                            <td>ยังใช้งานบัญชี</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>ประเภทบัญชีผู้ใช้</h4>
        </div>
        <div class="card-body">
            <div class="fields">
                <div class="input-field">
                    <select class="form-select" wire:model='user_type' required>
                        <option selected>กรุณาเลือกประเภทบัญชีผู้ใช้</option>
                        <option value="t">อาจารย์</option>
                        <option value="st">อาจารย์ประจำวิชา</option>
                        <option value="bh">หัวหน้าสาขา</option>
                    </select>
                    @error('user_type')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- เพิ่มบัญชี --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">เพิ่มบัญชีอาจารย์</h3>
        </div>
        <div class="card-body">
            <form wire:submit="add">
                <div class="personal-details">
                    <span class="title">ข้อมูลส่วนบุคล</span>
                    <div class="fields">
                        <div class="input-field">
                            <label class="form-label">คำนำหน้าชื่อ</label>
                            <input class="form-input" type="text" wire:model='prefix' placeholder="คำนำหน้าชื่อ"
                                required>
                            @error('prefix')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">ชื่อ</label>
                            <input class="form-input" type="text" wire:model='name' placeholder="กรุณากรอกชื่อ"
                                required>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">นามสกุล</label>
                            <input class="form-input" type="text" wire:model='surname' placeholder="กรุณากรอกนามสกุล"
                                required>
                            @error('surname')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">รูปภาพอาจารย์</label>
                            <input class="form-input" type="file" wire:model='teacher_image' placeholder="เลือกไฟล์">
                            @error('teacher_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">รูปภาพลายเซ็น</label>
                            <input class="form-input" type="file" wire:model='signature_image' placeholder="เลือกไฟล์">
                            @error('signature_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="teacher-details">
                    <span class="title">ข้อมูลส่วนอาจารย์</span>
                    <div class="fields">
                        <div class="input-field">
                            <label class="form-label">ตำแหน่งทางวิชาการ</label>
                            <select class="form-select" wire:model='academic_position' required>
                                <option selected>กรุณาเลือกตำแหน่งทางวิชาการ</option>
                                <option value="teacher">อาจารย์</option>
                            </select>
                            @error('academic_position')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">วุฒิการศึกษา</label>
                            <input class="form-input" wire:model='educational_qualification' type="text"
                                placeholder="กรุณากรอกวุฒิการศึกษา" required>
                            @error('educational_qualification')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">สาขาที่จบการศึกษา</label>
                            <input class="form-input" wire:model='branch' type="text"
                                placeholder="กรุณากรอกสาขาที่จบการศึกษา" required>
                            @error('branch')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="contact-details">
                    <span class="title">ข้อมูลการติดต่อ</span>
                    <div class="fields">
                        <div class="input-field">
                            <label class="form-label">อีเมล(อีเมลมหาลัย ถ้ามี)</label>
                            <input class="form-input" wire:model='email' type="email" placeholder="กรุณากรอกอีเมล"
                                required>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">เบอร์โทร</label>
                            <input class="form-input" wire:model='tel' type="tel" placeholder="กรุณากรอกเบอร์โทร"
                                maxlength="10" minlength="10" required>
                            @error('tel')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">ไอดีไลน์</label>
                            <input class="form-input" wire:model='id_line' type="text" placeholder="กรุณากรอกไอดีไลน์"
                                required>
                            @error('id_line')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="user-details">
                    <span class="title">ข้อมูลผู้ใช้</span>
                    <div class="fields">
                        <div class="input-field">
                            <label class="form-label">ประเภทผู้ใช้</label>
                            <select class="form-select" wire:model='user_type' required>
                                <option selected>กรุณาเลือกประเภทผู้ใช้</option>
                                <option value="t">อาจารย์</option>
                                <option value="st">อาจารย์ประจำวิชา</option>
                                <option value="bh">หัวหน้าสาขา</option>
                            </select>
                            @error('user_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">ชื่อผู้ใช้</label>
                            <input class="form-input" wire:model='username' type="text"
                                placeholder="กรุณากรอกชื่อผู้ใช้" required>
                            @error('username')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">รหัสผ่าน</label>
                            <input class="form-input" wire:model='password' type="password"
                                placeholder="กรุณากรอกรหัสผ่าน" minlength="8" required>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="input-field">
                            <label class="form-label">ยืนยันรหัสผ่าน</label>
                            <input class="form-input" wire:model='password' type="password"
                                placeholder="กรุณากรอกรหัสผ่านอีกครั้ง" minlength="8" required>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                    <button wire:click.prevent='cancel' type="button" class="btn btn-danger">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>