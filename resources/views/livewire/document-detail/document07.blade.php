<div>
    <section id="document-detail-07">
        <div class="card">
            <div class="card-body">
                @if (Auth::guard('teachers')->user()->user_type == 'Admin')
                    <form wire:submit="admin_comment">
                        <legend>ความเห็นของอาจารย์ประจำวิชา</legend>
                        <div x-data="{ admin_approve_fix: false, admin_approve: false }">
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @elseif (session()->has('comment success'))
                                <div class="alert alert-success">
                                    {{ session('comment success') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <input wire:model="admin_approve" type="checkbox" id="admin_approve"
                                        x-model="admin_approve" x-bind:disabled="admin_approve_fix">
                                    <label for="admin_approve">อนุมัติ</label>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <input wire:model="admin_approve_fix" type="checkbox" id="admin_approve_fix"
                                        x-model="admin_approve_fix" x-bind:disabled="admin_approve">
                                    <label for="admin_approve_fix">ให้แก้ไขอีกครั้ง</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div x-show="admin_approve_fix">
                                        <label for="">เนื่องจาก</label>
                                        <textarea class="form-control" wire:model="admin_approve_fix_comment" id="admin_approve_fix_comment"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success m-3" type="submit">บันทึกความเห็น</button>
                        </div>
                    </form>
                @elseif (Auth::guard('teachers')->user()->user_type == 'Branch head')
                    <form wire:submit="branch_head_comment">
                        <legend>ความเห็นของหัวหน้าสาขา</legend>
                        <div x-data="{ branch_head_approve_fix: false, branch_head_approve: false }">
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @elseif (session()->has('comment success'))
                                <div class="alert alert-success">
                                    {{ session('comment success') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <input wire:model="branch_head_approve" type="checkbox" id="branch_head_approve"
                                        x-model="branch_head_approve" x-bind:disabled="branch_head_approve_fix">
                                    <label for="branch-head_approve">อนุมัติ</label>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <input wire:model="branch_head_approve_fix" type="checkbox"
                                        id="branch_head_approve_fix" x-model="branch_head_approve_fix"
                                        x-bind:disabled="branch_head_approve">
                                    <label for="branch-head_approve_fix">ให้แก้ไขอีกครั้ง</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div x-show="branch_head_approve_fix">
                                        <label for="">เนื่องจาก</label>
                                        <textarea class="form-control" wire:model="branch_head_approve_fix_comment" id="branch-head_approve_fix_comment"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success m-3" type="submit">บันทึกความเห็น</button>
                        </div>
                    </form>
                @endif
                </fieldset>
            </div>
        </div>
    </section>
</div>
