<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="container ">
        {{-- alert --}}
        @if (session()->has('message'))
        <div class="row justify-content-center">
            <div class="col-sm-5 alert alert-primary d-flex justify-content-between align-items-center" role="alert">
                {{session('message')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
        {{-- alert --}}
        <form class="border rounded-3 p-2" wire:submit="register" action="">
            <div class="head m-3">
                <h3>
                    <p>สมัครสมาชิก</p>
                </h3>
            </div>
            <div class="row input-group mb-3">
                <div class="col-sm-2">
                    <select class="form-select" wire:model="prefix" name="" id="">
                        <option selected value="">คำนำหน้า</option>
                        <option value="นาย">นาย</option>
                        <option value="นาง">นาง</option>
                        <option value="นางสาว">นางสาว</option>
                    </select>
                    <div class="form-text" id="">
                        @error('prefix')
                        <p class="text-danger text-center">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-4">
                    <input class="form-control" type="text" wire:model="name" name="" id="" placeholder="ชื่อ">
                    <div class="form-text" id="">
                        @error('name')
                        <p class="text-danger text-center">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-4">
                    <input class="form-control" type="text" wire:model="surname" name="" id="" placeholder="นามสกุล">
                    <div class="form-text" id="">
                        @error('surname')
                        <p class="text-danger text-center">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row input-group mb-3">
                <div class="col-sm-2">
                    <label class="form-label" for="">ภาควิชา</label>
                    <select class="form-select" wire:model="id_level" name="" id="">
                        <option selected value="">เลือก</option>
                        <option value="1">ป.ตรี 4 ปี(ปกติ)</option>
                        <option value="2">ป.ตรี 4 ปี(สมทบ)</option>
                        <option value="3">ปวส. 2 ปี(ปกติ)</option>
                        <option value="4">ปวส. 2 ปี(สมทบ)</option>
                    </select>
                    <div class="form-text" id="">
                        @error('id_level')
                        <p class="text-danger text-center">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-4">
                    <label class="form-label">หลักสูตร</label>
                    <select class="form-select" wire:model="id_course">
                        <option selected value="">กรุณาเลือกหลักสูตร</option>
                        <option value="1">หลักสูตรประกาศนียบัตรวิชาชีพชั้นสูง</option>
                        <option value="2">หลักสูตรครุศาสตร์อุตสาหกรรมบัณฑิต</option>
                        <option value="3">หลักสูตรวิทยาศาสตรบัณฑิต</option>
                    </select>
                    <div class="form-text" id="">
                        @error('id_course')
                        <p class="text-danger text-center">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row input-group mb-3">
                <div class="col-sm-2">
                    <label class="form-label" for="">รหัสนักศึกษา</label>
                    <input class="col form-control" type="text" wire:model="id_student" name="" id=""
                        placeholder="*ไม่จำเป็นต้องใส่ขีด" maxlength="12">
                    <div class="form-text" id="">
                        @error('id_student')
                        <p class="text-danger text-center">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <label class="form-label" for="">เบอร์โทรศัพท์</label>
                    <input class="col form-control" type="tel" wire:model="tel" name="" id="" placeholder=""
                        maxlength="10">
                    <div class="form-text" id="">
                        @error('tel')
                        <p class="text-danger text-center">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <label class="form-label" for="">ID Line</label>
                    <input class="form-control" type="text" wire:model="id_line" name="" id="" placeholder="">
                    <div class="form-text" id="">
                        @error('id_line')
                        <p class="text-danger text-center">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-4">
                    <label class="form-label" for="">E-mail <label class="text-danger"
                            for="">(อีเมลมหาลัย)</label></label>
                    <input class="form-control" type="text" wire:model="email" name="" id="" placeholder="e-mail">
                    <div class="form-text" id="">
                        @error('email')
                        <p class="text-danger text-center">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row input-group">
                <div class="col-sm-4">
                    <label class="form-label" for="">ชื่อผู้ใช้</label>
                    <input class="form-control" type="text" wire:model="username" name="" id="" placeholder="Username"
                        aria-describedby="required_username">
                </div>
                <div class="col-sm-4 form-text">
                    @error('username')
                    <span class="text-danger text-center" id="required_username">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row input-group mb-3">
                <div class="col-sm-4">
                    <label class="form-label" for="">รหัสผ่าน</label>
                    <input class="form-control" type="password" wire:model="password" name="" id=""
                        placeholder="password" aria-describedby="required_password">
                </div>
                <div class="col-sm-4 form-text" id="">
                    @error('password')
                    <span class="text-danger text-center" id="required_password">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div>
                <button class="btn btn-success" type="submit">ยืนยัน</button>
                <button class="btn btn-danger" type="reset">ยกเลิก</button>
            </div>
        </form>
    </div>
</div>