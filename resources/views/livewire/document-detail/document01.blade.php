{{-- <div>
    @if (Auth::guard('teachers')->user()->user_type == 'Admin')
        <form wire:submit="approve">
            <label class="form-label" for="">ความเห็นของอาจารย์ประจำวิชา</label>
            <div x-data="{ showComment: false, approve: false, not_approve: false }">
                <div class="row">
                    <div class="col-3">
                        <input type="checkbox" wire:model="approve_project_name" value="อนุมัติชื่อเรื่อง"
                            x-bind:disabled="approve" x-model="not_approve">
                        <label for="">อนุมัติชื่อเรื่อง</label>
                    </div>
                    <div class="col-3">
                        <input type="checkbox" wire:model="approve_teacher" value="อนุมัติอาจารย์ที่ปรึกษา"
                            x-bind:disabled="approve">
                        <label for="">อนุมัติอาจารย์ที่ปรึกษา</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <input type="checkbox" wire:model="admin_not_approve" value="ไม่อนุมัติ เนื่องจาก"
                            x-bind:disabled="not_approve" x-model="approve">
                        <label for="">ไม่อนุมัติ เนื่องจาก</label>
                    </div>
                    <div class="col-5">
                        <input type="checkbox" wire:model="not_enough_Qualifications"
                            value="มีวุฒิการศึกษาไม่เป็นไปตามเกณฑ์" x-bind:disabled="not_approve">
                        <label for="">มีวุฒิการศึกษาไม่เป็นไปตามเกณฑ์</label><br>
                        <input type="checkbox" wire:model="out_of_student" value="มีจำนวนนักศึกษาที่รับผิดชอบเกินเกณฑ์"
                            x-bind:disabled="not_approve">
                        <label for="">มีจำนวนนักศึกษาที่รับผิดชอบเกินเกณฑ์</label><br>
                        <input type="checkbox" wire:model="admin_other_comment" x-model="showComment"
                            x-bind:disabled="not_approve">
                        <label for="">อื่นๆ</label>
                    </div>
                </div>
                <div class="row mb-3" id="commentSection" x-show="showComment">
                    <div class="col-12">
                        <label for="message-text" class="col-form-label">หมายเหตุ:</label>
                        <textarea class="form-control" wire:model="admin_comment" id="message-text"></textarea>
                    </div>
                </div>
            </div>
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <button type="submit" class="btn btn-success">ยืนยัน</button>
        </form>
    @elseif (Auth::guard('teachers')->user()->user_type == 'Branch head')
        <form wire:submit.prevent="Brance_head_approve">
            <div x-data="{ showComment: false, approve: false, not_approve: false }">
                <label class="form-label" for="">ความเห็นของหัวหน้าสาขาวิชา</label>
                <div class="row">
                    <div class="col">
                        <input type="checkbox" wire:model="branch_head_approve" value="อนุมัติ" x-model="not_approve"
                            x-bind:disabled="approve">
                        <label for="">อนุมัติ</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <input type="checkbox" wire:model="branch_head_not_approve" x-model="approve" value="ไม่อนุมัติ"
                            x-bind:disabled="not_approve">
                        <label for="">ไม่อนุมัติ</label>
                    </div>
                    <div x-show="approve">
                        <label for="">หมายเหตุ:</label>
                        <textarea class="form-control" wire:model="branch_head_comment" id="message-text"></textarea>
                    </div>

                </div>
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <button class="btn btn-primary" type="submit">ยืนยัน</button>
            </div>

        </form>
    @endif
</div> --}}

<div>
    <section id="document-detail-01">
        <div class="card">
            <div class="card-body">
                @if (Auth::guard('teachers')->user()->user_type == 'Admin')
                    <form wire:submit="approve">
                        <div x-data="{ showComment: false, approve: false, not_approve: false }">
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <fieldset>
                                <legend>ความเห็นของอาจารย์ประจำวิชา</legend>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <ul>
                                            <li>
                                                <input type="checkbox" wire:model="approve_project_name"
                                                    value="อนุมัติชื่อเรื่อง" x-bind:disabled="approve"
                                                    x-model="not_approve">
                                                <label for="">อนุมัติชื่อเรื่อง</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" wire:model="admin_not_approve"
                                                    value="ไม่อนุมัติ เนื่องจาก" x-bind:disabled="not_approve"
                                                    x-model="approve">
                                                <label for="">ไม่อนุมัติ เนื่องจาก</label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-5 col-md-6 col-sm-12">
                                        <ul>
                                            <li>
                                                <input type="checkbox" wire:model="approve_teacher"
                                                    value="อนุมัติอาจารย์ที่ปรึกษา" x-bind:disabled="approve">
                                                <label for="">อนุมัติอาจารย์ที่ปรึกษา</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" wire:model="not_enough_Qualifications"
                                                    value="มีวุฒิการศึกษาไม่เป็นไปตามเกณฑ์"
                                                    x-bind:disabled="not_approve">
                                                <label for="">มีวุฒิการศึกษาไม่เป็นไปตามเกณฑ์</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" wire:model="out_of_student"
                                                    value="มีจำนวนนักศึกษาที่รับผิดชอบเกินเกณฑ์"
                                                    x-bind:disabled="not_approve">
                                                <label for="">มีจำนวนนักศึกษาที่รับผิดชอบเกินเกณฑ์</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" wire:model="admin_other_comment"
                                                    x-model="showComment" x-bind:disabled="not_approve">
                                                <label for="">อื่นๆ</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row" id="commentSection" x-show="showComment">
                                    <div class="col-12">
                                        <label for="message-text" class="col-form-label">หมายเหตุ</label>
                                        <textarea class="form-control" wire:model="admin_comment" id="message-text"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">ยืนยัน</button>
                            </fieldset>
                        </div>
                    </form>
                @elseif (Auth::guard('teachers')->user()->user_type == 'Branch head')
                    <form wire:submit.prevent="Brance_head_approve">
                        <div x-data="{ showComment: false, approve: false, not_approve: false }">
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <fieldset>
                                <legend>ความเห็นของหัวหน้าสาขาวิชา</legend>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-6">
                                        <ul>
                                            <li>
                                                <input type="checkbox" wire:model="branch_head_approve" value="อนุมัติ"
                                                    x-model="not_approve" x-bind:disabled="approve">
                                                <label for="">อนุมัติ</label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-6">
                                        <ul>
                                            <li>
                                                <input type="checkbox" wire:model="branch_head_not_approve"
                                                    x-model="approve" value="ไม่อนุมัติ" x-bind:disabled="not_approve">
                                                <label for="">ไม่อนุมัติ</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div x-show="approve">
                                            <label for="">หมายเหตุ</label>
                                            <textarea class="form-control" wire:model="branch_head_comment" id="message-text"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit">ยืนยัน</button>
                            </fieldset>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </section>
</div>
