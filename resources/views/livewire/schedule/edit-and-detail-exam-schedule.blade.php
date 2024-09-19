<div>
    <section id="edit-and-detail-exam-schedule">
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 160px">หัวข้อ</th>
                                    <th>รายละเอียด</th>
                                    <th style="width: 160px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>ชื่อโปรเจค</th>
                                    <td>
                                        <p>{{ $exam_schedule->project->project_name_th }}</p>
                                        <small>{{ $exam_schedule->project->project_name_en }}</small>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>รายชื่อกรรมการ</th>
                                    <td>
                                        @foreach ($directors->where('id_project', $exam_schedule->id_project)->sortBy('id_position') as $director)
                                            @php
                                                $name =
                                                    $director->teacher->prefix .
                                                    ' ' .
                                                    $director->teacher->name .
                                                    ' ' .
                                                    $director->teacher->surname;
                                            @endphp
                                            {!! $director->id_position == 5 ? "<p>$name</p>" : "<small>$name</small><br>" !!}
                                        @endforeach
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>ประเภทการสอบ</th>
                                    <td>
                                        <p>{{ $exam_schedule->id_document == 3 ? 'สอบหัวข้อ' : 'สอบจบ' }}</p>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>เวลาสอบ</th>
                                    @if ($toggle['exam_time'])
                                        <td>
                                            <div class="input-field">
                                                <input class="form-control" wire:model="exam_time" type="time"
                                                    placeholder="กรุณากรอกเวลาสอบ">
                                                @error('exam_time')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div class="button-container">
                                                <button class="btn btn-success"
                                                    wire:click="save('exam_time')">บันทึก</button>
                                                <button class="btn btn-danger"
                                                    wire:click="cancel('exam_time')">ยกเลิก</button>
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            <p>{{ thaidate('H:i น.', $exam_time) }}
                                            </p>
                                        </td>
                                        <td>
                                            <button class="btn btn-orange" wire:click="edit('exam_time')"><i
                                                    class='bx bx-edit'></i></button>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>วันที่สอบ</th>
                                    @if ($toggle['exam_day'])
                                        <td>
                                            <div class="input-field">
                                                <input class="form-control" wire:model="exam_day" type="date"
                                                    placeholder="กรุณากรอกเวลาสอบ">
                                                @error('exam_day')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div class="button-container">
                                                <button class="btn btn-success"
                                                    wire:click="save('exam_day')">บันทึก</button>
                                                <button class="btn btn-danger"
                                                    wire:click="cancel('exam_day')">ยกเลิก</button>
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            <p>{{ thaidate('j M Y', $exam_day) }}
                                            </p>
                                        </td>
                                        <td>
                                            <button class="btn btn-orange" wire:click="edit('exam_day')"><i
                                                    class='bx bx-edit'></i></button>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>ภาคเรียน</th>
                                    @if ($toggle['semester'])
                                        <td>
                                            <div class="input-field">
                                                <select class="form-select" wire:model="semester">
                                                    <option value="null" selected>กรุณาเลือก</option>
                                                    <option value="1">ภาคเรียนที่ 1</option>
                                                    <option value="2">ภาคเรียนที่ 2</option>
                                                    <option value="3">ภาคฤดูร้อน</option>
                                                </select>
                                                @error('semester')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div class="button-container">
                                                <button class="btn btn-success"
                                                    wire:click="save('semester')">บันทึก</button>
                                                <button class="btn btn-danger"
                                                    wire:click="cancel('semester')">ยกเลิก</button>
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            <p>
                                                {{ [1 => 'ภาคเรียนที่ 1', 2 => 'ภาคเรียนที่ 2', 3 => 'ภาคฤดูร้อน'][$exam_schedule->semester] ?? '' }}
                                            </p>
                                        </td>
                                        <td>
                                            <button class="btn btn-orange" wire:click="edit('semester')"><i
                                                    class='bx bx-edit'></i></button>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>ปีการศึกษา</th>
                                    @if ($toggle['year_published'])
                                        <td>
                                            <div class="input-field">
                                                <select class="form-select" wire:model='year_published' required>
                                                    <option selected>กรุณาเลือกปีการศึกษา</option>
                                                    <option value="{{ now()->format('Y') }}">
                                                        {{ now()->thaidate('Y') }}
                                                    </option>
                                                    <option value="{{ now()->subYear()->format('Y') }}">
                                                        {{ now()->subYear()->thaidate('Y') }}
                                                    </option>
                                                </select>
                                            </div>
                                            @error('year_published')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <div class="button-container">
                                                <button class="btn btn-success"
                                                    wire:click="save('year_published')">บันทึก</button>
                                                <button class="btn btn-danger"
                                                    wire:click="cancel('year_published')">ยกเลิก</button>
                                            </div>
                                        </td>
                                    @else
                                        <td>{{ thaidate('Y', $exam_schedule->year_published) }}</td>
                                        <td>
                                            <button class="btn btn-orange" wire:click="edit('year_published')"><i
                                                    class='bx bx-edit'></i></button>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>ห้องสอบ</th>
                                    @if ($toggle['exam_room'])
                                        <td>
                                            <div class="input-field">
                                                <input type="text" class="form-control" wire:model="exam_room">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="button-container">
                                                <button class="btn btn-success"
                                                    wire:click="save('exam_room')">บันทึก</button>
                                                <button class="btn btn-danger"
                                                    wire:click="cancel('exam_room')">ยกเลิก</button>
                                            </div>
                                        </td>
                                    @else
                                        <td>{{ $exam_schedule->exam_room }}</td>
                                        <td>
                                            <button class="btn btn-orange" wire:click="edit('exam_room')"><i
                                                    class='bx bx-edit'></i></button>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>อาคารสอบ</th>
                                    @if ($toggle['exam_building'])
                                        <td>
                                            <div class="input-field">
                                                <input type="text" class="form-control" wire:model="exam_building">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="button-container">
                                                <button class="btn btn-success"
                                                    wire:click="save('exam_building')">บันทึก</button>
                                                <button class="btn btn-danger"
                                                    wire:click="cancel('exam_building')">ยกเลิก</button>
                                            </div>
                                        </td>
                                    @else
                                        <td>{{ $exam_schedule->exam_building }}</td>
                                        <td>
                                            <button class="btn btn-orange" wire:click="edit('exam_building')"><i
                                                    class='bx bx-edit'></i></button>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>คณะ</th>
                                    @if ($toggle['exam_group'])
                                        <td>
                                            <div class="input-field">
                                                <input type="text" class="form-control" wire:model="exam_group">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="button-container">
                                                <button class="btn btn-success"
                                                    wire:click="save('exam_group')">บันทึก</button>
                                                <button class="btn btn-danger"
                                                    wire:click="cancel('exam_group')">ยกเลิก</button>
                                            </div>
                                        </td>
                                    @else
                                        <td>{{ $exam_schedule->exam_group }}</td>
                                        <td>
                                            <button class="btn btn-orange" wire:click="edit('exam_group')"><i
                                                    class='bx bx-edit'></i></button>
                                        </td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@script
    <script>
        // กำหนดให้เวลาในอดีตไม่สามารถป้อนได้
        document.addEventListener('DOMContentLoaded', function() {
            const examTimeInput = document.getElementById('examTime');

            // ฟังก์ชันในการตั้งค่าเวลาขั้นต่ำ
            const setMinTime = () => {
                const now = new Date();
                const hours = now.getHours().toString().padStart(2, '0');
                const minutes = now.getMinutes().toString().padStart(2, '0');
                examTimeInput.min = `${hours}:${minutes}`;
            };

            // เรียกใช้ฟังก์ชันเพื่อกำหนดเวลาเมื่อหน้าเพจถูกโหลด
            setMinTime();
        });
    </script>
@endscript

@script
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const examDateInput = document.getElementById('examDate');
            const examTimeInput = document.getElementById('examTime');

            // ฟังก์ชันในการตั้งค่าเวลาขั้นต่ำ
            const setMinTime = () => {
                const now = new Date();
                const selectedDate = new Date(examDateInput.value);

                if (selectedDate.setHours(0, 0, 0, 0) === now.setHours(0, 0, 0, 0)) {
                    const hours = now.getHours().toString().padStart(2, '0');
                    const minutes = now.getMinutes().toString().padStart(2, '0');
                    examTimeInput.min = `${hours}:${minutes}`;
                } else {
                    examTimeInput.min = '';
                }
            };

            // กำหนดเวลาเริ่มต้นเมื่อผู้ใช้เปลี่ยนวันที่
            examDateInput.addEventListener('change', setMinTime);
        });
    </script>
@endscript
