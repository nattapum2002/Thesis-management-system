<div>
    <section id="edit-and-detail-news">
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
                            <th>รูปภาพ</th>
                            @if ($toggle['news_image'])
                                <td>
                                    <div class="input-field">
                                        <input class="form-control" wire:model="news_image" type="file"
                                            placeholder="เลือกไฟล์" required>
                                    </div>
                                    @error('news_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <div class="button-container">
                                        <button class="btn btn-success" wire:click="save('news_image')">บันทึก</button>
                                        <button class="btn btn-danger" wire:click="cancel('news_image')">ยกเลิก</button>
                                    </div>
                                </td>
                            @else
                                <td>
                                    @if ($news->news_image)
                                        {{-- Thesis-management-system/storage/app/public/ --}}
                                        <img wire:live src="{{ asset('storage/' . $news->news_image) }}"
                                            alt="{{ $news->title }}"
                                            style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    @else
                                        <img src="{{ 'https://picsum.photos/id/' . rand(1, 1084) . '/1000/1000' }}"
                                            alt=""
                                            style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    @endif
                                </td>
                                <td>
                                    <div class="button-container">
                                        <button class="btn btn-orange" wire:click="edit('news_image')"><i
                                                class='bx bx-edit'></i></button>
                                    </div>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <th>หัวข้อ</th>
                            @if ($toggle['title'])
                                <td>
                                    <div class="input-field">
                                        <input class="form-control" wire:model="title" type="text"
                                            placeholder="หัวข้อ" required>
                                    </div>
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <div class="button-container">
                                        <button class="btn btn-success" wire:click="save('title')">บันทึก</button>
                                        <button class="btn btn-danger" wire:click="cancel('title')">ยกเลิก</button>
                                    </div>
                                </td>
                            @else
                                <td>{{ $news->title }}</td>
                                <td>
                                    <button class="btn btn-orange" wire:click="edit('title')"><i
                                            class='bx bx-edit'></i></button>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <th>รายละเอียด</th>
                            @if ($toggle['details'])
                                <td>
                                    <div class="input-field">
                                        <textarea class="form-control" wire:model="details" type="text" placeholder="รายละเอียด" required></textarea>
                                    </div>
                                    @error('details')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <div class="button-container">
                                        <button class="btn btn-success" wire:click="save('details')">บันทึก</button>
                                        <button class="btn btn-danger" wire:click="cancel('details')">ยกเลิก</button>
                                    </div>
                                </td>
                            @else
                                <td>{{ $news->details }}</td>
                                <td>
                                    <button class="btn btn-orange" wire:click="edit('details')"><i
                                            class='bx bx-edit'></i></button>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <th>ประเภทข่าว</th>
                            @if ($toggle['type'])
                                <td>
                                    <div class="input-field">
                                        <select class="form-select" wire:model.live="type">
                                            <option selected>ประเภทข่าว</option>
                                            <option value="ข่าวทั่วไป">ข่าวทั่วไป</option>
                                            <option value="ชื่อหัวข้อ">ชื่อหัวข้อ</option>
                                        </select>
                                    </div>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <div class="button-container">
                                        <button class="btn btn-success" wire:click="save('type')">บันทึก</button>
                                        <button class="btn btn-danger" wire:click="cancel('type')">ยกเลิก</button>
                                    </div>
                                </td>
                            @else
                                <td>{{ $news->type }}</td>
                                <td>
                                    <button class="btn btn-orange" wire:click="edit('type')"><i
                                            class='bx bx-edit'></i></button>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <th>สร้างเมื่อ</th>
                            <td>{{ thaidate('H:i น. วันl ที่ j F พ.ศ.Y', $news->created_at) }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>แก้ไขล่าสุดเมื่อ</th>
                            <td>{{ thaidate('H:i น. วันl ที่ j F พ.ศ.Y', $news->updated_at) }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>สถานะข่าว</th>
                            @if ($toggle['status'])
                                <td>
                                    <div class="input-field">
                                        <select class="form-select" wire:model.live="status">
                                            <option selected>สถานะข่าว</option>
                                            <option value="1">แสดง</option>
                                            <option value="0">ซ่อน</option>
                                        </select>
                                    </div>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <div class="button-container">
                                        <button class="btn btn-success" wire:click="save('status')">บันทึก</button>
                                        <button class="btn btn-danger" wire:click="cancel('status')">ยกเลิก</button>
                                    </div>
                                </td>
                            @else
                                <td>
                                    <p class="{{ $news->status == 1 ? 'text-success' : 'text-danger' }}">
                                        {{ $news->status == 1 ? 'แสดง' : 'ซ่อน' }}
                                    </p>
                                </td>
                                <td>
                                    <button class="btn btn-orange" wire:click="edit('status')"><i
                                            class='bx bx-edit'></i></button>
                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
