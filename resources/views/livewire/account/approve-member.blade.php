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
                        <th>รูปภาพนักศึกษา</th>
                        <td>
                            @if ($student->student_image)
                                {{-- Thesis-management-system/storage/app/public/ --}}
                                <img wire:live src="{{ asset('storage/' . $student->student_image) }}"
                                    alt="{{ $student->name }}"
                                    style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            @else
                                <img wire:live src="{{ asset('Asset/dist/img/avatar' . rand('1', '5') . '.png') }}"
                                    alt="{{ $student->name }}"
                                    style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            @endif
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>รหัสนักศึกษา</th>
                        <td>{{ $student->id_student }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>คำนำหน้าชื่อ</th>
                        <td>{{ $student->prefix }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>ชื่อ</th>
                        <td>{{ $student->name }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>นามสกุล</th>
                        <td>{{ $student->surname }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>หลักสูตร</th>
                        <td>{{ $student->course->course }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>ระดับ</th>
                        <td>{{ $student->level->level }}</td>
                        <td></td>
                    <tr>
                        <th>ภาค</th>
                        <td>{{ $student->level->sector }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>เบอร์โทรศัพท์</th>
                        <td>{{ $student->tel }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>อีเมล</th>
                        <td>{{ $student->email }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>ไอดีไลน์</th>
                        <td>{{ $student->id_line }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>รหัสผ่าน</th>
                        <td>
                            {{ $student->password }}
                        </td>
                        <td></td>
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
                                @if ($student->account_status == '1')
                                    <p class="text-success">อนุมัติ</p>
                                @else
                                    <p class="text-danger">ถูกระงับ</p>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-orange" wire:click="edit('account_status')"><i
                                        class='bx bx-edit'></i></button>
                            </td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
