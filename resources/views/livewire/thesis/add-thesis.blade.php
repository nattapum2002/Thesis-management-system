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
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>รูปภาพบทความ</th>
                        <td>
                            <div class="input-field">
                                <input class="form-control" wire:model="add_thesis_image" type="file"
                                    placeholder="เลือกไฟล์">
                            </div>
                            @error('add_thesis_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
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
                            </div>
                            @error('add_project')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>บทคัดย่อ</th>
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
                        <th>ปีการศึกษา</th>
                        <td>
                            <div class="input-field">
                                <select class="form-select" wire:model='add_year'>
                                    <option selected>กรุณาเลือกปีการศึกษา</option>
                                    <option value="{{ now()->format('Y') }}">
                                        {{ now()->thaidate('Y') }}
                                    </option>
                                    <option value="{{ now()->subYear()->format('Y') }}">
                                        {{ now()->subYear()->thaidate('Y') }}
                                    </option>
                                </select>
                            </div>
                            @error('add_year')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>ประเภทบทความ</th>
                        <td>
                            <div class="input-group">
                                <select class="form-select" wire:model.live="add_type">
                                    <option selected>ประเภทบทความ</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->type }}">{{ $type->type }}</option>
                                    @endforeach
                                    <option value="อื่นๆ">อื่นๆ</option>
                                </select>
                                @if ($this->add_type == 'อื่นๆ')
                                    <input class="form-control" wire:model="add_other_type" type="text"
                                        placeholder="กรุณากรอกประเภทบทความ">
                                @endif
                            </div>
                            @error('add_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @error('add_other_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>ไฟล์บทความ</th>
                        <td>
                            <div class="input-field">
                                <input class="form-control" wire:model="add_thesis_file" type="file"
                                    placeholder="เลือกไฟล์">
                            </div>
                            @error('add_thesis_file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
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
                            </div>
                            @error('add_status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td></td>
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
