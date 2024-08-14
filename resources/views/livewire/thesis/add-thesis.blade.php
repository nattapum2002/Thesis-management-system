<div>
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
                        <th style="width: 200px">หัวข้อ</th>
                        <th style="width: 880px">รายละเอียด</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>รูปภาพบทความ</th>
                        <td>
                            <div class="input-field">
                                <input class="form-input" wire:model="add_thesis_image" type="file"
                                    placeholder="เลือกไฟล์">
                                @error('add_thesis_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>ชี่อบทความ</th>
                        <td>
                            <div class="input-field">
                                <select class="form-select" wire:model.live="add_project">
                                    <option selected>ชี่อบทความ</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id_project }}">
                                            {{ $project->project_name_th }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('add_project')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>บทคัดย่อ</th>
                        <td>
                            <div class="input-field">
                                <textarea class="form-input" wire:model="add_detail" type="text" placeholder="กรุณากรอกรายละเอียด"></textarea>
                                @error('news_detail')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>ปีการศึกษา</th>
                        <td>
                            <div class="input-field">
                                <select class="form-select" wire:model='add_year' required>
                                    <option selected>กรุณาเลือกปีการศึกษา</option>
                                    <option value="{{ now()->format('Y') }}">
                                        {{ now()->thaidate('Y') }}
                                    </option>
                                    <option value="{{ now()->subYear()->format('Y') }}">
                                        {{ now()->subYear()->thaidate('Y') }}
                                    </option>
                                </select>
                                @error('add_year')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>ประเภทบทความ</th>
                        <td>
                            <div class="input-field">
                                <select class="form-select" wire:model.live="add_type">
                                    <option selected>ประเภทบทความ</option>
                                    <option value="Software">Software</option>
                                    <option value="Hardware">Hardware</option>
                                </select>
                                @error('user_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>ไฟล์บทความ</th>
                        <td>
                            <div class="input-field">
                                <input class="form-input" wire:model="add_thesis_file" type="file"
                                    placeholder="เลือกไฟล์">
                                @error('add_thesis_file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>สถานะบทความ</th>
                        <td>
                            <div class="input-field">
                                <select class="form-select" wire:model.live="add_status">
                                    <option selected>สถานะบทความ</option>
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
                        <td>
                            <button class="btn btn-success" wire:click="add">เพิ่มบทความ</button>
                            <button class="btn btn-danger" wire:click="cancel">ยกเลิก</button>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
