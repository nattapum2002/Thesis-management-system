<div>
    <div class="score-table">
        <form wire:submit="score_calculate">
            <label class="form-label" for="">ผลการสอบโครงการ</label>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ข้อที่</th>
                        <th scope="col">หัวข้อพิจารณา</th>
                        <th scope="col">คะแนน</th>
                        {{-- @dd($projects->confirmStudents) --}}
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
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{!! $criterion['name'] !!}</td>
                            <td>{{ $criterion['score'] }}</td>

                            @if (!in_array($key + 1, [2, 6, 9]))
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
            <button class="btn btn-primary" type="submit">บันทึก</button>
            {{-- <a href="{{ route('pdf.stream') }}" target="_blank">View PDF</a> --}}
            
        </form>
    </div>
</div>

{{-- <tbody>
    <tr>
        <th scope="row">1</th>
        <td>บุคลิก ท่าทาง การวางตัวและความเชื่อมั่นในตนเอง</td>
        <td>10</td>
        <td>
            <input type="number" wire:model.live="score_director_1.0" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
        <td>
            <input type="number" wire:model.live="score_director_2.0" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
        <td>
            <input type="number" wire:model.live="score_director_3.0" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
    </tr>
    <tr>
        <th scope="row">2</th>
        <td colspan="5">การนำเสนอผลงาน</td>
    </tr>
    <tr>
        <th scope="row">2.1</th>
        <td>ไฟล์นำเสนอมีความสมบูรณ</td>
        <td>10</td>
        <td>
            <input type="number" wire:model.live="score_director_1.2" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
        <td>
            <input type="number" wire:model.live="score_director_2.2" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
        <td>
            <input type="number" wire:model.live="score_director_3.2" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
    </tr>
    <tr>
        <th scope="row">2.2</th>
        <td>ทักษะการใช้ภาษาเพื่อการสื่อสาร</td>
        <td>10</td>
        <td>
            <input type="number" wire:model.live="score_director_1.3" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
        <td>
            <input type="number" wire:model.live="score_director_2.3" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
        <td>
            <input type="number" wire:model.live="score_director_3.3" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
    </tr>
    <tr>
        <th scope="row">3</th>
        <td>ทักษะการใช้ภาษาเพื่อการสื่อสาร</td>
        <td>20</td>
        <td>
            <input type="number" wire:model.live="score_director_1.4" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
        <td>
            <input type="number" wire:model.live="score_director_2.4" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
        <td>
            <input type="number" wire:model.live="score_director_3.4" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
    </tr>
    <tr>
        <th scope="row">4</th>
        <td colspan="5">ความสมบูรณ์ของเอกสารโครงงานฉบับร่าง</td>
    </tr>
    <tr>
        <th scope="row">4.1</th>
        <td>รูปแบบถูกต้องตามคู่มือจัดทำโครงงาน</td>
        <td>10</td>
        <td>
            <input type="number" wire:model.live="score_director_1.6" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
        <td>
            <input type="number" wire:model.live="score_director_2.6" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
        <td>
            <input type="number" wire:model.live="score_director_3.6" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
    </tr>
    <tr>
        <th scope="row">4.2</th>
        <td>เนื้อหาครบถ้วน</td>
        <td>10</td>
        <td>
            <input type="number" wire:model.live="score_director_1.7" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
        <td>
            <input type="number" wire:model.live="score_director_2.7" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
        <td>
            <input type="number" wire:model.live="score_director_3.7" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
    </tr>
    <tr>
        <th scope="row">5</th>
        <td colspan="5">ความเหมาะสมของโครงงานตาม</td>
    </tr>
    <tr>
        <th scope="row">5.1</th>
        <td>วัตถุประสงค์ของโครงงาน</td>
        <td>10</td>
        <td>
            <input type="number" wire:model.live="score_director_1.9" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
        <td>
            <input type="number" wire:model.live="score_director_2.9" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
        <td>
            <input type="number" wire:model.live="score_director_3.9" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
    </tr>
    <tr>
        <th scope="row">5.2</th>
        <td>ขอบเขตของโครงงาน</td>
        <td>10</td>
        <td>
            <input type="number" wire:model.live="score_director_1.10" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
        <td>
            <input type="number" wire:model.live="score_director_2.10" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
        <td>
            <input type="number" wire:model.live="score_director_3.10" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
    </tr>
    <tr>
        <th scope="row">6</th>
        <td>ความพร้อมและตรงต่อเวลา</td>
        <td>10</td>
        <td>
            <input type="number" wire:model.live="score_director_1.11" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
        <td>
            <input type="number" wire:model.live="score_director_2.11" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
        <td>
            <input type="number" wire:model.live="score_director_3.11" class="form-control"
                placeholder="" aria-label="" aria-describedby="basic-addon1">
        </td>
    </tr>
    <tr>
        <th></th>
        <td colspan="1">รวม</td>
        <td>100</td>
        <td>
            <p>
                {{ $total_score_director_1 }}
            </p>
        </td>
        <td>
            <p>{{ $total_score_director_2 }}</p>
        </td>
        <td>
            <p>{{ $total_score_director_3 }}</p>
        </td>
    </tr>
</tbody> --}}
