<div>
    <section id="edit-and-detail-document-schedule">
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
                                    <th>ชื่อเอกสาร</th>
                                    @if ($toggle['id_document'])
                                        <td>
                                            <div class="input-field">
                                                <select class="form-select" wire:model='id_document' required>
                                                    <option selected>กรุณาเลือกชื่อเอกสาร</option>
                                                    @foreach ($documents as $document)
                                                        <option value="{{ $document->id_document }}">
                                                            คกท.-คง.-0{{ $document->id_document . ' ' . $document->document }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('edit_document')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div class="button-container">
                                                <button class="btn btn-success"
                                                    wire:click="save('id_document')">บันทึก</button>
                                                <button class="btn btn-danger"
                                                    wire:click="cancel('id_document')">ยกเลิก</button>
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            <p class="text-success">
                                                0{{ $submission->id_document . ' ' . $submission->document->document }}
                                            </p>
                                        </td>
                                        <td>
                                            <button class="btn btn-orange" wire:click="edit('id_document')"><i
                                                    class='bx bx-edit'></i></button>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>กำหนดส่ง(เวลา)</th>
                                    @if ($toggle['time_submission'])
                                        <td>
                                            <div class="input-field">
                                                <input class="form-input" type="time" wire:model='time_submission'
                                                    placeholder="กรุณากรอกเวลาสอบ" required>
                                                @error('edit_time')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div class="button-container">
                                                <button class="btn btn-success"
                                                    wire:click="save('time_submission')">บันทึก</button>
                                                <button class="btn btn-danger"
                                                    wire:click="cancel('time_submission')">ยกเลิก</button>
                                            </div>
                                        </td>
                                    @else
                                        <td>{{ thaidate('H:i น.', $submission->time_submission) }}</td>
                                        <td>
                                            <button class="btn btn-orange" wire:click="edit('time_submission')"><i
                                                    class='bx bx-edit'></i></button>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>กำหนดส่ง(วันที่)</th>
                                    @if ($toggle['date_submission'])
                                        <td>
                                            <div class="input-field">
                                                <input class="form-input" type="date" wire:model='date_submission'
                                                    placeholder="กรุณากรอกวันที่สอบ" required>
                                                @error('edit_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div class="button-container">
                                                <button class="btn btn-success"
                                                    wire:click="save('date_submission')">บันทึก</button>
                                                <button class="btn btn-danger"
                                                    wire:click="cancel('date_submission')">ยกเลิก</button>
                                            </div>
                                        </td>
                                    @else
                                        <td>{{ thaidate('วันl ที่ j F พ.ศ.Y', $submission->date_submission) }}</td>
                                        <td>
                                            <button class="btn btn-orange" wire:click="edit('date_submission')"><i
                                                    class='bx bx-edit'></i></button>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>กำหนดปีการศึกษา</th>
                                    @if ($toggle['year_submission'])
                                        <td>
                                            <div class="input-field">
                                                <select class="form-select" wire:model='year_submission' required>
                                                    <option selected>กรุณาเลือกปีการศึกษา</option>
                                                    <option value="{{ now()->format('Y') }}">
                                                        {{ now()->thaidate('Y') }}
                                                    </option>
                                                    <option value="{{ now()->subYear()->format('Y') }}">
                                                        {{ now()->subYear()->thaidate('Y') }}
                                                    </option>
                                                </select>
                                                @error('edit_year')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div class="button-container">
                                                <button class="btn btn-success"
                                                    wire:click="save('year_submission')">บันทึก</button>
                                                <button class="btn btn-danger"
                                                    wire:click="cancel('year_submission')">ยกเลิก</button>
                                            </div>
                                        </td>
                                    @else
                                        <td>{{ thaidate('Y', $submission->year_submission) }}</td>
                                        <td>
                                            <button class="btn btn-orange" wire:click="edit('year_submission')"><i
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
