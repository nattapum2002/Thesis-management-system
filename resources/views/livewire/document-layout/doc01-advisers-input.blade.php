<div>
    <div class="card">
        <div class="card-header">
            <h4 class="title text-primary">อาจารย์ที่ปรึกษา</h4>
        </div>
        <div class="card-body">
            <span class="title text-primary">อาจารย์ที่ปรึกษาหลัก</span>
            <div class="fields">
                <div class="input-fields mt-2">
                    <select id="mainAdvisorSelect" wire:model="selectedAdvisor" class="form-select" required>
                        <option value="">กรุณาเลือกที่ปรึกษาหลัก</option>
                        @foreach ($advisors as $advisor)
                        <option value="{{ $advisor->id_teacher }}">{{ $advisor->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <span class="title text-primary">อาจารย์ที่ปรึกษาร่วม(ถ้ามี)</span>
            @foreach ($selectedCoAdvisors as $index => $coAdvisorId)
            <div class="fields-co-advisor mt-2">
                <div class="input-fields">
                    <select id="coAdvisorSelect" wire:model="selectedCoAdvisors.{{ $index }}" class="form-select"
                        required>
                        <option value="">กรุณาเลือกที่ปรึกษาร่วม</option>
                        @foreach ($coAdvisors as $coAdvisor)
                        <option value="{{ $coAdvisor->id_teacher }}">{{ $coAdvisor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button wire:click="removeCoAdvisor({{ $index }})" class="btn btn-sm btn-danger ml-2">ลบ</button>
            </div>
            @endforeach

            @foreach ($externalCoAdvisors as $index => $externalCoAdvisor)
            <div class="fields-external-co-advisor mt-2">
                <div class="input-fields">
                    <label class="form-label">คำนำหน้าชื่อ</label>
                    <input wire:model="externalCoAdvisors.{{ $index }}.prefix" class="form-input" type="text"
                        placeholder="กรุณากรอกคำนำหน้าชื่อ" required>
                    <br>
                    <label class="form-label">ชื่อ</label>
                    <input wire:model="externalCoAdvisors.{{ $index }}.name" class="form-input" type="text"
                        placeholder="กรุณากรอกชื่อ" required>
                    <br>
                    <label class="form-label">นามสกุล</label>
                    <input wire:model="externalCoAdvisors.{{ $index }}.surname" class="form-input" type="text"
                        placeholder="กรุณากรอกนามสกุล" required>
                    <br>
                    <label class="form-label">ตำแหน่งทางวิชาการ</label>
                    <input wire:model="externalCoAdvisors.{{ $index }}.academic_position" class="form-input" type="text"
                        placeholder="กรุณากรอกตำแหน่งทางวิชาการ" required>
                    <br>
                    <label class="form-label">วุฒิการศึกษา</label>
                    <input wire:model="externalCoAdvisors.{{ $index }}.education_degree" class="form-input" type="text"
                        placeholder="กรุณากรอกวุฒิการศึกษา" required>
                    <br>
                    <label class="form-label">สาขาที่จบการศึกษา</label>
                    <input wire:model="externalCoAdvisors.{{ $index }}.graduated_major" class="form-input" type="text"
                        placeholder="กรุณากรอกสาขาที่จบการศึกษา" required>
                </div>
                <button wire:click="removeExternalCoAdvisor({{ $index }})"
                    class="btn btn-sm btn-danger ml-2">ลบ</button>
            </div>
            @endforeach

            @if (count($selectedCoAdvisors) + count($externalCoAdvisors) < 3) <div class="input-fields mt-2">
                <button wire:click="addCoAdvisor" class="btn btn-primary">เพิ่มที่ปรึกษาร่วม</button>
                <button wire:click="addExternalCoAdvisor" class="btn btn-primary">เพิ่มที่ปรึกษาร่วมจากภายนอก</button>
        </div>
        @endif
    </div>
</div>

@script
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let mainAdvisorSelect = document.getElementById('mainAdvisorSelect');
        let coAdvisorSelect = document.getElementById('coAdvisorSelect');

        mainAdvisorSelect.addEventListener('change', function () {
            let selectedMainAdvisorId = this.value;

            // Reset options in coAdvisorSelect
            coAdvisorSelect.innerHTML = '';

            // Add default option
            let defaultOption = document.createElement('option');
            defaultOption.text = 'กรุณาเลือกที่ปรึกษาร่วม';
            defaultOption.value = '';
            coAdvisorSelect.appendChild(defaultOption);

            // Filter and add co-advisors based on selected main advisor
            let coAdvisors = {!! json_encode($coAdvisors->toArray()) !!};
            let filteredCoAdvisors = coAdvisors.filter(coAdvisor => coAdvisor.id_teacher !== selectedMainAdvisorId);

            filteredCoAdvisors.forEach(coAdvisor => {
                let option = document.createElement('option');
                option.text = coAdvisor.name;
                option.value = coAdvisor.id_teacher;
                coAdvisorSelect.appendChild(option);
            });
        });
    });
</script>
@endscript