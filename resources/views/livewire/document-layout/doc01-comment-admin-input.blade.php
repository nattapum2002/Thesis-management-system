<div>
    <div class="card">
        <div class="card-header">
            <h4 class="title ">ความคิดเห็น</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="submitForm">
                <div class="input-fields">
                    <span class="title text-primary">การอนุมัติหัวข้อ</span>
                    <div class="input-field">
                        <input type="checkbox" wire:model="approvalTopic" id="topic-approval" value="topic-approval"
                            checked>
                        <label>อนุมัติหัวข้อ</label>
                    </div>
                    <span class="title text-primary">การอนุมัติอาจารย์ที่ปรึกษา</span>
                    <div class="input-field">
                        <input type="radio" wire:model="advisorApproval" id="advisor-approval" value="approve">
                        <label>อนุมัติอาจารย์ที่ปรึกษา</label>
                        <input type="radio" wire:model="advisorApproval" id="advisor-reject" value="reject">
                        <label>ไม่อนุมัติอาจารย์ที่ปรึกษา</label>
                    </div>
                    <div id="reject-field">
                        <b>เหตุผลการไม่อนุมัติ : </b>
                        <div class="input-field">
                            <input type="checkbox" id="reject-1" value="reject-1">
                            <label>มีคุณวุฒิทางการศึกษาไม่เป็นไปตามเกณฑ์</label>
                        </div>
                        <div class="input-field">
                            <input type="checkbox" id="reject-2" value="reject-2">
                            <label>มีจำนวนนักศึกษาที่รับผิดชอบเกินเกณฑ์ที่กำหนดไว้</label>
                        </div>
                        <div class="input-field">
                            <input type="checkbox" id="reject-other" value="reject-other">
                            <label>อื่นๆ </label>
                            <input class="form-control" type="text" wire:model.defer="rejectReason"
                                placeholder="กรุณากรอกข้อมูล">
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="button" class="btn btn-danger">ยกเลิก</button>
                    <button type="submit" class="btn btn-success">ยืนยันเอกสาร</button>
                </div>
            </form>
        </div>
    </div>
</div>
