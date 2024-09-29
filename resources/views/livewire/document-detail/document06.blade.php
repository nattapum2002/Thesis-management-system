<div>
    <section id="document-detail-06">
        <div class="card">
            <div class="card-body">
                @if (Auth::guard('teachers')->user()->user_type == 'Admin')
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
                                                                aria-describedby="basic-addon1" min="0"
                                                                max="{{ $criterion['score'] }}">
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
                            @if (session()->has('score success'))
                                <div class="alert alert-success">
                                    {{ session('score success') }}
                                </div>
                            @endif
                            <button class="btn btn-success mt-3" type="submit">บันทึกคะแนน</button>
                        </fieldset>
                    </form>
                    <fieldset>
                        <form wire:submit="test_summary">
                            <legend>สรุปผลการสอบ</legend>
                            <div x-data="{ approve_fix: false, not_approve: false, approve: false }">
                                <div class="row">
                                    <div class="col-12">
                                        <ul>
                                            <li>
                                                <input wire:model="approve" type="checkbox" id="approve"
                                                    x-model="approve" x-bind:disabled="approve_fix || not_approve">
                                                <label for="approve">ผ่าน</label>
                                            </li>
                                            <li>
                                                <input wire:model="approve_fix" type="checkbox" id="approve_fix"
                                                    x-model="approve_fix" x-bind:disabled="approve || not_approve">
                                                <label for="approve_fix">ผ่าน/แก้ไขใหม่</label>
                                                <textarea x-show="approve_fix" class="form-control mt-2" wire:model="approve_fix_comment"></textarea>
                                                <div class="text-danger">
                                                    @error('approve_fix_comment')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </li>
                                            <li>
                                                <input wire:model="not_approve" type="checkbox" id="not_approve"
                                                    x-model="not_approve" x-bind:disabled="approve || approve_fix">
                                                <label for="not_approve">ไม่ผ่าน</label>
                                                <textarea x-show="not_approve" class="form-control mt-2" wire:model="not_approve_comment"></textarea>
                                                <div class="text-danger">
                                                    @error('not_approve_comment')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @if (session()->has('test success'))
                                    <div class="alert alert-success">
                                        {{ session('test success') }}
                                    </div>
                                @endif
                                <button class="btn btn-success" type="submit">บันทึกผลการสอบ</button>
                            </div>
                        </form>
                    </fieldset>
                    <fieldset>
                        <form wire:submit="admin_comment">
                            <legend>ความเห็นของอาจารย์ประจำวิชา</legend>
                            <div x-data="{ admin_approve_fix_choice: false, admin_approve: false }">
                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <ul>
                                            <li>
                                                <input wire:model="admin_approve" type="checkbox" id="admin_approve"
                                                    x-model="admin_approve" x-bind:disabled="admin_approve_fix_choice">
                                                <label for="admin_approve">อนุมัติ</label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <ul>
                                            <li>
                                                <input wire:model="admin_approve_fix_choice" type="checkbox"
                                                    id="admin_approve_fix_choice" x-model="admin_approve_fix_choice"
                                                    x-bind:disabled="admin_approve">
                                                <label for="admin_approve_fix_choice">ควรปรับผลประเมินเป็น...</label>
                                            </li>
                                            <li>
                                                <div x-show="admin_approve_fix_choice">
                                                    <textarea class="form-control" wire:model="admin_approve_fix_choice_comment" id="admin_approve_fix_choice_comment"></textarea>
                                                    <div class="text-danger">
                                                        @error('admin_approve_fix_choice_comment')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <ul>
                                            <li>
                                                <div x-show="admin_approve_fix_choice">
                                                    <label for="">เนื่องจาก</label>
                                                    <textarea class="form-control" wire:model="admin_approve_fix_comment" id="admin_approve_fix_comment"></textarea>
                                                    <div class="text-danger">
                                                        @error('admin_approve_fix_comment')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @if (session()->has('comment success'))
                                    <div class="alert alert-success">
                                        {{ session('comment success') }}
                                    </div>
                                @elseif (session()->has('error'))
                                    {
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                    }
                                @endif
                                <button class="btn btn-success" type="submit">บันทึกความเห็น</button>
                            </div>
                        </form>
                    </fieldset>
                @elseif (Auth::guard('teachers')->user()->user_type == 'Branch head')
                    <form wire:submit="branch_head_comment">
                        <fieldset>
                            <legend>ความเห็นของหัวหน้าสาขา</legend>
                            <div x-data="{ branch_head_approve_fix_choice: false, branch_head_approve: false }">
                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <ul>
                                            <li>
                                                <input wire:model="branch_head_approve" type="checkbox"
                                                    id="branch-head_approve" x-model="branch_head_approve"
                                                    x-bind:disabled="branch_head_approve_fix">
                                                <label for="branch_head_approve">อนุมัติ</label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <ul>
                                            <li>
                                                <input wire:model="branch_head_approve_fix_choice" type="checkbox"
                                                    id="branch_head_approve_fix_choice"
                                                    x-model="branch_head_approve_fix_choice"
                                                    x-bind:disabled="branch_head_approve_choice">
                                                <label
                                                    for="branch_head_approve_fix_choice">ควรปรับผลประเมินเป็น...</label>
                                            </li>
                                            <li>
                                                <div x-show="branch_head_approve_fix_choice">
                                                    <textarea class="form-control" wire:model="branch_head_approve_fix_choice_comment"
                                                        id="branch_head_approve_fix_choice_comment"></textarea>
                                                    <div class="text-danger">
                                                        @error('branch_head_approve_fix_choice_comment')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <ul>
                                            <li>
                                                <div x-show="branch_head_approve_fix_choice">
                                                    <label for="">เนื่องจาก</label>
                                                    <textarea class="form-control" wire:model="branch_head_approve_fix_comment" id="branch_head_approve_fix_comment"></textarea>
                                                    <div class="text-danger">
                                                        @error('branch_head_approve_fix_comment')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @if (session()->has('comment success'))
                                    <div class="alert alert-success">
                                        {{ session('comment success') }}
                                    </div>
                                @endif
                                <button class="btn btn-success" type="submit">บันทึกความเห็น</button>
                            </div>
                        </fieldset>
                    </form>
                @endif
                {{-- <fieldset>
        <button class="btn btn-success" type="submit">บันทึก</button>
        <a href="{{ route('pdf.stream') }}" target="_blank">View PDF</a>
    </fieldset> --}}
            </div>
        </div>
    </section>
</div>
