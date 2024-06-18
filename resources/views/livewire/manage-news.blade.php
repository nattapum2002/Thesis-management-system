<div>
    {{-- จัดการข่าว --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">จัดการข่าวประชาสัมพันธ์</h3>
            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                data-bs-target="#add-news">เพิ่มข่าวสาร</button>
            <div class="modal fade" id="add-news" wire:ignore.self tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="color: black;">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มข่าวประชาสัมพันธ์</h1>
                        </div>
                        <div class="modal-body">
                            <form wire:submit="addNews" action="#">
                                <div class="news">
                                    <div class="fields">
                                        <div class="row">
                                            <div class="input-field">
                                                <div class="col-sm-3">
                                                    <label class="form-label">หัวข้อข่าว</label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input class="form-input" type="text" wire:model='title'
                                                        placeholder="กรุณากรอกหัวข้อข่าว" required>
                                                </div>
                                                @error('#')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field">
                                                <div class="col-sm-3">
                                                    <label class="form-label">รายละเอียด</label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input class="form-input" type="text" wire:model='detail'
                                                        placeholder="กรุณากรอกรายละเอียด" required>
                                                </div>
                                                @error('#')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field">
                                                <div class="col-sm-3">
                                                    <label class="form-label">รูปภาพ</label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input class="form-input" type="file" wire:model='#'>
                                                </div>
                                                @error('#')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field">
                                                <div class="col-sm-3">
                                                    <label class="form-label">รูปแบบ</label>
                                                </div>
                                                <div class="col-sm-5">
                                                    <select class="form-select" wire:model='type' required>
                                                        <option selected>กรุณาเลือก</option>
                                                        <option value="1">ข่าวทั่วไป</option>
                                                        <option value="0">ข่าวประชาสัมพันธ์</option>
                                                    </select>
                                                </div>
                                                @error('#')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field">
                                                <div class="col-sm-3">
                                                    <label class="form-label">สถานะ</label>
                                                </div>
                                                <div class="col-sm-5">
                                                    <select class="form-select" wire:model='status' required>
                                                        <option selected>กรุณาเลือกสถานะ</option>
                                                        <option value="1">เผยแพร</option>
                                                        <option value="0">ซ่อน</option>
                                                    </select>
                                                </div>
                                                @error('#')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div>
                                        <button type="submit" class="btn btn-success">บันทึก</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-tools">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <button class="btn btn-primary" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: auto">#</th>
                        <th style="width: auto">ชื่อข่าว</th>
                        <th style="width: auto">รายละเอียด</th>
                        <th style="width: auto">สถานะ</th>
                        <th style="width: auto"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>ชื่อข่าว</td>
                        <td>รายละเอียด</td>
                        <td>เผยแพร</td>
                        <td class="text-right">
                            <a class="btn btn-primary btn-sm" href="#">รายละเอียด/แก้ไขข่าว</a>
                            <a class="btn btn-success btn-sm" href="#">เผยแพรข่าว</a>
                            <a class="btn btn-danger btn-sm" href="#">ซ่อนข่าว</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            {{-- <div class="row">
                <div class="col-sm-3">
                    <i class='bx bx-news'></i>
                    <h4 class="title">ชื่อข่าว</h4>
                    <p class="details">รายละเอียด</p>
                </div>
                <div class="col-sm-3">
                    <i class='bx bx-news'></i>
                    <h4 class="title">ชื่อข่าว</h4>
                    <p class="details">รายละเอียด</p>
                </div>
                <div class="col-sm-3">
                    <i class='bx bx-news'></i>
                    <h4 class="title">ชื่อข่าว</h4>
                    <p class="details">รายละเอียด</p>
                </div>
                <div class="col-sm-3">
                    <i class='bx bx-news'></i>
                    <h4 class="title">ชื่อข่าว</h4>
                    <p class="details">รายละเอียด</p>
                </div>
            </div> --}}
        </div>
    </div>

    {{-- รายละเอียดข่าว --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">รายละเอียดข่าว</h3>
        </div>
        <div class="card-body">
            <div class="details">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 20%">หัวข้อ</th>
                            <th style="width: auto">รายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>รูปภาพข่าว</th>
                            <td>
                                <a href="#"><i class='bx bx-edit'></i></a>
                                <i class='bx bx-news'></i>
                            </td>
                        </tr>
                        <tr>
                            <th>ชื่อข่าว</th>
                            <td>
                                <a href="#"><i class='bx bx-edit'></i></a>
                                ชื่อข่าว 1
                            </td>
                        </tr>
                        <tr>
                            <th>รายละเอียด</th>
                            <td>
                                <a href="#"><i class='bx bx-edit'></i></a>
                                รายละเอียด
                            </td>
                        </tr>
                        <tr>
                            <th>สถานะ</th>
                            <td>
                                <a href="#"><i class='bx bx-edit'></i></a>
                                ซ่อน
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- เพิ่มข่าว --}}
    {{-- <div class="card">
        <div class="card-header">
            <h3 class="card-title">เพิ่มข่าวประชาสัมพันธ์</h3>
        </div>
        <div class="card-body">
            <form action="#">
                <div class="news">
                    <div class="fields">
                        <div class="input-field">
                            <label class="form-label">หัวข้อข่าว</label>
                            <input class="form-input" type="text" wire:model='#' placeholder="กรุณากรอกหัวข้อข่าว"
                                required>
                            @error('#')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">รายละเอียด</label>
                            <input class="form-input" type="text" wire:model='#' placeholder="กรุณากรอกรายละเอียด"
                                required>
                            @error('#')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">รูปภาพ</label>
                            <input class="form-input" type="file" wire:model='#'>
                            @error('#')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">สถานะ</label>
                            <select class="form-select" wire:model='#' required>
                                <option selected>กรุณาเลือกสถานะ</option>
                                <option value="1">เผยแพร</option>
                                <option value="0">ซ่อน</option>
                            </select>
                            @error('#')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div>
                    <button wire:click.prevent='#' type="submit" class="btn btn-success">บันทึก</button>
                    <button wire:click.prevent='#' type="button" class="btn btn-danger">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div> --}}
</div>
