{{-- <div>
    <div class="score-table">
        <form wire:submit="score_calculate">
            <label class="form-label" for="">ผลการสอบโครงการ</label>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">หัวข้อพิจารณา</th>
                        <th scope="col">คะแนน</th>
                        @foreach ($projects as $ProjectItems)
                            @foreach ($ProjectItems->confirmStudents as $index => $Student)
                                <th scope="col">คนที่ {{ $index + 1 }}</th>
                            @endforeach
                        @endforeach

                    </tr>
                </thead>
                <tbody>
                    @foreach ($criterias as $key => $criterion)
                        <tr>
                            <th scope="row"></th>
                            <td>{!! $criterion['name'] !!}</td>
                            <td>{{ $criterion['score'] }}</td>

                            @if (!in_array($key + 1, [2, 7, 10]))
                                <!-- Skip rows 2, 6, 9 -->
                                @foreach ($projects as $ProjectItems)
                                    @foreach ($ProjectItems->confirmStudents as $index => $Student)
                                        <td>
                                            <input type="number"
                                                wire:model.live="score_student.{{ $Student->student->id_student }}.{{ $key }}"
                                                class="form-control" placeholder="" aria-label=""
                                                aria-describedby="basic-addon1">
                                        </td>
                                    @endforeach
                                @endforeach
                            @else
                                @foreach ($projects as $ProjectItems)
                                    @foreach ($ProjectItems->confirmStudents as $index => $Student)
                                        <td></td> <!-- Empty cell for skipped rows -->
                                    @endforeach
                                @endforeach
                            @endif
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">รวม</td>
                        <td></td>
                        @foreach ($this->score_student as $id_student => $scores)
                            @php
                                // กรองเอาคีย์ที่ต้องการข้ามออก
                                $filteredScores = array_filter(
                                    $scores,
                                    function ($value, $key) {
                                        return !in_array($key + 1, [2, 7, 10]); // ข้ามแถวที่ไม่ต้องการ
                                    },
                                    ARRAY_FILTER_USE_BOTH,
                                );
                                $numericScores = array_map('intval', $filteredScores);

                                // รวมคะแนนที่เหลือหลังจากการแปลงเป็นตัวเลข
                                $total = array_sum($numericScores);
                            @endphp
                            <td>{{ $total }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            <div>
                <label class="form-label" for="">สรุปผลการสอบ</label>
                <div class="form-check">
                    <input class="form-check-input" wire:model="approve" type="checkbox" value=""
                        id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        ผ่าน
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" wire:model="approve_fix" type="checkbox" value=""
                        id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        ผ่าน/แก้ไขใหม่
                    </label>
                    <textarea class="form-control" wire:model="approve_fix_comment" name="" id=""></textarea>
                </div>
                <div class="form-check">
                    <input class="form-check-input" wire:model="not_approve" type="checkbox" value=""
                        id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        ไม่ผ่าน
                    </label>
                    <textarea class="form-control" wire:model="not_approve_comment" name="" id=""></textarea>
                </div>
            </div>
            <div>
                @if (Auth::guard('teachers')->user()->user_type == 'Admin')
                    <label class="form-label" for="">ความเห็นของอาจารย์ประจำวิชา</label>
                    <div class="form-check">
                        <input class="form-check-input" wire:model="" type="checkbox" value=""
                            id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            อนุมัติ
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" wire:model="" type="checkbox" value=""
                            id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            ควรประผลประเมินเป็น
                        </label>
                        <textarea class="form-control" wire:model="" name="" id=""></textarea>
                    </div>
                    <div class="form-check">
                        <label class="form-label" for="">เนื่องจาก</label>
                        <textarea class="form-control" wire:model="" name="" id=""></textarea>
                    </div>
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                @elseif (Auth::guard('teachers')->user()->user_type == 'Branch head')
                <label class="form-label" for="">ความเห็นของหัวหน้าสาขา</label>
                    <div class="form-check">
                        <input class="form-check-input" wire:model="" type="checkbox" value=""
                            id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            อนุมัติ
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" wire:model="" type="checkbox" value=""
                            id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            ควรประผลประเมินเป็น
                        </label>
                        <textarea class="form-control" wire:model="" name="" id=""></textarea>
                    </div>
                    <div class="form-check">
                        <label class="form-label" for="">เนื่องจาก</label>
                        <textarea class="form-control" wire:model="" name="" id=""></textarea>
                    </div>
                @endif
            </div>
            <button class="btn btn-primary" type="submit">บันทึก</button>
            <a href="{{ route('pdf.stream') }}" target="_blank">View PDF</a>

        </form>
    </div>
</div> --}}
<div>
    <section id="document-detail-06">
        <form wire:submit="score_calculate">
            <fieldset>
                <legend>ผลการสอบโครงการ</legend>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">หัวข้อพิจารณา</th>
                            <th scope="col">คะแนน</th>
                            @foreach ($projects as $ProjectItems)
                                @foreach ($ProjectItems->confirmStudents as $index => $Student)
                                    <th scope="col">คนที่ {{ $index + 1 }}</th>
                                @endforeach
                            @endforeach

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($criterias as $key => $criterion)
                            <tr>
                                <th scope="row"></th>
                                <td>{!! $criterion['name'] !!}</td>
                                <td>{{ $criterion['score'] }}</td>

                                @if (!in_array($key + 1, [2, 7, 10]))
                                    <!-- Skip rows 2, 6, 9 -->
                                    @foreach ($projects as $ProjectItems)
                                        @foreach ($ProjectItems->confirmStudents as $index => $Student)
                                            <td>
                                                <input type="number"
                                                    wire:model.live="score_student.{{ $Student->student->id_student }}.{{ $key }}"
                                                    class="form-control" placeholder="" aria-label=""
                                                    aria-describedby="basic-addon1">
                                            </td>
                                        @endforeach
                                    @endforeach
                                @else
                                    @foreach ($projects as $ProjectItems)
                                        @foreach ($ProjectItems->confirmStudents as $index => $Student)
                                            <td></td> <!-- Empty cell for skipped rows -->
                                        @endforeach
                                    @endforeach
                                @endif
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2">รวม</td>
                            <td></td>
                            @foreach ($this->score_student as $id_student => $scores)
                                @php
                                    // กรองเอาคีย์ที่ต้องการข้ามออก
                                    $filteredScores = array_filter(
                                        $scores,
                                        function ($value, $key) {
                                            return !in_array($key + 1, [2, 7, 10]); // ข้ามแถวที่ไม่ต้องการ
                                        },
                                        ARRAY_FILTER_USE_BOTH,
                                    );
                                    $numericScores = array_map('intval', $filteredScores);

                                    // รวมคะแนนที่เหลือหลังจากการแปลงเป็นตัวเลข
                                    $total = array_sum($numericScores);
                                @endphp
                                <td>{{ $total }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </fieldset>
            <fieldset>
                <legend>สรุปผลการสอบ</legend>
                <div x-data="{ approve_fix: false, not_approve: false, approve: false }">
                    <div class="row">
                        <div class="col-12">
                            <ul>
                                <li>
                                    <input wire:model="approve" type="checkbox" id="approve" x-model="approve"
                                        x-bind:disabled="approve_fix || not_approve">
                                    <label for="approve">ผ่าน</label>
                                </li>
                                <li>
                                    <input wire:model="approve_fix" type="checkbox" id="approve_fix"
                                        x-model="approve_fix" x-bind:disabled="approve || not_approve">
                                    <label for="approve_fix">ผ่าน/แก้ไขใหม่</label>
                                    <textarea x-show="approve_fix" class="form-control mt-2" wire:model="approve_fix_comment"></textarea>
                                </li>
                                <li>
                                    <input wire:model="not_approve" type="checkbox" id="not_approve"
                                        x-model="not_approve" x-bind:disabled="approve || approve_fix">
                                    <label for="not_approve">ไม่ผ่าน</label>
                                    <textarea x-show="not_approve" class="form-control mt-2" wire:model="not_approve_comment"></textarea>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                @if (Auth::guard('teachers')->user()->user_type == 'Admin')
                    <legend>ความเห็นของอาจารย์ประจำวิชา</legend>
                    <div x-data="{ admin_approve_fix: false, admin_approve: false }">
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
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
                                <label for="admin_approve_fix">ควรประผลประเมินเป็น</label>
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
                    </div>
                @elseif (Auth::guard('teachers')->user()->user_type == 'Branch head')
                    <legend>ความเห็นของหัวหน้าสาขา</legend>
                    <div x-data="{ branch - head_approve_fix: false, branch - head_approve: false }">
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <input wire:model="branch-head_approve" type="checkbox" id="branch-head_approve"
                                    x-model="branch-head_approve" x-bind:disabled="branch - head_approve_fix">
                                <label for="branch-head_approve">อนุมัติ</label>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <input wire:model="branch-head_approve_fix" type="checkbox" id="branch-head_approve_fix"
                                    x-model="branch-head_approve_fix" x-bind:disabled="branch - head_approve">
                                <label for="branch-head_approve_fix">ควรประผลประเมินเป็น</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div x-show="branch-head_approve_fix">
                                    <label for="">เนื่องจาก</label>
                                    <textarea class="form-control" wire:model="branch-head_approve_fix_comment" id="branch-head_approve_fix_comment"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </fieldset>
            <fieldset>
                <button class="btn btn-primary" type="submit">บันทึก</button>
                <a href="{{ route('pdf.stream') }}" target="_blank">View PDF</a>
            </fieldset>
        </form>
    </section>
</div>
