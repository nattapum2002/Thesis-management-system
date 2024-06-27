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
                                <input class="form-input" wire:model="edit_student_image" type="file"
                                    placeholder="เลือกไฟล์" required>
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
                            <img wire:live src="{{ asset('storage/'.$student->student_image) }}"
                                alt="{{ $student->name }}"
                                style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
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
                        @if ($toggle['student_id'])
                        <td>
                            <div class="input-field">
                                <input class="form-input" wire:model="edit_student_id" type="text"
                                    placeholder="กรุณากรอกรหัสนักศึกษา" required>
                                @error('student_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="button-container">
                                <button class="btn btn-success" wire:click="save('student_id')">บันทึก</button>
                                <button class="btn btn-danger" wire:click="cancel('student_id')">ยกเลิก</button>
                            </div>
                        </td>
                        @else
                        <td>{{ $student->student_id }}</td>
                        <td>
                            <button class="btn btn-primary" wire:click="edit('student_id')"><i
                                    class='bx bx-edit'></i></button>
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <th>ชื่อ</th>
                        @if ($toggle['name'])
                        <td>
                            <div class="input-field">
                                <input class="form-input" wire:model="edit_name" type="text" placeholder="กรุณากรอกชื่อ"
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
                        <th>หลักสูตร</th>
                        @if ($toggle['course'])
                        <td>
                            <div class="input-field">
                                <input class="form-input" wire:model="edit_course" type="text"
                                    placeholder="กรุณากรอกหลักสูตร" required>
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
                        <td>{{ $student->course }}</td>
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
                                <input class="form-input" wire:model="edit_level" type="text"
                                    placeholder="กรุณากรอกระดับ" required>
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
                        <td>{{ $student->level }}</td>
                        <td>
                            <button class="btn btn-primary" wire:click="edit('level')"><i
                                    class='bx bx-edit'></i></button>
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <th>ภาค</th>
                        @if ($toggle['section'])
                        <td>
                            <div class="input-field">
                                <input class="form-input" wire:model="edit_section" type="text"
                                    placeholder="กรุณากรอกภาค" required>
                                @error('section')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="button-container">
                                <button class="btn btn-success" wire:click="save('section')">บันทึก</button>
                                <button class="btn btn-danger" wire:click="cancel('section')">ยกเลิก</button>
                            </div>
                        </td>
                        @else
                        <td>{{ $student->section }}</td>
                        <td>
                            <button class="btn btn-primary" wire:click="edit('section')"><i
                                    class='bx bx-edit'></i></button>
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <th>เบอร์โทรศัพท์</th>
                        @if ($toggle['tel'])
                        <td>
                            <div class="input-field">
                                <input class="form-input" wire:model="edit_tel" type="tel"
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
                                <input class="form-input" wire:model="edit_email" type="email"
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
                                <input class="form-input" wire:model="edit_line_id" type="text"
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
                        <td>{{ $student->line_id }}</td>
                        <td>
                            <button class="btn btn-primary" wire:click="edit('line_id')"><i
                                    class='bx bx-edit'></i></button>
                        </td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>