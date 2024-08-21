<div>
    <section id="edit-and-detail-thesis">
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
                            @if ($toggle['thesis_image'])
                                <td>
                                    <div class="input-field">
                                        <input class="form-input" wire:model="thesis_image" type="file"
                                            placeholder="เลือกไฟล์" required>
                                    </div>
                                    @error('thesis_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <div class="button-container">
                                        <button class="btn btn-success"
                                            wire:click="save('thesis_image')">บันทึก</button>
                                        <button class="btn btn-danger"
                                            wire:click="cancel('thesis_image')">ยกเลิก</button>
                                    </div>
                                </td>
                            @else
                                <td>
                                    @if ($thesis->thesis_image == null)
                                        <img src="{{ 'https://picsum.photos/id/' . rand(1, 1084) . '/1000/1000' }}"
                                            alt=""
                                            style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    @else
                                        <img wire:live src="{{ asset('storage/' . $thesis->thesis_image) }}"
                                            alt="{{ $thesis->title }}"
                                            style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    @endif
                                </td>
                                <td>
                                    <div class="button-container">
                                        <button class="btn btn-orange" wire:click="edit('thesis_image')"><i
                                                class='bx bx-edit'></i></button>
                                    </div>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <th>ชื่อบทความ</th>
                            @if ($toggle['title'])
                                <td>
                                    <div class="input-field">
                                        <select class="form-select" wire:model="title">
                                            <option selected>ชี่อบทความ</option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id_project }}">
                                                    {{ $project->project_name_th }}
                                                </option>
                                            @endforeach
                                        </select>
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
                                <td>{{ $thesis->title }}</td>
                                <td>
                                    <button class="btn btn-orange" wire:click="edit('title')"><i
                                            class='bx bx-edit'></i></button>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <th>บทคัดย่อ</th>
                            @if ($toggle['details'])
                                <td>
                                    <div class="input-field">
                                        <textarea class="form-input" wire:model="details" type="text" placeholder="บทคัดย่อ" required></textarea>
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
                                <td>{{ $thesis->details }}</td>
                                <td>
                                    <button class="btn btn-orange" wire:click="edit('details')"><i
                                            class='bx bx-edit'></i></button>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <th>ปีการศึกษา</th>
                            @if ($toggle['year_published'])
                                <td>
                                    <div class="input-field">
                                        <select class="form-select" wire:model='year_published' required>
                                            <option selected>กรุณาเลือกปีการศึกษา</option>
                                            <option value="{{ now()->format('Y') }}">
                                                {{ now()->thaidate('Y') }}
                                            </option>
                                            <option value="{{ now()->subYear()->format('Y') }}">
                                                {{ now()->subYear()->thaidate('Y') }}
                                            </option>
                                        </select>
                                    </div>
                                    @error('year_published')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <div class="button-container">
                                        <button class="btn btn-success"
                                            wire:click="save('year_published')">บันทึก</button>
                                        <button class="btn btn-danger"
                                            wire:click="cancel('year_published')">ยกเลิก</button>
                                    </div>
                                </td>
                            @else
                                <td>{{ thaidate('Y', $thesis->year_published) }}</td>
                                <td>
                                    <button class="btn btn-orange" wire:click="edit('year_published')"><i
                                            class='bx bx-edit'></i></button>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <th>ประเภทบทความ</th>
                            @if ($toggle['type'])
                                <td>
                                    <div class="input-group">
                                        <select class="form-select" wire:model.live="type">
                                            <option selected>ประเภทบทความ</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->type }}">{{ $type->type }}</option>
                                            @endforeach
                                            <option value="อื่นๆ">อื่นๆ</option>
                                        </select>
                                        @if ($this->type == 'อื่นๆ')
                                            <input class="form-control" wire:model="other_type" type="text"
                                                placeholder="กรุณากรอกประเภทบทความ">
                                        @endif
                                    </div>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @error('other_type')
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
                                <td>{{ $thesis->type }}</td>
                                <td>
                                    <button class="btn btn-orange" wire:click="edit('type')"><i
                                            class='bx bx-edit'></i></button>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <th>ไฟล์บทความ</th>
                            @if ($toggle['file_dissertation'])
                                <td>
                                    <div class="input-field">
                                        <input class="form-input" wire:model="file_dissertation" type="file"
                                            placeholder="เลือกไฟล์" required>
                                    </div>
                                    @error('file_dissertation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <div class="button-container">
                                        <button class="btn btn-success"
                                            wire:click="save('file_dissertation')">บันทึก</button>
                                        <button class="btn btn-danger"
                                            wire:click="cancel('file_dissertation')">ยกเลิก</button>
                                    </div>
                                </td>
                            @else
                                <td>
                                    @if ($thesis->file_dissertation == null)
                                        <p class="text-danger">ไม่มีไฟล์</p>
                                    @else
                                        <a href="{{ url('storage/' . $thesis->file_dissertation) }}"
                                            target="_blank">{{ basename($thesis->file_dissertation) }}</a>
                                    @endif
                                </td>
                                <td>
                                    <div class="button-container">
                                        <button class="btn btn-orange" wire:click="edit('file_dissertation')"><i
                                                class='bx bx-edit'></i></button>
                                    </div>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <th>สร้างเมื่อ</th>
                            <td>{{ thaidate('H:i น. วันl ที่ j F พ.ศ.Y', $thesis->created_at) }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>แก่ไขล่าสุดเมื่อ</th>
                            <td>{{ thaidate('H:i น. วันl ที่ j F พ.ศ.Y', $thesis->updated_at) }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>สถานะบทความ</th>
                            @if ($toggle['status'])
                                <td>
                                    <div class="input-field">
                                        <select class="form-select" wire:model="status">
                                            <option selected>สถานะบทความ</option>
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
                                    @if ($thesis->status == 1)
                                        <p class="text-success">แสดง</p>
                                    @else
                                        <p class="text-danger">ซ่อน</p>
                                    @endif
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
