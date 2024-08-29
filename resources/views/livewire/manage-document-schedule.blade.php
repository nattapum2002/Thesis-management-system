<div>
    {{-- จัดการกำหนดการเอกสาร --}}
    <div class="card">
        <div class="container">
            <h3>จัดการกำหนดการเอกสาร</h3>
            <div class="btn btn-success btn-sm" href="#">เพิ่มกำหนดการเอกสาร</div>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search">
                <button class="btn btn-orange" type="submit"><i class='bx bx-search'></i></button>
            </div>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th style="width: auto">รายชื่อเอกสาร</th>
                        <th style="width: auto">กำหนดส่ง(เวลา)</th>
                        <th style="width: auto">กำหนดส่ง(วันที่)</th>
                        <th style="width: auto">ปีการศึกษา</th>
                        <th style="width: auto"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>เอกสาร 01</td>
                        <td>09.00 น.</td>
                        <td>14-05-2567</td>
                        <td>2567</td>
                        <td class="text-right">
                            <a class="btn btn-orange btn-sm" href="#">รายละเอียด/แก้ไข</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- รายละเอียดกำหนดการเอกสาร --}}
    <div class="card">
        <div class="container">
            <h3>รายละเอียดกำหนดการเอกสาร</h3>
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
                        <th>ชื่อเอกสาร</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            เอกสาร 01
                        </td>
                    </tr>
                    <tr>
                        <th>กำหนดส่ง(เวลา)</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            09.00 น.
                        </td>
                    </tr>
                    <tr>
                        <th>กำหนดส่ง(วันที่)</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            14-05-2567
                        </td>
                    </tr>
                    <tr>
                        <th>เวลาสอบ</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            ปีการศึกษา
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- เพิ่มกำหนดการเอกสาร --}}
    <div class="card">
        <div class="container">
            <h3>เพิ่มกำหนดการเอกสาร</h3>
        </div>
        <div class="card-body">
            <form action="#">
                <div class="topic-details">
                    <div class="fields">
                        <div class="input-field">
                            <label class="form-label">ชื่อเอกสาร</label>
                            <select class="form-select" wire:model='#' required>
                                <option selected>กรุณาเลือกชื่อเอกสาร</option>
                                <option value="d01">เอกสาร 01</option>
                                <option value="d02">เอกสาร 02</option>
                                <option value="d03">เอกสาร 03</option>
                                <option value="d04">เอกสาร 04</option>
                                <option value="d05">เอกสาร 05</option>
                                <option value="d06">เอกสาร 06</option>
                                <option value="d07">เอกสาร 07</option>
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
                            <label class="form-label">กำหนดส่ง(เวลา)</label>
                            <input class="form-input" type="time" wire:model='#' placeholder="กรุณากรอกเวลาสอบ"
                                required>
                            @error('#')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <label class="form-label">กำหนดส่ง(วันที่)</label>
                            <input class="form-input" type="date" wire:model='#' placeholder="กรุณากรอกวันสอบ"
                                required>
                            @error('#')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="semester-details">
                    <div class="fields">
                        {{-- <span>กำหนดปีการศึกษา</span>
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
                        </div> --}}
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

    <div class="card">
        <div class="container">
            <h3>กำหนดการเอกสาร</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: auto">#</th>
                        <th style="width: auto">รายชื่อเอกสาร</th>
                        <th style="width: auto">กำหนดส่ง(เวลา)</th>
                        <th style="width: auto">กำหนดส่ง(วันที่)</th>
                        <th style="width: auto">ปีการศึกษา</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>เอกสาร 01</td>
                        <td>09.00 น.</td>
                        <td>14-05-2567</td>
                        <td>2567</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
