<div>
    <section id="add-news">
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
                            <th>รูปภาพข่าว</th>
                            <td>
                                <div class="input-field">
                                    <input class="form-control" wire:model="add_news_image" type="file"
                                        placeholder="เลือกไฟล์">
                                </div>
                                @error('add_news_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>หัวข้อ</th>
                            <td>
                                <div class="input-field">
                                    <input class="form-control" wire:model="add_title" type="text"
                                        placeholder="กรุณากรอกหัวข้อข่าว">
                                </div>
                                @error('add_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>รายละเอียด</th>
                            <td>
                                <div class="input-field">
                                    <textarea class="form-control" wire:model="add_detail" type="text" placeholder="กรุณากรอกรายละเอียด"></textarea>
                                </div>
                                @error('add_detail')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>ประเภทข่าว</th>
                            <td>
                                <div class="input-field">
                                    <select class="form-select" wire:model.live="add_type">
                                        <option selected>ประเภทข่าว</option>
                                        <option value="ข่าวทั่วไป">ข่าวทั่วไป</option>
                                        <option value="ชื่อหัวข้อ">ชื่อหัวข้อ</option>
                                    </select>
                                </div>
                                @error('add_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td></td>
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
                                </div>
                                @error('add_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>เพิ่มข่าว</th>
                            <td>
                                <button class="btn btn-success" wire:click="add">เพิ่มข่าว</button>
                                <button class="btn btn-danger" wire:click="cancel">ยกเลิก</button>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
