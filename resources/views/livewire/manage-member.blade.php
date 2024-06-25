<div>
    {{-- จัดการบัญชี --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">จัดการบัญชีสมาชิก</h3>
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
                        <th style="width: auto">รหัสนักศึกษา</th>
                        <th style="width: auto">ชื่อ</th>
                        <th style="width: auto">หลักสูตร</th>
                        <th style="width: auto">ระดับ</th>
                        <th style="width: auto">ภาค</th>
                        <th style="width: auto">สถานะบัญชี</th>
                        <th style="width: auto"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $data as $studentItems )
                    <tr>
                        <td>64222110108-4</td>
                        <td>{{$studentItems->name}}</td>
                        <td>หลักสูตรวิทยาศาสตรบัณฑิต</td>
                        <td>ป.ตรี 4 ปี</td>
                        <td>ปกติ</td>
                        <td>ยังใช้งานบัญชี</td>
                        <td class="text-right">
                            <a class="btn btn-primary btn-sm" href="#">รายละเอียด</a>
                            <a class="btn btn-secondary btn-sm" href="#">แก้ไขบัญชี</a>
                            <a class="btn btn-success btn-sm" href="#">อนุมัติบัญชี</a>
                            <a class="btn btn-danger btn-sm" href="#">ยกเลิกบัญชี</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>

    {{-- รายละเอียดบัญชี --}}
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">รายละเอียดบัญชีสมาชิก</h3>
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
                            <th>รูปภาพนักศึกษา</th>
                            <td><i class='bx bx-user'></i></td>
                        </tr>
                        <tr>
                            <th>รหัสนักศึกษา</th>
                            <td>64222110108-4</td>
                        </tr>
                        <tr>
                            <th>ชื่อ</th>
                            <td>นายณัฐภูมิ ขำศรี</td>
                        </tr>
                        <tr>
                            <th>หลักสูตร</th>
                            <td>หลักสูตรวิทยาศาสตรบัณฑิต</td>
                        </tr>
                        <tr>
                            <th>ระดับ</th>
                            <td>ป.ตรี 4 ปี</td>
                        </tr>
                        <tr>
                            <th>ภาค</th>
                            <td>ปกติ</td>
                        </tr>
                        <tr>
                            <th>เบอร์โทรศัพท์</th>
                            <td>0982392113</td>
                        </tr>
                        <tr>
                            <th>อีเมล</th>
                            <td>nattapum.kh@rmuti.ac.th</td>
                        </tr>
                        <tr>
                            <th>ไอดีไลน์</th>
                            <td>line_nattapum</td>
                        </tr>
                        <tr>
                            <th>สถานะบัญชี</th>
                            <td>ยังใช้งานบัญชี</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- แก้ไขบัญชี --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">แก้ไขบัญชีสมาชิก</h3>
        </div>
        <div class="card-body">
            <form action="#">
                <div class="personal-details">
                    <span class="title">ข้อมูลส่วนบุคล</span>
                    <div class="fields">
                        <div class="input-field">
                            <label class="form-label">คำนำหน้าชื่อ</label>
                            <select class="form-select" required>
                                <option selected>กรุณาเลือกคำนำหน้าชื่อ</option>
                                <option value="mr">นาย</option>
                                <option value="mrs">นาง</option>
                                <option value="miss">นางสาว</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label class="form-label">ชื่อ</label>
                            <input class="form-input" type="text" placeholder="กรุณากรอกชื่อ" required>
                        </div>
                        <div class="input-field">
                            <label class="form-label">นามสกุล</label>
                            <input class="form-input" type="text" placeholder="กรุณากรอกนามสกุล" required>
                        </div>
                        <div class="input-field">
                            <label class="form-label">รูปภาพนักศึกษา</label>
                            <input class="form-input" type="file" placeholder="เลือกไฟล์" required>
                        </div>
                    </div>
                </div>
                <div class="member-details">
                    <span class="title">ข้อมูลส่วนนักศึกษา</span>
                    <div class="fields">
                        <div class="input-field">
                            <label class="form-label">รหัสนักศึกษา</label>
                            <input class="form-input" type="text" placeholder="กรุณากรอกรหัสนักศึกษา" required>
                        </div>
                        <div class="input-field">
                            <label class="form-label">หลักสูตร</label>
                            <select class="form-select" required>
                                <option selected>กรุณาเลือกหลักสูตร</option>
                                <option value="hvcp">หลักสูตรประกาศนียบัตรวิชาชีพชั้นสูง</option>
                                <option value="blep">หลักสูตรครุศาสตร์อุตสาหกรรมบัณฑิต</option>
                                <option value="bsp">หลักสูตรวิทยาศาสตรบัณฑิต</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label class="form-label">ระดับ</label>
                            <select class="form-select" required>
                                <option selected>กรุณาเลือกระดับ</option>
                                <option value="b4">ปริญญาตรี 4 ปี</option>
                                <option value="hvc2">ปวส. 2 ปี</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label class="form-label">ภาค</label>
                            <select class="form-select" required>
                                <option selected>กรุณาเลือกภาค</option>
                                <option value="re">ภาคปกติ</option>
                                <option value="ae">ภาคสมทบ</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="contact-details">
                    <span class="title">ข้อมูลการติดต่อ</span>
                    <div class="fields">
                        <div class="input-field">
                            <label class="form-label">อีเมล(อีเมลมหาลัย)</label>
                            <input class="form-input" type="email" placeholder="กรุณากรอกอีเมล" required>
                        </div>
                        <div class="input-field">
                            <label class="form-label">เบอร์โทร</label>
                            <input class="form-input" type="tel" placeholder="กรุณากรอกเบอร์โทร" maxlength="10"
                                minlength="10" required>
                        </div>
                        <div class="input-field">
                            <label class="form-label">ไอดีไลน์</label>
                            <input class="form-input" type="text" placeholder="กรุณากรอกไอดีไลน์" required>
                        </div>
                    </div>
                </div>
                <div class="user-details">
                    <span class="title">ข้อมูลผู้ใช้</span>
                    <div class="fields">
                        <div class="input-field">
                            <label class="form-label">รหัสผ่าน</label>
                            <input class="form-input" type="password" placeholder="กรุณากรอกรหัสผ่าน" minlength="8"
                                required>
                        </div>
                        <div class="input-field">
                            <label class="form-label">ยืนยันรหัสผ่าน</label>
                            <input class="form-input" type="password" placeholder="กรุณากรอกรหัสผ่านอีกครั้ง"
                                minlength="8" required>
                        </div>
                    </div>
                </div>
                <div class="btn">
                    <button type="button" class="btn btn-success">บันทึก</button>
                    <button type="button" class="btn btn-danger">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>