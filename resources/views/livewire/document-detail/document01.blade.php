<div>
    @foreach ($projects as $projectItems)
        <div class="card">
            <div class="card-body">
                <div class="card-title">{{ $projectItems->confirmTeachers->first()->document->document }} -
                    {{ $projectItems->project_name_th }} {{ $projectItems->project_name_en }}</div>
                <div class="card-text">
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item"><strong>สมาชิก</strong></li>
                        @foreach ($projectItems->confirmStudents as $confirmStudent)
                            <li class="list-group-item">{{ $confirmStudent->student->name }}
                                {{ $confirmStudent->student->surname }}</li>
                        @endforeach
                    </ul>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item"><strong>ที่ปรึกษาหลัก</strong></li>
                        @foreach ($projectItems->confirmTeachers->where('id_position', 1) as $mainTeacher)
                            <li class="list-group-item">{{ $mainTeacher->teacher->name }}
                                {{ $mainTeacher->teacher->surname }}</li>
                        @endforeach
                    </ul>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item"><strong>ที่ปรึกษาร่วม</strong></li>
                        @foreach ($projectItems->confirmTeachers->where('id_position', 2) as $subTeacher)
                            <li class="list-group-item">{{ $subTeacher->teacher->name }}
                                {{ $subTeacher->teacher->surname }}</li>
                        @endforeach
                    </ul>
                    <form wire:submit.prevent="approve">
                        <label class="form-label" for="">ความเห็นของอาจารย์ประจำวิชา</label>
                        <div x-data="{ showComment: false , approve: false , not_approve: false }">
                            <div class="row">
                                <div class="col-3">
                                    <input type="checkbox" wire:model="approve_project_name" value="อนุมัติชื่อเรื่อง" x-bind:disabled="approve" x-model="not_approve">
                                    <label for="">อนุมัติชื่อเรื่อง</label>
                                </div>
                                <div class="col-3">
                                    <input type="checkbox" wire:model="approve_teacher" value="อนุมัติอาจารย์ที่ปรึกษา" x-bind:disabled="approve"x-model="not_approve">
                                    <label for="">อนุมัติอาจารย์ที่ปรึกษา</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <input type="checkbox" wire:model="not_approve" value="ไม่อนุมัติ เนื่องจาก" x-bind:disabled="not_approve" x-model="approve" >
                                    <label for="">ไม่อนุมัติ เนื่องจาก</label>
                                </div>
                                <div class="col-5">
                                    <input type="checkbox" wire:model="not_enough_Qualifications"
                                        value="มีวุฒิการศึกษาไม่เป็นไปตามเกณฑ์" x-bind:disabled="not_approve">
                                    <label for="">มีวุฒิการศึกษาไม่เป็นไปตามเกณฑ์</label><br>
                                    <input type="checkbox" wire:model="out_of_student"
                                        value="มีจำนวนนักศึกษาที่รับผิดชอบเกินเกณฑ์" x-bind:disabled="not_approve">
                                    <label for="">มีจำนวนนักศึกษาที่รับผิดชอบเกินเกณฑ์</label><br>
                                    <input type="checkbox" wire:model="other_comment" x-model="showComment" x-bind:disabled="not_approve">
                                    <label for="">อื่นๆ</label>
                                </div>
                            </div>
                            <div class="row mb-3" id="commentSection" x-show="showComment">
                                <div class="col-12">
                                    <label for="message-text" class="col-form-label">หมายเหตุ:</label>
                                    <textarea class="form-control" wire:model="comment" id="message-text"></textarea>
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
                </div>

            </div>
        </div>
    @endforeach
</div>
