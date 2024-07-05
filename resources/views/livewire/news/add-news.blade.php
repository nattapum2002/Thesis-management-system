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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>รูปภาพข่าว</th>
                        <td>
                            <div class="input-field">
                                <input class="form-input" wire:model="add_news_image" type="file"
                                    placeholder="เลือกไฟล์">
                                @error('teacher_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>หัวข้อ</th>
                        <td>
                            <div class="input-field">
                                <input class="form-input" wire:model="add_title" type="text"
                                    placeholder="กรุณากรอกหัวข้อข่าว">
                                @error('news_title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>รายละเอียด</th>
                        <td>
                            <div class="input-field">
                                <textarea class="form-input" wire:model="add_detail" type="text"
                                    placeholder="กรุณากรอกรายละเอียด"></textarea>
                                @error('news_detail')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>ประเภทข่าว</th>
                        <td>
                            <div class="input-field">
                                <select class="form-select" wire:model.live="add_type">
                                    <option selected>ประเภทข่าว</option>
                                    <option value="ทั่วไป">ข่าวทั่วไป</option>
                                    <option value="หัวข้อ">ชื่อหัวข้อ</option>
                                </select>
                                @error('user_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>สถานะข่าว</th>
                        <td>
                            <div class="input-field">
                                <select class="form-select" wire:model.live="add_status">
                                    <option selected>สถานะข่าว</option>
                                    <option value="1">แสดง</option>
                                    <option value="0">ซ่อน</option>
                                </select>
                                @error('add_status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td colspan="2">
                            <button class="btn btn-success" wire:click="add">เพิ่มข่าว</button>
                            <button class="btn btn-danger" wire:click="cancel">ยกเลิก</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
