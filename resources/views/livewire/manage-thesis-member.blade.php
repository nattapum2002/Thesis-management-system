<div>
    {{-- จัดการบทความปริญญานิพนธ์ --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">จัดการบทความปริญญานิพนธ์</h3>
            <div class="btn btn-success btn-sm" href="#">เพิ่มบทความปริญญานิพนธ์</div>
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
                        <th style="width: auto">ชื่อบทความปริญญานิพนธ์</th>
                        <th style="width: auto">ปีการศึกษา</th>
                        <th style="width: auto">ไฟล์บทความปริญญานิพนธ์</th>
                        <th style="width: auto">สถานะ</th>
                        <th style="width: auto"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>ระบบจัดการปริญญานิพนธ์</td>
                        <td>2565</td>
                        <td><a href="#">ไฟล์</a></td>
                        <td>เผยแพร</td>
                        <td class="text-right">
                            <a class="btn btn-primary btn-sm" href="#">รายละเอียด/แก้ไขบทความ</a>
                            <a class="btn btn-success btn-sm" href="#">เผยแพรบทความ</a>
                            <a class="btn btn-danger btn-sm" href="#">ซ่อนบทความ</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- รายละเอียดบทความปริญญานิพนธ์ --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">รายละเอียดบทความปริญญานิพนธ์</h3>
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
                            <th>ชื่อบทความปริญญานิพนธ์</th>
                            <td>
                                <a href="#"><i class='bx bx-edit'></i></a>
                                ระบบจัดการปริญญานิพนธ์
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
                            <th>ปีการศึกษา</th>
                            <td>
                                <a href="#"><i class='bx bx-edit'></i></a>
                                2565
                            </td>
                        </tr>
                        <tr>
                            <th>ไฟล์</th>
                            <td>
                                <a href="#"><i class='bx bx-edit'></i></a>
                                ไฟล์
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

    {{-- เพิ่มบทความปริญญานิพนธ์ --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">เพิ่มบทความปริญญานิพนธ์</h3>
        </div>
        <div class="card-body">
            <form action="#">
                <div class="news">
                    <div class="fields">
                        <div class="input-field">
                            <label class="form-label">หัวข้อบทความปริญญานิพนธ์</label>
                            <input class="form-input" type="text" wire:model='#' placeholder="กรุณากรอกหัวข้อบทความ"
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
                            <label class="form-label">ปีการศึกษา</label>
                            <input class="form-input" type="text" wire:model='#' placeholder="กรุณากรอกรายละเอียด"
                                required>
                            @error('#')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">ไฟล์</label>
                            <input class="form-input" type="file" wire:model='#'>
                            @error('#')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">สถานะ</label>
                            <select class="form-select" wire:model='#' required>
                                <option selected value="1">เผยแพร</option>
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
    </div>
</div>