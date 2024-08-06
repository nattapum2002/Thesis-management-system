<div>
    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="min-width: 160px">หัวข้อ</th>
                        <th>รายละเอียด</th>
                        <th style="min-width: 160px"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>รูปภาพอาจารย์</th>
                        @if ($toggle['teacher_image'])
                            <td>
                                <div class="input-field">
                                    <input class="form-input" wire:model="teacher_image" type="file"
                                        placeholder="เลือกไฟล์" required>
                                    @error('teacher_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="button-container">
                                    <button class="btn btn-success" wire:click="save('teacher_image')">บันทึก</button>
                                    <button class="btn btn-danger" wire:click="cancel('teacher_image')">ยกเลิก</button>
                                </div>
                            </td>
                        @else
                            <td>
                                <img wire:live src="{{ asset('storage/' . $teacher->teacher_image) }}"
                                    alt="{{ $teacher->name }}"
                                    style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            </td>
                            <td>
                                <div class="button-container">
                                    <button class="btn btn-orange" wire:click="edit('teacher_image')"><i
                                            class='bx bx-edit'></i></button>
                                </div>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <th>คำนำหน้าชื่อ</th>
                        @if ($toggle['prefix'])
                            <td>
                                <div class="input-field">
                                    <select class="form-select" wire:model.live="prefix">
                                        <option selected>คำนำหน้าชื่อ</option>
                                        <option value="นาย">นาย</option>
                                        <option value="นาง">นาง</option>
                                        <option value="นางสาว">นางสาว</option>
                                        <option value="อื่นๆ">อื่นๆ</option>
                                    </select>
                                    @if ($this->prefix == 'อื่นๆ')
                                        <input class="form-input" wire:model="other_prefix" type="text"
                                            placeholder="คำนำหน้าชื่อ" required>
                                    @endif
                                    @error('prefix')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="button-container">
                                    <button class="btn btn-success" wire:click="save('prefix')">บันทึก</button>
                                    <button class="btn btn-danger" wire:click="cancel('prefix')">ยกเลิก</button>
                                </div>
                            </td>
                        @else
                            <td>{{ $teacher->prefix }}</td>
                            <td>
                                <button class="btn btn-orange" wire:click="edit('prefix')"><i
                                        class='bx bx-edit'></i></button>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <th>ชื่อ</th>
                        @if ($toggle['name'])
                            <td>
                                <div class="input-field">
                                    <input class="form-input" wire:model="name" type="text"
                                        placeholder="กรุณากรอกชื่อ" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="button-container">
                                    <button class="btn btn-success" wire:click="save('name')">บันทึก</button>
                                    <button class="btn btn-danger" wire:click="cancel('name')">ยกเลิก</button>
                                </div>
                            </td>
                        @else
                            <td>{{ $teacher->name }}</td>
                            <td>
                                <button class="btn btn-orange" wire:click="edit('name')"><i
                                        class='bx bx-edit'></i></button>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <th>นามสกุล</th>
                        @if ($toggle['surname'])
                            <td>
                                <div class="input-field">
                                    <input class="form-input" wire:model="surname" type="text"
                                        placeholder="กรุณากรอกนามสกุล" required>
                                    @error('surname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="button-container">
                                    <button class="btn btn-success" wire:click="save('surname')">บันทึก</button>
                                    <button class="btn btn-danger" wire:click="cancel('surname')">ยกเลิก</button>
                                </div>
                            </td>
                        @else
                            <td>{{ $teacher->surname }}</td>
                            <td>
                                <button class="btn btn-orange" wire:click="edit('surname')"><i
                                        class='bx bx-edit'></i></button>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <th>รูปภาพลายเซ็น</th>
                        @if ($toggle['signature_image'])
                            <td>
                                <div class="input-field"></div>
                                <input class="form-input" wire:model="signature_image" type="file"
                                    placeholder="เลือกไฟล์" required>
                                @error('signature_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <div class="button-container">
                                    <button class="btn btn-success" wire:click="save('signature_image')">บันทึก</button>
                                    <button class="btn btn-danger"
                                        wire:click="cancel('signature_image')">ยกเลิก</button>
                                </div>
                            </td>
                        @else
                            <td><img src="{{ $teacher->signature_image }}" alt=""></td>
                            <td>
                                <button class="btn btn-orange" wire:click="edit('signature_image')"><i
                                        class='bx bx-edit'></i></button>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <th>ตำแหน่งทางวิชาการ</th>
                        @if ($toggle['academic_position'])
                            <td>
                                <div class="input-field">
                                    <input class="form-input" wire:model="academic_position" type="text"
                                        placeholder="กรุณากรอกตำแหน่งทางวิชาการ" required>
                                    @error('academic_position')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="button-container">
                                    <button class="btn btn-success"
                                        wire:click="save('academic_position')">บันทึก</button>
                                    <button class="btn btn-danger"
                                        wire:click="cancel('academic_position')">ยกเลิก</button>
                                </div>
                            </td>
                        @else
                            <td>{{ $teacher->academic_position }}</td>
                            <td>
                                <button class="btn btn-orange" wire:click="edit('academic_position')"><i
                                        class='bx bx-edit'></i></button>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <th>วุฒิการศึกษา</th>
                        @if ($toggle['educational_qualification'])
                            <td>
                                <div class="form-floating">
                                    <textarea class="form-control" wire:model="educational_qualification" type="text"
                                        placeholder="กรุณากรอกวุฒิการศึกษา" required></textarea>
                                    @error('educational_qualification')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="button-container">
                                    <button class="btn btn-success"
                                        wire:click="save('educational_qualification')">บันทึก</button>
                                    <button class="btn btn-danger"
                                        wire:click="cancel('educational_qualification')">ยกเลิก</button>
                                </div>
                            </td>
                        @else
                            <td>{{ $teacher->educational_qualification }}</td>
                            <td>
                                <button class="btn btn-orange" wire:click="edit('educational_qualification')"><i
                                        class='bx bx-edit'></i></button>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <th>สาขาที่จบการศึกษา</th>
                        @if ($toggle['branch'])
                            <td>
                                <div class="form-floating">
                                    <textarea class="form-control" wire:model="branch" type="text" placeholder="กรุณากรอกสาขาที่จบการศึกษา" required></textarea>
                                    @error('branch')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="button-container">
                                    <button class="btn btn-success" wire:click="save('branch')">บันทึก</button>
                                    <button class="btn btn-danger" wire:click="cancel('branch')">ยกเลิก</button>
                                </div>
                            </td>
                        @else
                            <td>{{ $teacher->branch }}</td>
                            <td>
                                <button class="btn btn-orange" wire:click="edit('branch')"><i
                                        class='bx bx-edit'></i></button>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <th>เบอร์โทรศัพท์</th>
                        @if ($toggle['tel'])
                            <td>
                                <div class="input-field">
                                    <input class="form-input" wire:model="tel" type="tel"
                                        placeholder="กรุณากรอกเบอร์โทร" maxlength="10" minlength="10" required>
                                    @error('tel')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="button-container">
                                    <button class="btn btn-success" wire:click="save('tel')">บันทึก</button>
                                    <button class="btn btn-danger" wire:click="cancel('tel')">ยกเลิก</button>
                                </div>
                            </td>
                        @else
                            <td>
                                @if ($teacher->tel == null)
                                    <p class="text-danger">ไมมีการลงบันทึกข้อมูล</p>
                                @else
                                    {{ $teacher->tel }}
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-orange" wire:click="edit('tel')"><i
                                        class='bx bx-edit'></i></button>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <th>อีเมล</th>
                        @if ($toggle['email'])
                            <td>
                                <div class="input-field">
                                    <input class="form-input" wire:model="email" type="email"
                                        placeholder="กรุณากรอกอีเมล" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="button-container">
                                    <button class="btn btn-success" wire:click="save('email')">บันทึก</button>
                                    <button class="btn btn-danger" wire:click="cancel('email')">ยกเลิก</button>
                                </div>
                            </td>
                        @else
                            <td>{{ $teacher->email }}</td>
                            <td>
                                <button class="btn btn-orange" wire:click="edit('email')"><i
                                        class='bx bx-edit'></i></button>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <th>ไอดีไลน์</th>
                        @if ($toggle['id_line'])
                            <td>
                                <div class="input-field">
                                    <input class="form-input" wire:model="id_line" type="text"
                                        placeholder="กรุณากรอกไอดีไลน์" required>
                                    @error('id_line')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="button-container">
                                    <button class="btn btn-success" wire:click="save('id_line')">บันทึก</button>
                                    <button class="btn btn-danger" wire:click="cancel('id_line')">ยกเลิก</button>
                                </div>
                            </td>
                        @else
                            <td>
                                @if ($teacher->id_line == null)
                                    <p class="text-danger">ไมมีการลงบันทึกข้อมูล</p>
                                @else
                                    {{ $teacher->id_line }}
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-orange" wire:click="edit('id_line')"><i
                                        class='bx bx-edit'></i></button>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <th>รหัสผ่าน</th>
                        @if ($toggle['password'])
                            <td>
                                <div class="input-field">
                                    <input class="form-input" wire:model="password" type="password"
                                        placeholder="กรุณากรอกรหัสผ่าน" minlength="8" required>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="button-container">
                                    <button class="btn btn-success" wire:click="save('password')">บันทึก</button>
                                    <button class="btn btn-danger" wire:click="cancel('password')">ยกเลิก</button>
                                </div>
                            </td>
                        @else
                            <td>
                                {{ $teacher->password }}
                            </td>
                            <td>
                                <button class="btn btn-orange" wire:click="edit('password')"><i
                                        class='bx bx-edit'></i></button>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <th>ประเภทบัญชีผู้ใช้</th>
                        <td>{{ $teacher->user_type }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>สถานะบัญชี</th>
                        <td>
                            @if ($teacher->account_status == '1')
                                <p class="text-success">อนุมัติ</p>
                            @else
                                <p class="text-danger">ถูกระงับ</p>
                            @endif
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
