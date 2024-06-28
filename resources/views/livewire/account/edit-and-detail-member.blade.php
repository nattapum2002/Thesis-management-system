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
                        <th style="width: 200px">หัวข้อ</th>
                        <th style="width: 880px">รายละเอียด</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>รูปภาพนักศึกษา</th>
                        @if ($toggle['student_image'])
                        <td>
                            <div class="input-field">
                                <input class="form-input" wire:model="student_image" type="file" placeholder="เลือกไฟล์"
                                    required>
                                @error('student_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="button-container">
                                <button class="btn btn-success" wire:click="save('student_image')">บันทึก</button>
                                <button class="btn btn-danger" wire:click="cancel('student_image')">ยกเลิก</button>
                            </div>
                        </td>
                        @else
                        <td>
                            @if ($student->student_image == null)
                            <img wire:live src="{{ asset('Asset/dist/img/avatar'.rand('1', '5').'.png') }}"
                                alt="{{ $student->name }}"
                                style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            @else
                            <img wire:live src="{{ asset('storage/'.$student->student_image) }}"
                                alt="{{ $student->name }}"
                                style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            @endif
                        </td>
                        <td>
                            <div class="button-container">
                                <button class="btn btn-primary" wire:click="edit('student_image')"><i
                                        class='bx bx-edit'></i></button>
                            </div>
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <th>รหัสนักศึกษา</th>
                        <td colspan="2">{{ $student->id_student }}</td>
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
                        <td>{{ $student->prefix }}</td>
                        <td>
                            <button class="btn btn-primary" wire:click="edit('prefix')"><i
                                    class='bx bx-edit'></i></button>
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <th>ชื่อ</th>
                        @if ($toggle['name'])
                        <td>
                            <div class="input-field">
                                <input class="form-input" wire:model="name" type="text" placeholder="กรุณากรอกชื่อ"
                                    required>
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
                        <td>{{ $student->name }}</td>
                        <td>
                            <button class="btn btn-primary" wire:click="edit('name')"><i
                                    class='bx bx-edit'></i></button>
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <th>นามสกุล</th>
                        @if ($toggle['surname'])
                        <td>
                            <div class="input-field">
                                <input class="form-input" wire:model="surname" type="text" placeholder="กรุณากรอกชื่อ"
                                    required>
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
                        <td>{{ $student->surname }}</td>
                        <td>
                            <button class="btn btn-primary" wire:click="edit('surname')"><i
                                    class='bx bx-edit'></i></button>
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <th>หลักสูตร</th>
                        @if ($toggle['course'])
                        <td>
                            <div class="input-field">
                                <select class="form-select" wire:model.live="course">
                                    <option selected>หลักสูตร</option>
                                    @foreach ($courses as $course)
                                    <option value="{{ $course->id_course }}">{{ $course->course }}</option>
                                    @endforeach
                                </select>
                                @error('course')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="button-container">
                                <button class="btn btn-success" wire:click="save('course')">บันทึก</button>
                                <button class="btn btn-danger" wire:click="cancel('course')">ยกเลิก</button>
                            </div>
                        </td>
                        @else
                        <td>{{ $student->course->course }}</td>
                        <td>
                            <button class="btn btn-primary" wire:click="edit('course')"><i
                                    class='bx bx-edit'></i></button>
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <th>ระดับ</th>
                        @if ($toggle['level'])
                        <td>
                            <div class="input-field">
                                <select class="form-select" wire:model.live="level">
                                    <option selected>ระดับ</option>
                                    @foreach ($levels as $level)
                                    <option value="{{ $level->id_level }}">{{ $level->level }}</option>
                                    @endforeach
                                </select>
                                @error('level')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="button-container">
                                <button class="btn btn-success" wire:click="save('level')">บันทึก</button>
                                <button class="btn btn-danger" wire:click="cancel('level')">ยกเลิก</button>
                            </div>
                        </td>
                        @else
                        <td>{{ $student->level->level }}</td>
                        <td>
                            <button class="btn btn-primary" wire:click="edit('level')"><i
                                    class='bx bx-edit'></i></button>
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <th>ภาค</th>
                        @if ($toggle['sector'])
                        <td>
                            <div class="input-field">
                                <select class="form-select" wire:model.live="sector">
                                    <option selected>ระดับ</option>
                                    @foreach ($levels as $level)
                                    <option value="{{ $level->id_level }}">{{ $level->sector }}</option>
                                    @endforeach
                                </select>
                                @error('sector')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="button-container">
                                <button class="btn btn-success" wire:click="save('sector')">บันทึก</button>
                                <button class="btn btn-danger" wire:click="cancel('sector')">ยกเลิก</button>
                            </div>
                        </td>
                        @else
                        <td>{{ $student->level->sector }}</td>
                        <td>
                            <button class="btn btn-primary" wire:click="edit('sector')"><i
                                    class='bx bx-edit'></i></button>
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <th>เบอร์โทรศัพท์</th>
                        @if ($toggle['tel'])
                        <td>
                            <div class="input-field">
                                <input class="form-input" wire:model="tel" type="tel" placeholder="กรุณากรอกเบอร์โทร"
                                    maxlength="10" minlength="10" required>
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
                        <td>{{ $student->tel }}</td>
                        <td>
                            <button class="btn btn-primary" wire:click="edit('tel')"><i class='bx bx-edit'></i></button>
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <th>อีเมล</th>
                        @if ($toggle['email'])
                        <td>
                            <div class="input-field">
                                <input class="form-input" wire:model="email" type="email" placeholder="กรุณากรอกอีเมล"
                                    required>
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
                        <td>{{ $student->email }}</td>
                        <td>
                            <button class="btn btn-primary" wire:click="edit('email')"><i
                                    class='bx bx-edit'></i></button>
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <th>ไอดีไลน์</th>
                        @if ($toggle['line_id'])
                        <td>
                            <div class="input-field">
                                <input class="form-input" wire:model="line_id" type="text"
                                    placeholder="กรุณากรอกไอดีไลน์" required>
                                @error('line_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="button-container">
                                <button class="btn btn-success" wire:click="save('line_id')">บันทึก</button>
                                <button class="btn btn-danger" wire:click="cancel('line_id')">ยกเลิก</button>
                            </div>
                        </td>
                        @else
                        <td>{{ $student->id_line }}</td>
                        <td>
                            <button class="btn btn-primary" wire:click="edit('line_id')"><i
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
                            {{ $student->password }}
                        </td>
                        <td>
                            <button class="btn btn-primary" wire:click="edit('password')"><i
                                    class='bx bx-edit'></i></button>
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <th>สถานะบัญชี</th>
                        <td colspan="2">
                            @if ($student->account_status == '1')
                            <p class="text-success">อนุมัติ</p>
                            @else
                            <p class="text-danger">ถูกระงับ</p>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>