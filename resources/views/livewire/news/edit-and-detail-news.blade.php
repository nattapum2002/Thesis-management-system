<div>
    @if ($news->id_teacher != Auth::guard('teachers')->user()->id_teacher)
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
                            <th>รูปภาพ</th>
                            <td colspan="2">
                                @if ($news->news_image == null)
                                <img src="{{ 'https://picsum.photos/id/' . rand(1, 1084) . '/1000/1000' }}" alt=""
                                    style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                @else
                                <img wire:live src="{{ asset('storage/'.$news->news_image)}}" alt="{{ $news->title }}"
                                    style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>หัวข้อ</th>
                            <td colspan="2">{{ $news->title }}</td>
                        </tr>
                        <tr>
                            <th>รายละเอียด</th>
                            <td colspan="2">{{ $news->details }}</td>
                        </tr>
                        <tr>
                            <th>ประเภทข่าว</th>
                            <td colspan="2">{{ $news->type }}</td>
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
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="button-container">
                                    <button class="btn btn-success" wire:click="save('status')">บันทึก</button>
                                    <button class="btn btn-danger" wire:click="cancel('status')">ยกเลิก</button>
                                </div>
                            </td>
                            @else
                            <td>
                                @if ($news->status == 1)
                                <p class="text-success">แสดง</p>
                                @else
                                <p class="text-danger">ซ่อน</p>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-primary" wire:click="edit('status')"><i
                                        class='bx bx-edit'></i></button>
                            </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <a href="/admin/approve_news/" class="btn btn-primary mb-3">ย้อนกลับ</a>
    @else
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
                            <th>รูปภาพ</th>
                            @if ($toggle['news_image'])
                            <td>
                                <div class="input-field">
                                    <input class="form-input" wire:model="news_image" type="file"
                                        placeholder="เลือกไฟล์" required>
                                    @error('news_image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="button-container">
                                    <button class="btn btn-success" wire:click="save('news_image')">บันทึก</button>
                                    <button class="btn btn-danger" wire:click="cancel('news_image')">ยกเลิก</button>
                                </div>
                            </td>
                            @else
                            <td>
                                @if ($news->news_image == null)
                                <img src="{{ 'https://picsum.photos/id/' . rand(1, 1084) . '/1000/1000' }}" alt=""
                                    style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                @else
                                <img wire:live src="{{ asset('storage/'.$news->news_image)}}" alt="{{ $news->title }}"
                                    style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                @endif
                            </td>
                            <td>
                                <div class="button-container">
                                    <button class="btn btn-primary" wire:click="edit('news_image')"><i
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
                                    <input class="form-input" wire:model="title" type="text" placeholder="หัวข้อ"
                                        required>
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
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
                                <button class="btn btn-primary" wire:click="edit('title')"><i
                                        class='bx bx-edit'></i></button>
                            </td>
                            @endif
                        </tr>
                        <tr>
                            <th>รายละเอียด</th>
                            @if ($toggle['details'])
                            <td>
                                <div class="input-field">
                                    <textarea class="form-input" wire:model="details" type="text"
                                        placeholder="รายละเอียด" required></textarea>
                                    @error('details')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
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
                                <button class="btn btn-primary" wire:click="edit('details')"><i
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
                                        <option value="ทั่วไป">ทั่วไป</option>
                                        <option value="หัวข้อ">หัวข้อ</option>
                                    </select>
                                    @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
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
                                <button class="btn btn-primary" wire:click="edit('type')"><i
                                        class='bx bx-edit'></i></button>
                            </td>
                            @endif
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
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="button-container">
                                    <button class="btn btn-success" wire:click="save('status')">บันทึก</button>
                                    <button class="btn btn-danger" wire:click="cancel('status')">ยกเลิก</button>
                                </div>
                            </td>
                            @else
                            <td>
                                @if ($news->status == 1)
                                <p class="text-success">แสดง</p>
                                @else
                                <p class="text-danger">ซ่อน</p>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-primary" wire:click="edit('status')"><i
                                        class='bx bx-edit'></i></button>
                            </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
