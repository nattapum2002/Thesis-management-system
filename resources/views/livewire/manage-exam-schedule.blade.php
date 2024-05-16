<div>
    {{-- จัดการกำหนดกรรมการและเวลาสอบ --}}
    <div class="card">
        <div class="container">
            <h3>จัดการกำหนดกรรมการและเวลาสอบ</h3>
            <div class="btn btn-success btn-sm" href="#">เพิ่มรายการสอบ</div>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search">
                <button class="btn btn-primary" type="submit"><i class='bx bx-search'></i></button>
            </div>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: auto">#</th>
                        <th style="width: auto">ประเภทการสอบ</th>
                        <th style="width: auto">รายชื่อโปรเจค</th>
                        <th style="width: auto">รายชื่อกรรมการ</th>
                        <th style="width: auto">เวลาสอบ</th>
                        <th style="width: auto">สถานที่สอบ</th>
                        <th style="width: auto"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>สอบหัวข้อ</td>
                        <td>
                            <p>ระบบจัดการปริญญานิพนธ์</p>
                            <small>Thesis Management System</small>
                        </td>
                        <td>
                            <p>อาจารย์ 1</p>
                            <p>อาจารย์ 2</p>
                            <p>อาจารย์ 3</p>
                        </td>
                        <td>
                            <p>09.00-12.00 น.</p>
                            <small>14-5-2567</small>
                        </td>
                        <td>ห้องปริญญานิพนธ์</td>
                        <td class="text-right">
                            <a class="btn btn-primary btn-sm" href="#">รายละเอียด/แก้ไข</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- รายละเอียดกำหนดกรรมการและเวลาสอบ --}}
    <div class="card">
        <div class="container">
            <h3>รายละเอียดกำหนดกรรมการและเวลาสอบ</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 20%">หัวข้อ</th>
                        <th style="width: auto">รายละเอียด</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>ประเภทการสอบ</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            <p>สอบหัวข้อ</p>
                        </td>
                    </tr>
                    <tr>
                        <th>ชื่อโปรเจค</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            <p>ระบบจัดการปริญญานิพนธ์</p>
                            <small>Thesis Management System</small>
                        </td>
                    </tr>
                    <tr>
                        <th>รายชื่อกรรมการ</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            <p>อาจารย์ 1</p>
                            <small>ประธานกรรมการ</small>
                            <p>อาจารย์ 2</p>
                            <small>กรรมการ</small>
                            <p>อาจารย์ 3</p>
                            <small>กรรมการและเลขา</small>
                        </td>
                    </tr>
                    <tr>
                        <th>เวลาสอบ</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            <p>09.00-12.00 น.</p>
                            <small>14-5-2567</small>
                        </td>
                    </tr>
                    <tr>
                        <th>สถานที่สอบ</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            <p>ห้องปริญญานิพนธ์</p>
                            <small>อาคารอทิตยาทร</small>
                            <small>คณะเกษตรและเทคโนโลยี</small>
                        </td>
                    </tr>
                    <tr>
                        <th>ปีการศึกษา</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            <p>ภาคเรียน 1</p>
                            <small>2567</small>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- เพิ่มกำหนดกรรมการและเวลาสอบ --}}
    <div class="card">
        <div class="container">
            <h3>เพิ่มรายการสอบ</h3>
        </div>
        <div class="card-body">
            <form action="#">
                <div class="topic-details">
                    <div class="fields">
                        <span>กำหนดหัวข้อ</span>
                        <div class="input-field">
                            <label class="form-label">ประเภทการสอบ</label>
                            <select class="form-select" wire:model='#' required>
                                <option selected>กรุณาเลือกประเภทการสอบ</option>
                                <option value="t-exam">สอบหัวข้อ</option>
                                <option value="f-exam">สอบจบ</option>
                            </select>
                            @error('#')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">ชื่อโปรเจค</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="ชื่อโปรเจค">
                                <button class="btn btn-primary" type="submit"><i class='bx bx-search'></i></button>
                            </div>
                            @error('#')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="director-details">
                    <div class="fields">
                        <span>กำหนดรายชื่อกรรมการ</span>
                        <div class="input-field">
                            <label class="form-label">ประธานกรรมการ</label>
                            <select class="form-select" wire:model='#' required>
                                <option selected>กรุณาเลือกประธานกรรมการ</option>
                                <option value="t1">อาจารย์ 1</option>
                                <option value="f2">อาจารย์ 2</option>
                            </select>
                            @error('#')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">กรรมการ</label>
                            <select class="form-select" wire:model='#' required>
                                <option selected>กรุณาเลือกกรรมการ</option>
                                <option value="t1">อาจารย์ 1</option>
                                <option value="f2">อาจารย์ 2</option>
                            </select>
                            @error('#')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">กรรมการและเลขานุการ</label>
                            <select class="form-select" wire:model='#' required>
                                <option selected>กรุณาเลือกกรรมการและเลขานุการ</option>
                                <option value="t1">อาจารย์ 1</option>
                                <option value="f2">อาจารย์ 2</option>
                            </select>
                            @error('#')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="time-details">
                    <div class="fields">
                        <span>กำหนดเวลา</span>
                        <div class="input-field">
                            <label class="form-label">เวลาสอบ</label>
                            <input class="form-input" type="time" wire:model='#' placeholder="กรุณากรอกเวลาสอบ"
                                required>
                            @error('#')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">วันสอบ</label>
                            <input class="form-input" type="date" wire:model='#' placeholder="กรุณากรอกวันสอบ" required>
                            @error('#')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="location-details">
                    <div class="fields">
                        <span>กำหนดสถานที่</span>
                        <div class="input-field">
                            <label class="form-label">ห้องสอบ</label>
                            <input class="form-input" type="text" wire:model='#' placeholder="กรุณากรอกห้องสอบ"
                                required>
                            @error('#')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">อาคารสอบ</label>
                            <input class="form-input" type="text" wire:model='#' placeholder="กรุณากรอกอาคารสอบ"
                                required>
                            @error('#')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">คณะ</label>
                            <select class="form-select" wire:model='#' required>
                                <option selected>กรุณาเลือกคณะ</option>
                                <option value="g1">คณะการจัดการ</option>
                                <option value="g2">คณะเกษตรและเทคโนโลยี</option>
                            </select>
                            @error('#')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="semester-details">
                    <div class="fields">
                        <span>กำหนดปีการศึกษา</span>
                        <div class="input-field">
                            <label class="form-label">ภาคการศึกษา</label>
                            <select class="form-select" wire:model='#' required>
                                <option selected>กรุณาภาคการศึกษา</option>
                                <option value="s1">ภาคเรียนที่ 1</option>
                                <option value="s2">ภาคเรียนที่ 2</option>
                                <option value="s3">ภาคฤดูร้อน</option>
                            </select>
                            @error('#')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">ปีการศึกษา</label>
                            <input class="form-input" type="number" wire:model='#' placeholder="กรุณากรอกปีการศึกษา"
                                required>
                            @error('#')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <button wire:click.prevent='add' type="submit" class="btn btn-success">บันทึก</button>
                        <button wire:click.prevent='cancel' type="button" class="btn btn-danger">ยกเลิก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- กำหนดการสอบ --}}
    <div class="card">
        <div class="container">
            <h3>กำหนดการสอบ</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: auto">#</th>
                        <th style="width: auto">ประเภทการสอบ</th>
                        <th style="width: auto">รายชื่อโปรเจค</th>
                        <th style="width: auto">รายชื่อกรรมการ</th>
                        <th style="width: auto">เวลาสอบ</th>
                        <th style="width: auto">สถานที่สอบ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>สอบหัวข้อ</td>
                        <td>
                            <p>ระบบจัดการปริญญานิพนธ์</p>
                            <small>Thesis Management System</small>
                        </td>
                        <td>
                            <p>อาจารย์ 1</p>
                            <p>อาจารย์ 2</p>
                            <p>อาจารย์ 3</p>
                        </td>
                        <td>
                            <p>09.00-12.00 น.</p>
                            <small>14-5-2567</small>
                        </td>
                        <td>ห้องปริญญานิพนธ์</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>