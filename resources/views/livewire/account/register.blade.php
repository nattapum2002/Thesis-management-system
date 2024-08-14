{{-- <div>
    <!-- alert -->
    @if (session()->has('message'))
        <div class="row justify-content-center">
            <div class="col-sm-5 alert alert-primary d-flex justify-content-between align-items-center"
                role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <!-- alert -->
    <div class="container ">
        <form class="border rounded-3 p-2" wire:submit="register" action="">
            <div class="head m-3">
                <h3>
                    <p>สมัครสมาชิก</p>
                </h3>
            </div>
            <div class="row mb-4">
                <div class="col-sm-4">
                    <div class="input-group">
                        <!-- <label for="prefix" class="input-group-text">คำนำหน้าชื่อ</label> -->
                        <select class="form-select" wire:model.live="prefix" id="prefix">
                            <option selected>คำนำหน้าชื่อ</option>
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                            <option value="นางสาว">นางสาว</option>
                            <option value="อื่นๆ">อื่นๆ</option>
                        </select>
                        @if ($this->prefix == 'อื่นๆ')
                        <input class="form-control" wire:model="other_prefix" type="text" placeholder="คำนำหน้าชื่อ"
                            required>
                        @endif
                    </div>
                    @error('prefix')
                    <p class="text-danger text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <label for="name" class="input-group-text">ชื่อ</label>
                        <input class="form-control" type="text" wire:model="name" id="name" placeholder="กรุณากรอกชื่อ">
                    </div>
                    @error('name')
                    <p class="text-danger text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <label for="surname" class="input-group-text">นามสกุล</label>
                        <input class="form-control" type="text" wire:model="surname" id="surname" placeholder="นามสกุล">
                    </div>
                    @error('surname')
                    <p class="text-danger text-center">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-4">
                    <div class="input-group">
                        <label class="input-group-text" for="course">หลักสูตร</label>
                        <select class="form-select" wire:model.live="id_course">
                            <option selected>กรุณาเลือกหลักสูตร</option>
                            <option value="1">หลักสูตรประกาศนียบัตรวิชาชีพชั้นสูง</option>
                            <option value="2">หลักสูตรครุศาสตร์อุตสาหกรรมบัณฑิต</option>
                            <option value="3">หลักสูตรวิทยาศาสตรบัณฑิต</option>
                        </select>
                    </div>
                    @error('id_course')
                    <p class="text-danger text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <label class="input-group-text" for="level">ระดับ</label>
                        @if ($this->id_course == 1)
                        <select class="form-select" wire:model.live="id_level" id="level">
                            <option selected>เลือกระดับ</option>
                            <option value="1">ปวส.</option>
                        </select>
                        @elseif ($this->id_course == 2 || $this->id_course == 3)
                        <select class="form-select" wire:model.live="id_level" id="level">
                            <option selected>เลือกระดับ</option>
                            <option value="2">ปริญญาตรี 4 ปี</option>
                            <option value="3">เทียบโอน</option>
                        </select>
                        @else
                        <select class="form-select" wire:model.live="id_level" id="level" disabled>
                            <option selected>กรุณาเลือกหลักสูตรก่อน</option>
                        </select>
                        @endif
                    </div>
                    @error('id_level')
                    <p class="text-danger text-center">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-4">
                    <div class="input-group">
                        <label class="input-group-text" for="id_student">รหัสนักศึกษา</label>
                        <input class="col form-control" type="text" wire:model="id_student" id="id_student"
                            placeholder="*ไม่จำเป็นต้องใส่ขีด" maxlength="12">
                    </div>
                    @error('id_student')
                    <p class="text-danger text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <label class="input-group-text" for="tel">เบอร์โทรศัพท์</label>
                        <input class="col form-control" type="tel" wire:model="tel" id="tel" placeholder="เบอร์โทรศัพท์"
                            maxlength="10">
                    </div>
                    @error('tel')
                    <p class="text-danger text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <label class="input-group-text" for="id_line">ID Line</label>
                        <input class="form-control" type="text" wire:model="id_line" id="id_line" placeholder="ID Line">
                    </div>
                    @error('id_line')
                    <p class="text-danger text-center">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-4">
                    <div class="input-group">
                        <label class="input-group-text" for="email">E-mail </label>
                        <input class="form-control" type="text" wire:model="email" id="email"
                            placeholder="*อีเมลมหาลัย">
                    </div>
                    @error('email')
                    <p class="text-danger text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <label class="input-group-text" for="username">ชื่อผู้ใช้</label>
                        <input class="form-control" type="text" wire:model="username" id="username"
                            placeholder="Username" aria-describedby="required_username">
                    </div>
                </div>
                @error('username')
                <span class="text-danger text-center" id="required_username">{{ $message }}</span>
                @enderror
                <div class="col-sm-4">
                    <div class="input-group">
                        <label class="input-group-text" for="password">รหัสผ่าน</label>
                        <input class="form-control" type="password" wire:model="password" id="password"
                            placeholder="password" aria-describedby="required_password">
                    </div>
                </div>
                @error('password')
                <span class="text-danger text-center" id="required_password">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <button class="btn btn-success" type="submit">ยืนยัน</button>
                <button class="btn btn-danger" type="reset">ยกเลิก</button>
            </div>
        </form>
    </div>
</div> --}}

