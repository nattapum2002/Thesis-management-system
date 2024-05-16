<div>
    <div class="container">
        <header>เพิ่มอาจารย์</header>
        <form action="#">
            <div class="personal-details">
                <span class="title">ข้อมูลส่วนบุคล</span>
                <div class="fields">
                    <div class="input-field">
                        <label class="form-label">คำนำหน้าชื่อ</label>
                        <input class="form-input" type="text" wire:model='prefix' placeholder="คำนำหน้าชื่อ" required>
                        @error('prefix')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <label class="form-label">ชื่อ</label>
                        <input class="form-input" type="text" wire:model='name' placeholder="กรุณากรอกชื่อ" required>
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
                        <input class="form-input" type="file" wire:model='teacher_image' placeholder="เลือกไฟล์"
                            required>
                        @error('teacher_image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <label class="form-label">รูปภาพลายเซ็น</label>
                        <input class="form-input" type="file" wire:model='signature_image' placeholder="เลือกไฟล์"
                            required>
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
                        <input class="form-input" wire:model='email' type="email" placeholder="กรุณากรอกอีเมล" required>
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
                        <input class="form-input" wire:model='username' type="text" placeholder="กรุณากรอกชื่อผู้ใช้"
                            required>
                        @error('username')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <label class="form-label">รหัสผ่าน</label>
                        <input class="form-input" wire:model='password' type="password" placeholder="กรุณากรอกรหัสผ่าน"
                            minlength="8" required>
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
                <button wire:click.prevent='add' type="submit" class="btn btn-success">บันทึก</button>
                <button wire:click.prevent='cancel' type="button" class="btn btn-danger">ยกเลิก</button>
            </div>
        </form>
    </div>
</div>