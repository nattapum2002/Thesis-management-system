<div>
    {{-- จัดการโปรเจค --}}
    <div class="card">
        <div class="container">
            <h3>จัดการโปรเจค</h3>
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
                        <th style="width: auto">ชื่อโปรเจค</th>
                        <th style="width: auto">ชื่อนักศึกษา</th>
                        <th style="width: auto">ชื่ออาจารย์ที่ปรึกษาหลัก</th>
                        <th style="width: auto">สถานะการดำเนินงาน</th>
                        <th style="width: auto"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            <p>ระบบจัดการปริญญานิพนธ์</p>
                            <small>Thesis Management System</small>
                        </td>
                        <td>
                            <p>นายณัฐภูมิ ขำศรี</p>
                            <p>นักศึกษา 2</p>
                            <p>นักศึกษา 3</p>
                        </td>
                        <td>
                            อาจารย์ 1
                        </td>
                        <td>กำลังดำเนินการอนุมัติ 01</td>
                        <td class="text-right">
                            <a class="btn btn-primary btn-sm" href="#">รายละเอียด</a>
                            <a class="btn btn-success btn-sm" href="#">อนุมัติหัวข้อ</a>
                            <a class="btn btn-danger btn-sm" href="#">ยกเลิกหัวข้อ</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- รายละเอียดโปรเจค --}}
    <div class="card">
        <div class="container">
            <h3>รายละเอียดโปรเจค</h3>
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
                        <th>ชื่อโปรเจค</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            <p>ระบบจัดการปริญญานิพนธ์</p>
                            <small>Thesis Management System</small>
                        </td>
                    </tr>
                    <tr>
                        <th>ชื่อนักศึกษา</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            <p>นายณัฐภูมิ ขำศรี</p>
                            <p>นักศึกษา 2</p>
                            <p>นักศึกษา 3</p>
                        </td>
                    </tr>
                    <tr>
                        <th>ชื่ออาจารย์ที่ปรึกษาหลัก</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            อาจารย์ 1
                        </td>
                    </tr>
                    <tr>
                        <th>ชื่ออาจารย์ที่ปรึกษาร่วม</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            <p>อาจารย์ 2</p>
                            <p>อาจารย์ 3</p>
                            <p>อาจารย์ 4</p>
                        </td>
                    </tr>
                    <tr>
                        <th>สถานะการดำเนินงาน</th>
                        <td>
                            <a href="#"><i class='bx bx-edit'></i></a>
                            กำลังดำเนินการอนุมัติ 01
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>