<div>
    <section id="register">
        <div class="container">
            <div class="row justify-content-center">
                <form wire:submit="register" action="">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <h3>สมัครสมาชิก</h3>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <label for="prefix" class="input-group-text">คำนำหน้าชื่อ</label>
                                <select class="form-select" wire:model.live="prefix" id="prefix">
                                    <option selected>คำนำหน้าชื่อ</option>
                                    <option value="นาย">นาย</option>
                                    <option value="นาง">นาง</option>
                                    <option value="นางสาว">นางสาว</option>
                                    <option value="อื่นๆ">อื่นๆ</option>
                                </select>
                                @if ($this->prefix == 'อื่นๆ')
                                    <input class="form-control" wire:model="other_prefix" type="text"
                                        placeholder="คำนำหน้าชื่อ" required>
                                @endif
                            </div>
                            @error('prefix')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <label for="name" class="input-group-text">ชื่อ</label>
                                <input class="form-control" type="text" wire:model="name" id="name"
                                    placeholder="กรุณากรอกชื่อ">
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <label for="surname" class="input-group-text">นามสกุล</label>
                                <input class="form-control" type="text" wire:model="surname" id="surname"
                                    placeholder="นามสกุล">
                            </div>
                            @error('surname')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <label class="input-group-text" for="course">หลักสูตร</label>
                                <select class="form-select" wire:model.live="id_course">
                                    <option selected>กรุณาเลือกหลักสูตร</option>
                                    <option value="1">หลักสูตรประกาศนียบัตรวิชาชีพชั้นสูง</option>
                                    <option value="2">หลักสูตรครุศาสตร์อุตสาหกรรมบัณฑิต</option>
                                    <option value="3">หลักสูตรวิทยาศาสตรบัณฑิต</option>
                                </select>
                            </div>
                            @error('id_course')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <label class="input-group-text" for="level">ระดับ</label>
                                @if ($this->id_course == 1)
                                    <select class="form-select" wire:model.live="id_level" id="level">
                                        <option selected>เลือกระดับ</option>
                                        <option value="1">ปวส.</option>
                                    </select>
                                @elseif ($this->id_course == 2 || $this->id_course == 3)
                                    <select class="form-select" wire:model.live="id_level" id="level">
                                        <option selected>เลือกระดับ</option>
                                        <option value="2">ปริญญาตรี 4 ปี</option>
                                        <option value="3">เทียบโอน</option>
                                    </select>
                                @else
                                    <select class="form-select" wire:model.live="id_level" id="level" disabled>
                                        <option selected>กรุณาเลือกหลักสูตรก่อน</option>
                                    </select>
                                @endif
                            </div>
                            @error('id_level')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <label class="input-group-text" for="id_student">รหัสนักศึกษา</label>
                                <input class="col form-control" type="text" wire:model="id_student" id="id_student"
                                    placeholder="*ไม่จำเป็นต้องใส่ขีด" maxlength="12">
                            </div>
                            @error('id_student')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <label class="input-group-text" for="tel">เบอร์โทรศัพท์</label>
                                <input class="col form-control" type="tel" wire:model="tel" id="tel"
                                    placeholder="เบอร์โทรศัพท์" maxlength="10">
                            </div>
                            @error('tel')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <label class="input-group-text" for="id_line">ID Line</label>
                                <input class="form-control" type="text" wire:model="id_line" id="id_line"
                                    placeholder="ID Line">
                            </div>
                            @error('id_line')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <label class="input-group-text" for="email">E-mail </label>
                                <input class="form-control" type="text" wire:model="email" id="email"
                                    placeholder="*อีเมลมหาลัย">
                            </div>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <label class="input-group-text" for="username">ชื่อผู้ใช้</label>
                                <input class="form-control" type="text" wire:model="username" id="username"
                                    placeholder="ชื่อผู้ใช้" aria-describedby="required_username">
                            </div>
                            @error('username')
                                <span class="text-danger" id="required_username">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <label class="input-group-text" for="password">รหัสผ่าน</label>
                                <input class="form-control" type="password" wire:model="password" id="password"
                                    placeholder="รหัสผ่าน" aria-describedby="required_password">
                            </div>
                            @error('password')
                                <span class="text-danger" id="required_password">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <label class="input-group-text" for="password">ยืนยันรหัสผ่าน</label>
                                <input class="form-control" type="password" wire:model="password_confirmation"
                                    id="password_confirmation" placeholder="ยืนยันรหัสผ่าน"
                                    aria-describedby="password_confirmation">
                            </div>
                            @error('password_confirmation')
                                <span class="text-danger" id="password_confirmation">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 text-center">
                            <button class="btn btn-success" type="submit">ยืนยัน</button>
                            <button class="btn btn-danger" type="reset"
                                onclick="window.location.href='{{ route('login_member') }}'">ยกเลิก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
