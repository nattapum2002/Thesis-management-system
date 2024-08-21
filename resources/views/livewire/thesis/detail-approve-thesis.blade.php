<div>
    <section id="detail-approve-thesis">
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
                            <td></td>
                        </tr>
                        <tr>
                            <th>ชื่อบทความ</th>
                            <td>{{ $thesis->title }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>รายละเอียด</th>
                            <td>{{ $thesis->details }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>ปีการศึกษา</th>
                            <td>{{ thaidate('Y', $thesis->year_published) }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>ประเภทบทความ</th>
                            <td>{{ $thesis->type }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>ไฟล์บทความ</th>
                            <td>
                                @if ($thesis->file_dissertation == null)
                                    <p class="text-danger">ไม่มีไฟล์</p>
                                @else
                                    {{ $thesis->file_dissertation }}
                                @endif
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>สถานะบทความ</th>
                            @if ($toggle['status'])
                                <td>
                                    <div class="input-field">
                                        <select class="form-select" wire:model.live="status">
                                            <option selected>สถานะบทความ</option>
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
