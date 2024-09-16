<div>
    <section id="add-document-schedule">
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table text-nowrap table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 160px">หัวข้อ</th>
                                    <th>รายละเอียด</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>ชื่อเอกสาร</th>
                                    <td>
                                        <div class="input-field">
                                            <select class="form-select" wire:model='add_document' required>
                                                <option selected>กรุณาเลือกชื่อเอกสาร</option>
                                                @foreach ($documents as $document)
                                                    <option value="{{ $document->id_document }}">
                                                        0{{ $document->id_document . ' ' . $document->document }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('#')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>กำหนดส่ง(เวลา)</th>
                                    <td>
                                        <div class="input-field">
                                            <input class="form-control" type="time" wire:model='add_time'
                                                placeholder="กรุณากรอกเวลาสอบ" required>
                                            @error('#')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>กำหนดส่ง(วันที่)</th>
                                    <td>
                                        <div class="input-field">
                                            <input class="form-control" type="date" wire:model='add_date'
                                                placeholder="กรุณากรอกวันที่สอบ" required>
                                            @error('#')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>กำหนดปีการศึกษา</th>
                                    <td>
                                        <div class="input-field">
                                            <select class="form-select" wire:model='add_year' required>
                                                <option selected>กรุณาเลือกปีการศึกษา</option>
                                                <option value="{{ now()->format('Y') }}">
                                                    {{ now()->thaidate('Y') }}
                                                </option>
                                                <option value="{{ now()->subYear()->format('Y') }}">
                                                    {{ now()->subYear()->thaidate('Y') }}
                                                </option>
                                            </select>
                                            @error('#')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>เพิ่มกำหนดการ</th>
                                    <td>
                                        <button class="btn btn-success" wire:click='add'>เพิ่มกำหนดการ</button>
                                        <button class="btn btn-danger" wire:click='cancel'>ยกเลิก</button>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
