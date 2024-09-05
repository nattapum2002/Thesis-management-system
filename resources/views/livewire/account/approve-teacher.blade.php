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
                        <td>
                            @if ($teacher->teacher_image)
                                {{-- Thesis-management-system/storage/app/public/ --}}
                                <img wire:live src="{{ asset('storage/' . $teacher->teacher_image) }}"
                                    alt="{{ $teacher->name }}"
                                    style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            @else
                                <img wire:live src="{{ asset('Asset/dist/img/avatar' . rand('1', '5') . '.png') }}"
                                    alt="{{ $teacher->name }}"
                                    style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            @endif
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>คำนำหน้าชื่อ</th>
                        <td>{{ $teacher->prefix }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>ชื่อ</th>
                        <td>{{ $teacher->name }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>นามสกุล</th>
                        <td>{{ $teacher->surname }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>รูปภาพลายเซ็น</th>
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
                        <td></td>
                    </tr>
                    <tr>
                        <th>ตำแหน่งทางวิชาการ</th>
                        <td>{{ $teacher->academic_position }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>วุฒิการศึกษา</th>
                        <td>{{ $teacher->educational_qualification }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>สาขาที่จบการศึกษา</th>
                        <td>{{ $teacher->branch }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>เบอร์โทรศัพท์</th>
                        <td>
                            @if ($teacher->tel == null)
                                <p class="text-danger">ไมมีการลงบันทึกข้อมูล</p>
                            @else
                                {{ $teacher->tel }}
                            @endif
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>อีเมล</th>
                        <td>{{ $teacher->email }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>ไอดีไลน์</th>
                        <td>
                            @if ($teacher->id_line == null)
                                <p class="text-danger">ไมมีการลงบันทึกข้อมูล</p>
                            @else
                                {{ $teacher->id_line }}
                            @endif
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>รหัสผ่าน</th>
                        <td>
                            {{ $teacher->password }}
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>ประเภทบัญชีผู้ใช้</th>
                        @if ($toggle['user_type'])
                            <td>
                                <div class="input-field">
                                    <select class="form-select" wire:model.live="user_type">
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
                                <button class="btn btn-orange {{ $account_count < 2 ? 'disabled' : '' }}"
                                    wire:click="edit('user_type')"><i class='bx bx-edit'></i></button>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <th>สถานะบัญชี</th>
                        @if ($toggle['account_status'])
                            <td>
                                <div class="input-field">
                                    <select class="form-select" wire:model.live="account_status">
                                        <option selected value="1">อนุมัติ</option>
                                        <option value="0">ระงับบัญชี</option>
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
                                    <p class="text-success">อนุมัติ</p>
                                @else
                                    <p class="text-danger">ถูกระงับ</p>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-orange {{ $account_count < 2 ? 'disabled' : '' }}"
                                    wire:click="edit('account_status')"><i class='bx bx-edit'></i></button>
                            </td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
