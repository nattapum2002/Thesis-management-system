<div>
    <div class="card">
        <div class="card-header">
            <h3>ขออนุมัติชื่อเรื่องและแต่งตั้งที่ปรึกษา</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="submit">
                <div class="member">
                    <span class="title text-primary">สมาชิกกลุ่มปริญานิพนธ์</span>
                    <div class="fields">
                        @foreach ($members as $index => $member)
                        <div class="input-fields">
                            <label class="form-label">นักศึกษาลำดับที่ {{ $index + 1 }}</label>
                            <input type="text" wire:model="members.{{ $index }}.id_student" class="form-control"
                                placeholder="กรุณากรอกรหัสนักศึกษา" @if ($index==0) readonly @endif>
                            <input type="text" wire:model="members.{{ $index }}.name" class="form-control"
                                placeholder="กรุณากรอกชื่อ" @if ($index==0) readonly @endif>
                            @if ($index > 0)
                            <button type="button" wire:click="removeMember({{ $index }})"
                                class="btn btn-danger">ลบสมาชิก</button>
                            @endif
                        </div>
                        @endforeach
                        @if (count($members) < 5) <button type="button" wire:click="addMember" class="btn btn-success">
                            เพิ่มสมาชิก</button>
                            @endif
                    </div>
                </div>
                <div class="project-name">
                    <span class="title text-primary">ชื่อเรื่องโครงงานปริญญานิพนธ์</span>
                    <div class="fields">
                        <div class="input-fields">
                            <label class="form-label">ภาษาไทย</label>
                            <input type="text" wire:model="project_name_th" class="form-control"
                                placeholder="กรุณากรอกชื่อโครงงาน" required>
                        </div>
                        <div class="input-fields">
                            <label class="form-label">ภาษาอังกฤษ</label>
                            <input type="text" wire:model="project_name_en" class="form-control"
                                placeholder="กรุณากรอกชื่อโครงงาน" required>
                        </div>
                    </div>
                </div>
                <div class="main-advisor">
                    <span class="title text-primary">อาจารย์ที่ปรึกษาหลัก</span>
                    <div class="fields">
                        @foreach ($advisers as $index => $adviser)
                        <div class="input-fields">
                            <select wire:model="advisers.{{ $index }}" class="form-control">
                                <option value="">กรุณาเลือกที่ปรึกษาหลัก</option>
                                @foreach ($all_teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->prefix }} {{ $teacher->name }} {{
                                    $teacher->surname }}</option>
                                @endforeach
                            </select>
                            @if (isset($adviser))
                            @php
                            $teacher = $all_teachers->find($adviser);
                            @endphp
                            <div>{{ $teacher->prefix }} {{ $teacher->name }} {{ $teacher->surname }}</div>
                            <div>{{ $teacher->academic_position }}</div>
                            <div>{{ $teacher->educational_qualification }}</div>
                            <div>{{ $teacher->branch }}</div>
                            <button type="button" wire:click="removeAdviser({{ $index }})"
                                class="btn btn-danger">ลบที่ปรึกษา</button>
                            @endif
                        </div>
                        @endforeach
                        @if (count($advisers) < 1) <button type="button" wire:click="addAdviser"
                            class="btn btn-primary">เพิ่มที่ปรึกษาหลัก</button>
                            @endif
                    </div>
                </div>
                <div class="co-advisor">
                    <span class="title text-primary">อาจารย์ที่ปรึกษาร่วม(ถ้ามี)</span>
                    <div class="fields">
                        @foreach ($external_advisers as $index => $external_adviser)
                        <div class="input-fields">
                            <input type="text" wire:model="external_advisers.{{ $index }}.prefix" placeholder="คำนำหน้า"
                                class="form-control">
                            <input type="text" wire:model="external_advisers.{{ $index }}.name" placeholder="ชื่อ"
                                class="form-control">
                            <input type="text" wire:model="external_advisers.{{ $index }}.surname" placeholder="นามสกุล"
                                class="form-control">
                            <input type="text" wire:model="external_advisers.{{ $index }}.academic_position"
                                placeholder="ตำแหน่งทางวิชาการ" class="form-control">
                            <input type="text" wire:model="external_advisers.{{ $index }}.educational_qualification"
                                placeholder="วุฒิการศึกษา" class="form-control">
                            <input type="text" wire:model="external_advisers.{{ $index }}.branch"
                                placeholder="สาขาที่จบการศึกษา" class="form-control">
                            <button type="button" wire:click="removeExternalAdviser({{ $index }})"
                                class="btn btn-danger">ลบที่ปรึกษาร่วม</button>
                        </div>
                        @endforeach
                        <button type="button" wire:click="addExternalAdviser"
                            class="btn btn-primary">เพิ่มที่ปรึกษาร่วม</button>
                    </div>
                </div>
                <div class="btn-input">
                    <button type="button" class="btn btn-danger">ยกเลิก</button>
                    <button type="submit" class="btn btn-success">ขออนุมัติชื่อเรื่องและแต่งตั้งที่ปรึกษา</button>
                </div>
            </form>
        </div>
    </div>

</div>