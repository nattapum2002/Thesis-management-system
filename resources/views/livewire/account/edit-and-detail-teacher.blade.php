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
                        <th style="width: 160px">หัวข้อ</th>
                        <th>รายละเอียด</th>
                        <th style="width: 160px"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>รูปภาพอาจารย์</th>
                        @if ($toggle['teacher_image'])
                            <td>
                                <div class="input-field">
                                    <input class="form-control" wire:model="teacher_image" type="file"
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
                                {{-- Thesis-management-system/storage/app/public/ --}}
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
                                        <input class="form-control" wire:model="other_prefix" type="text"
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
                                    <input class="form-control" wire:model="name" type="text"
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
                                    <input class="form-control" wire:model="surname" type="text"
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
                                <div class="input-field">
                                    <input class="form-control" wire:model="signature_image" type="file"
                                        placeholder="เลือกไฟล์" required>
                                    @error('signature_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="button-container">
                                    <button class="btn btn-success" wire:click="save('signature_image')">บันทึก</button>
                                    <button class="btn btn-danger"
                                        wire:click="cancel('signature_image')">ยกเลิก</button>
                                </div>
                            </td>
                        @else
                            <td>
                                @if ($teacher->signature_image)
                                    {{-- Thesis-management-system/storage/app/public/ --}}
                                    <img wire:live src="{{ asset('storage/' . $teacher->signature_image) }}"
                                        alt="{{ $teacher->name }}"
                                        style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                @else
                                    <span class="text-danger">ไมมีการลงบันทึกข้อมูล</span>
                                @endif
                            </td>
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
                                <div class="input-group">
                                    <select class="form-select" wire:model.live="academic_position">
                                        <option selected>ตำแหน่งทางวิชาการ</option>
                                        <option value="อาจารย์">อาจารย์</option>
                                        <option value="ผู้ช่วยศาตราจารย์">ผู้ช่วยศาตราจารย์</option>
                                        <option value="รองศาสตราจารย์">รองศาสตราจารย์</option>
                                        <option value="ศาสตราจารย์">ศาสตราจารย์</option>
                                        <option value="อื่นๆ">อื่นๆ</option>
                                    </select>
                                    @if ($this->academic_position == 'อื่นๆ')
                                        <input class="form-control" wire:model="other_academic_position"
                                            type="text" placeholder="กรุณากรอกตำแหน่งทางวิชาการ">
                                    @endif
                                </div>
                                @error('academic_position')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @error('other_academic_position')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
                                    <input class="form-control" wire:model="tel" type="tel"
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
                                    <input class="form-control" wire:model="email" type="email"
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
                        <th>LINE UserID</th>
                        @if ($toggle['id_line'])
                            <td>
                                <div class="input-field">
                                    {{-- <input class="form-control" wire:model="id_line" type="text"
                                        placeholder="กรุณากรอกไอดีไลน์" required> --}}
                                    <a href="{{ route('line.login') }}" class="btn btn-success">
                                        LINE Login
                                    </a>
                                    @error('id_line')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="button-container">
                                    {{-- <button class="btn btn-success" wire:click="save('id_line')">บันทึก</button> --}}
                                    <button class="btn btn-danger" wire:click="cancel('id_line')">ยกเลิก</button>
                                </div>
                            </td>
                        @else
                            <td>
                                @if ($teacher->id_line)
                                    <p class="text-success">ลงทะเบียน Line userID แล้ว กรุณาสแกน QR Code ด้านล่าง
                                        เพื่อรับการแจ้งเตือน</p>
                                    <img src="{{ asset('/Asset/main/img/TMS-Line-bot.png') }}" alt="TMS-Line-bot"
                                        style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                @else
                                    <p class="text-danger">ไมมีการลงบันทึกข้อมูล</p>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-orange" wire:click="edit('id_line')"><i
                                        class='bx bx-edit'></i></button>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <th>ชื่อผู้ใช้</th>
                        <td>{{ $teacher->username }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>รหัสผ่าน</th>
                        @if ($toggle['password'])
                            <td>
                                <div class="input-field">
                                    <p>หากต้องการเปลี่ยนรหัสผ่านกรุณากรอกรหัสผ่านเดิม</p>
                                    <input class="form-control" wire:model="old_password" type="password"
                                        placeholder="กรุณากรอกรหัสผ่านเดิม" minlength="8" required>
                                </div>
                                <span class="text-danger">{{ session('error') }}</span>
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="input-field">
                                    <input class="form-control mt-1" wire:model="new_password" type="password"
                                        placeholder="กรุณากรอกรหัสผ่านใหม่" minlength="8" required>
                                </div>
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="input-field">
                                    <input class="form-control mt-1" wire:model="new_password_confirmation"
                                        type="password" placeholder="กรุณากรอกรหัสผ่านใหม่อีกครั้ง" minlength="8">
                                </div>
                                @error('new_password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <div class="button-container">
                                    <button class="btn btn-success" wire:click="save('password')">บันทึก</button>
                                    <button class="btn btn-danger" wire:click="cancel('password')">ยกเลิก</button>
                                </div>
                            </td>
                        @else
                            <td></td>
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
