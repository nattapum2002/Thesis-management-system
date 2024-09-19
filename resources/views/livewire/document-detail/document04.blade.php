{{-- <div>
    @if (Auth::guard('teachers')->user()->user_type == 'Admin')
        <form wire:submit="Admin_approve">
            <label for="" class="form-label">ความเห็นของอาจารย์ผู้รับผิดชอบรายวิชา</label>
            <div class="col">
                <input type="checkbox" wire:model="admin_approve" name="" id=""><label>เห็นชอบ</label>
                <input type="checkbox" wire:model="admin_approve_fix" name=""
                    id=""><label>เห็นชอบให้มีการแก้ไขเพิ่มเติม</label>
            </div>
            <div class="col">
                <textarea class="form-control" wire:model="admin_comment_fix" name="" id="" cols="30"
                    rows="5"></textarea>
            </div>
            <div>
                <button class="btn btn-primary" type="submit">ยืนยัน</button>
            </div>
        </form>
    @elseif (Auth::guard('teachers')->user()->user_type == 'Branch head')
        <form wire:submit.prevent="Brance_head_approve" action="">
            <label for="" class="form-label">ความเห็นของหัวหน้าสาขา</label>
            <div class="col">
                <input type="checkbox" wire:model="branch_head_approve" name=""
                    id=""><label>เห็นชอบ</label>
                <input type="checkbox" wire:model="branch_head_approve_fix" name=""
                    id=""><label>เห็นชอบให้มีการแก้ไขเพิ่มเติม</label>
            </div>
            <div class="col">
                <textarea class="form-control" wire:model="branch_head_comment_fix" name="" id="" cols="30"
                    rows="5"></textarea>
            </div>
            <div>
                <button class="btn btn-primary" type="submit">ยืนยัน</button>
            </div>
        </form>
    @endif

</div> --}}
<div>
    <section id="document-detail-04">
        <div class="card">
            <div class="card-body">
                @if (Auth::guard('teachers')->user()->user_type == 'Admin')
                    <form wire:submit="Admin_approve">
                        <div x-data="{ approve_fix: false, approve: false }">
                            <fieldset>
                                <legend>ความเห็นของอาจารย์ผู้รับผิดชอบรายวิชา</legend>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <ul>
                                            <li>
                                                <input type="checkbox" wire:model="admin_approve" name="approve"
                                                    id="approve" x-model="approve"
                                                    x-bind:disabled="approve_fix"><label>เห็นชอบ</label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <ul>
                                            <li>
                                                <input type="checkbox" wire:model="admin_approve_fix" name="approve_fix"
                                                    id="approve_fix" x-model="approve_fix"
                                                    x-bind:disabled="approve"><label>เห็นชอบให้มีการแก้ไขเพิ่มเติม</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div x-show="approve_fix">
                                            <textarea class="form-control" wire:model="admin_comment_fix" name="" id="" cols="30"
                                                rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <button class="btn btn-success" type="submit">ยืนยัน</button>
                            </fieldset>
                        </div>
                    </form>
                @elseif (Auth::guard('teachers')->user()->user_type == 'Branch head')
                    <form wire:submit.prevent="Brance_head_approve" action="">
                        <div x-data="{ approve_fix: false, approve: false }">
                            <fieldset>
                                <legend>ความเห็นของหัวหน้าสาขา</legend>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <ul>
                                            <li>
                                                <input type="checkbox" wire:model="branch_head_approve" name="approve"
                                                    id="approve" x-model="approve"
                                                    x-bind:disabled="approve_fix"><label>เห็นชอบ</label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-5 col-md-6 col-sm-12">
                                        <ul>
                                            <li>
                                                <input type="checkbox" wire:model="branch_head_approve_fix"
                                                    name="approve_fix" id="approve_fix" x-model="approve_fix"
                                                    x-bind:disabled="approve"><label>เห็นชอบให้มีการแก้ไขเพิ่มเติม</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div x-show="approve_fix">
                                            <textarea class="form-control" wire:model="branch_head_comment_fix" name="" id="" cols="30"
                                                rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <button class="btn btn-success" type="submit">ยืนยัน</button>
                            </fieldset>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </section>
</div>
