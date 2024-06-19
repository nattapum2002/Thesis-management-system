<div>
    <div class="card">
        <div class="card-header">
            <h4 class="title text-primary">ชื่อเรื่องโครงงานปริญญานิพนธ์</h4>
        </div>
        <div class="card-body">
            <form>
                <div class="project-name">
                    <div class="fields">
                        <div class="input-fields">
                            <label class="form-label">ภาษาไทย</label>
                            <input wire:model="projectNameThai" class="form-input" type="text"
                                placeholder="กรุณากรอกชื่อโครงงาน" required>
                        </div>
                        <div class="input-fields">
                            <label class="form-label">ภาษาอังกฤษ</label>
                            <input wire:model="projectNameEnglish" class="form-input" type="text"
                                placeholder="กรุณากรอกชื่อโครงงาน" required>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
