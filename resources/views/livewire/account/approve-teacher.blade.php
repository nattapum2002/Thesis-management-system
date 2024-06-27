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
                        <th>รูปภาพอาจารย์</th>
                        <td colspan="2">
                            <img wire:live src="{{ asset('storage/'.$teacher->teacher_image)}}"
                                alt="{{ $teacher->name }}"
                                style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        </td>
                    </tr>
                    <tr>
                        <th>คำนำหน้าชื่อ</th>
                        <td colspan="2">{{ $teacher->prefix }}</td>
                    </tr>
                    <tr>
                        <th>ชื่อ</th>
                        <td colspan="2">{{ $teacher->name }}</td>
                    </tr>
                    <tr>
                        <th>นามสกุล</th>
                        <td colspan="2">{{ $teacher->surname }}</td>
                    </tr>
                    <tr>
                        <th>รูปภาพลายเซ็น</th>
                        <td colspan="2"><img src="{{ asset('storage/'.$teacher->signature_image) }}"
                                alt="{{ $teacher->name }}"></td>
                    </tr>
                    <tr>
                        <th>ตำแหน่งทางวิชาการ</th>
                        <td colspan="2">{{ $teacher->academic_position }}</td>
                    </tr>
                    <tr>
                        <th>วุฒิการศึกษา</th>
                        <td colspan="2">{{ $teacher->educational_qualification }}</td>
                    </tr>
                    <tr>
                        <th>สาขาที่จบการศึกษา</th>
                        <td colspan="2">{{ $teacher->branch }}</td>
                    </tr>
                    <tr>
                        <th>เบอร์โทรศัพท์</th>
                        <td colspan="2">
                            @if ($teacher->tel == null)
                            <p class="text-danger">ไมมีการลงบันทึกข้อมูล</p>
                            @else
                            {{ $teacher->tel }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>อีเมล</th>
                        <td colspan="2">{{ $teacher->email }}</td>
                    </tr>
                    <tr>
                        <th>ไอดีไลน์</th>
                        <td colspan="2">
                            @if ($teacher->id_line == null)
                            <p class="text-danger">ไมมีการลงบันทึกข้อมูล</p>
                            @else
                            {{ $teacher->id_line }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>รหัสผ่าน</th>
                        <td colspan="2">
                            {{ $teacher->password }}
                        </td>
                    </tr>
                    <tr>
                        <th>ประเภทบัญชีผู้ใช้</th>
                        @if ($toggle['user_type'])
                        <td>
                            <div class="input-field">
                                <select class="form-select" wire:model.live="edit_user_type">
                                    <option selected>ประเภทบัญชีผู้ใช้</option>
                                    <option value="Admin">อาจารย์ประจำวิชา (Admin)</option>
                                    <option value="Branch head">หัวหน้าสาขา</option>
                                    <option value="Teacher">อาจารย์</option>
                                </select>
                                @error('user_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="button-container">
                                <button class="btn btn-success" wire:click="save('user_type')">บันทึก</button>
                                <button class="btn btn-danger" wire:click="cancel('user_type')">ยกเลิก</button>
                            </div>
                        </td>
                        @else
                        <td>
                            @if ($teacher->user_type == 'Admin')
                            อาจารย์ประจำวิชา
                            @elseif ($teacher->user_type == 'Branch head')
                            หัวหน้าสาขา
                            @elseif ($teacher->user_type == 'Teacher')
                            อาจารย์
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-primary" wire:click="edit('user_type')"><i
                                    class='bx bx-edit'></i></button>
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <th>สถานะบัญชี</th>
                        @if ($toggle['account_status'])
                        <td>
                            <div class="input-field">
                                <select class="form-select" wire:model.live="edit_account_status">
                                    <option selected value="1">ยังใช้งาน</option>
                                    <option value="0">ยกเลิกใช้งาน</option>
                                </select>
                                @error('account_status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="button-container">
                                <button class="btn btn-success" wire:click="save('account_status')">บันทึก</button>
                                <button class="btn btn-danger" wire:click="cancel('account_status')">ยกเลิก</button>
                            </div>
                        </td>
                        @else
                        <td>
                            @if ($teacher->account_status == '1')
                            <p class="text-success">บัญชียังถูกใช้งาน</p>
                            @else
                            <p class="text-danger">บัญชีถูกยกเลิกใช้งาน</p>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-primary" wire:click="edit('account_status')"><i
                                    class='bx bx-edit'></i></button>
                        </td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>