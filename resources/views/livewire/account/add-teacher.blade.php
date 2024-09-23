<div>
    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table text-nowrap table-striped">
                <thead>
                    <tr>
                        <th style="width: 160px">หัวข้อ</th>
                        <th>รายละเอียด</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>รูปภาพอาจารย์</th>
                        <td>
                            <div class="input-field">
                                <input class="form-control" wire:model="add_teacher_image" type="file"
                                    placeholder="เลือกไฟล์">
                            </div>
                            @error('add_teacher_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>คำนำหน้าชื่อ</th>
                        <td>
                            <div class="input-group">
                                <select class="form-select" wire:model.live="add_prefix">
                                    <option selected>คำนำหน้าชื่อ</option>
                                    <option value="นาย">นาย</option>
                                    <option value="นาง">นาง</option>
                                    <option value="นางสาว">นางสาว</option>
                                    <option value="อื่นๆ">อื่นๆ</option>
                                </select>
                                @if ($this->add_prefix == 'อื่นๆ')
                                    <input class="form-control" wire:model="add_other_prefix" type="text"
                                        placeholder="คำนำหน้าชื่อ">
                                @endif
                            </div>
                            @error('add_other_prefix')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @error('add_prefix')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>ชื่อ</th>
                        <td>
                            <div class="input-field">
                                <input class="form-control" wire:model="add_name" type="text"
                                    placeholder="กรุณากรอกชื่อ">
                            </div>
                            @error('add_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>นามสกุล</th>
                        <td>
                            <div class="input-field">
                                <input class="form-control" wire:model="add_surname" type="text"
                                    placeholder="กรุณากรอกนามสกุล">
                            </div>
                            @error('add_surname')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>รูปภาพลายเซ็น</th>
                        <td>
                            <div class="input-field">
                                <input class="form-control" wire:model="add_signature_image" type="file"
                                    placeholder="เลือกไฟล์">
                                @error('add_signature_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>ตำแหน่งทางวิชาการ</th>
                        <td>
                            <div class="input-group">
                                <select class="form-select" wire:model.live="add_academic_position">
                                    <option selected>ตำแหน่งทางวิชาการ</option>
                                    <option value="อาจารย์">อาจารย์</option>
                                    <option value="ผู้ช่วยศาตราจารย์">ผู้ช่วยศาตราจารย์</option>
                                    <option value="รองศาสตราจารย์">รองศาสตราจารย์</option>
                                    <option value="ศาสตราจารย์">ศาสตราจารย์</option>
                                    <option value="อื่นๆ">อื่นๆ</option>
                                </select>
                                @if ($this->add_academic_position == 'อื่นๆ')
                                    <input class="form-control" wire:model="add_other_academic_position" type="text"
                                        placeholder="กรุณากรอกตำแหน่งทางวิชาการ">
                                @endif
                            </div>
                            @error('add_academic_position')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @error('add_other_academic_position')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>วุฒิการศึกษา</th>
                        <td>
                            <div class="input-field">
                                <textarea class="form-control" wire:model="add_educational_qualification" type="text"
                                    placeholder="กรุณากรอกวุฒิการศึกษา"></textarea>
                            </div>
                            @error('add_educational_qualification')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>สาขาที่จบการศึกษา</th>
                        <td>
                            <div class="input-field">
                                <textarea class="form-control" wire:model="add_branch" type="text" placeholder="กรุณากรอกสาขาที่จบการศึกษา"></textarea>
                            </div>
                            @error('add_branch')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>เบอร์โทรศัพท์</th>
                        <td>
                            <div class="input-field">
                                <input class="form-control" wire:model="add_tel" type="tel"
                                    placeholder="กรุณากรอกเบอร์โทร" maxlength="10" minlength="10">
                            </div>
                            @error('add_tel')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>อีเมล</th>
                        <td>
                            <div class="input-field">
                                <input class="form-control" wire:model="add_email" type="email"
                                    placeholder="กรุณากรอกอีเมล">
                            </div>
                            @error('add_email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
                    </tr>
                    {{-- <tr>
                        <th>ไอดีไลน์</th>
                        <td>
                            <div class="input-field">
                                <input class="form-control" wire:model="add_id_line" type="text"
                                    placeholder="กรุณากรอกไอดีไลน์">
                            </div>
                            @error('add_id_line')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
                    </tr> --}}
                    <tr>
                        <th>ชื่อผู้ใช้</th>
                        <td>
                            <div class="input-field">
                                <input class="form-control" wire:model="add_username" type="text"
                                    placeholder="กรุณากรอกชื่อผู้ใช้" minlength="8">
                            </div>
                            @error('add_username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>รหัสผ่าน</th>
                        <td>
                            <div class="input-field">
                                <input class="form-control" wire:model="add_password" type="password"
                                    placeholder="กรุณากรอกรหัสผ่าน" minlength="8">
                            </div>
                            @error('add_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>ยืนยันรหัสผ่าน</th>
                        <td>
                            <div class="input-field">
                                <input class="form-control" wire:model="add_password_confirmation" type="password"
                                    placeholder="กรุณากรอกรหัสผ่านอีกครั้ง" minlength="8">
                            </div>
                            @error('add_password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>ประเภทบัญชีผู้ใช้</th>
                        <td>
                            <div class="input-field">
                                <select class="form-select" wire:model.live="add_user_type">
                                    <option selected>ประเภทบัญชีผู้ใช้</option>
                                    <option value="Admin">อาจารย์ประจำวิชา (Admin)</option>
                                    <option value="Branch head">หัวหน้าสาขา</option>
                                    <option value="Teacher">อาจารย์</option>
                                </select>
                            </div>
                            @error('add_user_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>สถานะบัญชี</th>
                        <td>
                            <div class="input-field">
                                <select class="form-select" wire:model.live="add_account_status">
                                    <option selected>สถานะบัญชี</option>
                                    <option value="1">ยังใช้งาน</option>
                                    <option value="0">ยกเลิกใช้งาน</option>
                                </select>
                            </div>
                            @error('add_account_status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>เพิ่มบัญชีอาจารย์</th>
                        <td>
                            <div class="button-container">
                                <button class="btn btn-success" wire:click="add">เพิ่มบัญชี</button>
                                <button class="btn btn-danger" wire:click="cancel">ยกเลิก</button>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
