<div>
    @if (session()->has('message'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
    @endif
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                    class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form wire:submit.prevent="login" class="border rounded-3 p-3">
                        <h3 class="card-header">เข้าสู่ระบบสำหรับนักศึกษา</h3>

                        <div class="divider d-flex align-items-center my-4">

                        </div>

                        <!-- Username input -->
                        <div class="mb-3">
                            <label for="username" class="form-label">ชื่อผู้ใช้</label>
                            <input type="text" wire:model="username" id="username" class="form-control">
                            @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Password input -->
                        <div class="mb-3">
                            <label for="password" class="form-label">รหัสผ่าน</label>
                            <input type="password" wire:model="password" id="password" class="form-control">
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-3">
                                <input type="checkbox" wire:model="remember" id="remember" class="form-check-input">
                                <label for="remember" class="form-check-label">จดจำฉัน</label>
                            </div>
                            <a href="#!" class="text-body">ลืมรหัสผ่าน?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">ยังไม่มีบัญชี? <a href="/register"
                            class="link-danger">สมัครสมาชิก</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
