<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <form wire:submit.prevent="login" class="border rounded-3 p-3">
        <h3 class="mb-3">เข้าสู่ระบบสำหรับอาจารย์</h3>

        <div class="mb-3">
            <label for="username" class="form-label">ชื่อผู้ใช้</label>
            <input type="text" wire:model="username" id="username" class="form-control">
            @error('username') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">รหัสผ่าน</label>
            <input type="password" wire:model="password" id="password" class="form-control">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" wire:model="remember" id="remember" class="form-check-input">
            <label for="remember" class="form-check-label">จดจำฉัน</label>
        </div>

        <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
    </form>
</div>
