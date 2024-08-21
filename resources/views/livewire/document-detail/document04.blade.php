<div>
    @if (Auth::guard('teachers')->user()->user_type == 'Admin')
        <form wire:submit="Admin_approve">
            <label for="" class="form-label">ความเห็นของอาจารย์ผู้รับผิดชอบรายวิชา</label>
            <div class="col">
                <input type="checkbox" wire:model="admin_approve" name="" id=""><label>เห็นชอบ</label>
                <input type="checkbox" wire:model="admin_approve_fix" name="" id=""><label>เห็นชอบให้มีการแก้ไขเพิ่มเติม</label>
            </div>
            <div class="col">
                <textarea class="form-control" wire:model="admin_comment_fix" name="" id="" cols="30" rows="5"></textarea>
            </div>
            <div>
                <button class="btn btn-primary" type="submit">ยืนยัน</button>
            </div>
        </form>
    @elseif (Auth::guard('teachers')->user()->user_type == 'Branch head')
    <form wire:submit.prevent="Brance_head_approve" action="">
        <label for="" class="form-label">ความเห็นของหัวหน้าสาขา</label>
        <div class="col">
            <input type="checkbox" wire:model="branch_head_approve" name="" id=""><label>เห็นชอบ</label>
            <input type="checkbox" wire:model="branch_head_approve_fix" name="" id=""><label>เห็นชอบให้มีการแก้ไขเพิ่มเติม</label>
        </div>
        <div class="col">
            <textarea class="form-control" wire:model="branch_head_comment_fix" name="" id="" cols="30" rows="5"></textarea>
        </div>
        <div>
            <button class="btn btn-primary" type="submit">ยืนยัน</button>
        </div>
    </form>
    @endif
    
</div>
