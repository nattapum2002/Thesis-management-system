{{-- <div>
    @if (Auth::guard('teachers')->user()->user_type == 'Admin')
        <div>
            <form wire:submit.prevent="confirmDocument_02">
                <strong>เสนอชื่อกรรมการสอบเค้าโครง</strong>
                <div x-data="{ id_teacher: @entangle('id_teacher') }">
                    <div class="main-director">
                        <span class="title">ประธานกรรมการ</span>
                        <div class="fields">
                            <div class="input-fields">
                                <select class="form-select" x-model="id_teacher[0]">
                                    <option selected>กรุณาเลือกที่ประธานกรรมการ</option>
                                    @foreach ($teachers as $main_director)
                                        <option value="{{ $main_director->id_teacher }}"
                                            x-show="!Object.values(id_teacher).includes('{{ $main_director->id_teacher }}')">
                                            {{ $main_director->name }} {{ $main_director->surname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="sub-director">
                        <span class="title">กรรมการ</span>
                        <div class="fields">
                            <div class="input-fields">
                                <select class="form-select" x-model="id_teacher[1]">
                                    <option selected>กรุณาเลือกกรรมการ</option>
                                    @foreach ($teachers as $sub_director)
                                        <option value="{{ $sub_director->id_teacher }}"
                                            x-show="!Object.values(id_teacher).includes('{{ $sub_director->id_teacher }}')">
                                            {{ $sub_director->name }} {{ $sub_director->surname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="sub-director">
                        <span class="title">กรรมการ</span>
                        <div class="fields">
                            <div class="input-fields">
                                <select class="form-select" x-model="id_teacher[2]">
                                    <option selected>กรุณาเลือกกรรมการ</option>
                                    @foreach ($teachers as $sub_director)
                                        <option value="{{ $sub_director->id_teacher }}"
                                            x-show="!Object.values(id_teacher).includes('{{ $sub_director->id_teacher }}')">
                                            {{ $sub_director->name }} {{ $sub_director->surname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="sub-director">
                        <span class="title">กรรมการและเลขานุการ(อาจารย์ที่ปรึกษา)</span>
                        <div class="fields">
                            <div class="input-fields">
                                <select class="form-select" x-model="id_teacher[3]">
                                    <option selected>กรุณาเลือกกรรมการและเลขานุการ(อาจารย์ที่ปรึกษา)</option>
                                    @foreach ($teachers as $sub_director)
                                        <option value="{{ $sub_director->id_teacher }}"
                                            x-show="!Object.values(id_teacher).includes('{{ $sub_director->id_teacher }}')">
                                            {{ $sub_director->name }} {{ $sub_director->surname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <strong>กำหนดให้มีการสอบเค้าโครง</strong>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">วัน/เดือน/ปี</span>
                            <input type="date" class="form-control" name="date" id="date" wire:model="date">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">เวลา</span>
                            <input type="time" class="form-control" name="time" id="time" wire:model="time">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">ปีการศึกษา</span>
                            <input type="text" class="form-control" name="year" id="year" wire:model="year">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">ภาคการศึกษา</span>
                            <select class="form-select" wire:model="term" name="" id="">
                                <option value="null" selected>กรุณาเลือก</option>
                                <option value="1">ภาคเรียนที่ 1</option>
                                <option value="2">ภาคเรียนที่ 2</option>
                                <option value="3">ภาคฤดูร้อน</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">สถานที่</span>
                            <input type="text" class="form-control" name="place" id="place" wire:model="place">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">อาคาร</span>
                            <input type="text" class="form-control" name="building" id="building"
                                wire:model="building">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">คณะ</span>
                            <select class="form-select" wire:model="faculty" name="" id="">
                                <option value="null" selected>กรุณาเลือกคณะ</option>
                                <option value="คณะเทคโนโลยีการจัดการ">คณะเทคโนโลยีการจัดการ</option>
                                <option value="คณะเกษตรศาสตร์และเทคโนโลยี">คณะเกษตรศาสตร์และเทคโนโลยี</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">บันทึก</button>
            </form>
        </div>
    @elseif (Auth::guard('teachers')->user()->user_type == 'Branch head')
        <form wire:submit.prevent="Brance_head_approve">
            <div x-data="{ showComment: false, approve: false, not_approve: false }">
                <label class="form-label" for="">ความเห็นของหัวหน้าสาขาวิชา</label>
                <div class="row">
                    <div class="col">
                        <input type="checkbox" wire:model="branch_head_approve" value="อนุมัติ"
                            x-model="not_approve" x-bind:disabled="approve">
                        <label for="">อนุมัติ</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <input type="checkbox" wire:model="branch_head_not_approve" x-model="approve"
                            value="ไม่อนุมัติ" x-bind:disabled="not_approve">
                        <label for="">ไม่อนุมัติ</label>
                    </div>
                    <div x-show="approve">
                        <label for="">หมายเหตุ:</label>
                        <textarea class="form-control" wire:model="branch_head_comment" id="message-text"></textarea>
                    </div>

                </div>
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <button class="btn btn-primary" type="submit">ยืนยัน</button>
            </div>

        </form>
    @endif

</div> --}}

<div>
    <section id="document-detail-02">
        <div class="card">
            <div class="card-body">
                @if (Auth::guard('teachers')->user()->user_type == 'Admin')
                    <form wire:submit.prevent="confirmDocument_02">
                        <div x-data="{ id_teacher: @entangle('id_teacher') }">
                            <fieldset>
                                <legend>เสนอชื่อกรรมการสอบเค้าโครง</legend>
                                <ul>
                                    <li>
                                        <p>ประธานกรรมการ</p>
                                        <select class="form-select" x-model="id_teacher[0]">
                                            <option selected>กรุณาเลือกประธานกรรมการ</option>
                                            @foreach ($teachers as $main_director)
                                                <option value="{{ $main_director->id_teacher }}"
                                                    x-show="!Object.values(id_teacher).includes('{{ $main_director->id_teacher }}')">
                                                    {{ $main_director->name }} {{ $main_director->surname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </li>
                                    <li>
                                        <p>กรรมการ</p>
                                        <select class="form-select" x-model="id_teacher[1]">
                                            <option selected>กรุณาเลือกกรรมการ</option>
                                            @foreach ($teachers as $sub_director)
                                                <option value="{{ $sub_director->id_teacher }}"
                                                    x-show="!Object.values(id_teacher).includes('{{ $sub_director->id_teacher }}')">
                                                    {{ $sub_director->name }} {{ $sub_director->surname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </li>
                                    <li>
                                        <p>กรรมการ</p>
                                        <select class="form-select" x-model="id_teacher[2]">
                                            <option selected>กรุณาเลือกกรรมการ</option>
                                            @foreach ($teachers as $sub_director)
                                                <option value="{{ $sub_director->id_teacher }}"
                                                    x-show="!Object.values(id_teacher).includes('{{ $sub_director->id_teacher }}')">
                                                    {{ $sub_director->name }} {{ $sub_director->surname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </li>
                                    <li>
                                        <p>กรรมการและเลขานุการ(อาจารย์ที่ปรึกษา)</p>
                                        <select class="form-select" x-model="id_teacher[3]">
                                            <option selected>กรุณาเลือกกรรมการและเลขานุการ(อาจารย์ที่ปรึกษา)
                                            </option>
                                            @foreach ($teachers as $sub_director)
                                                <option value="{{ $sub_director->id_teacher }}"
                                                    x-show="!Object.values(id_teacher).includes('{{ $sub_director->id_teacher }}')">
                                                    {{ $sub_director->name }} {{ $sub_director->surname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </li>
                                </ul>
                            </fieldset>
                        </div>
                        <fieldset>
                            <legend>กำหนดให้มีการสอบเค้าโครง</legend>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">วันที่</span>
                                        <input type="date" class="form-control" name="date" id="date"
                                            wire:model="date">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">เวลา</span>
                                        <input type="time" class="form-control" name="time" id="time"
                                            wire:model="time">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">ปีการศึกษา</span>
                                        <select class="form-select" wire:model='year'>
                                            <option selected>กรุณาเลือกปีการศึกษา</option>
                                            <option value="{{ now()->format('Y') }}">
                                                {{ now()->thaidate('Y') }}
                                            </option>
                                            <option value="{{ now()->subYear()->format('Y') }}">
                                                {{ now()->subYear()->thaidate('Y') }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">ภาคการศึกษา</span>
                                        <select class="form-select" wire:model="term" name="" id="">
                                            <option value="null" selected>กรุณาเลือก</option>
                                            <option value="1">ภาคเรียนที่ 1</option>
                                            <option value="2">ภาคเรียนที่ 2</option>
                                            <option value="3">ภาคฤดูร้อน</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">ห้อง</span>
                                        <input type="text" class="form-control" name="place" id="place"
                                            wire:model="place">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">อาคาร</span>
                                        <input type="text" class="form-control" name="building" id="building"
                                            wire:model="building">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">คณะ</span>
                                        <select class="form-select" wire:model="faculty" name="" id="">
                                            <option value="null" selected>กรุณาเลือกคณะ</option>
                                            <option value="คณะเทคโนโลยีการจัดการ">คณะเทคโนโลยีการจัดการ</option>
                                            <option value="คณะเกษตรศาสตร์และเทคโนโลยี">คณะเกษตรศาสตร์และเทคโนโลยี
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">บันทึก</button>
                        </fieldset>
                    </form>
                @elseif (Auth::guard('teachers')->user()->user_type == 'Branch head')
                    <form wire:submit.prevent="Brance_head_approve">
                        <div x-data="{ showComment: false, approve: false, not_approve: false }">
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <fieldset>
                                <legend>ความเห็นของหัวหน้าสาขา</legend>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-12">
                                        <ul>
                                            <li>
                                                <input type="checkbox" wire:model="branch_head_approve" value="อนุมัติ"
                                                    x-model="not_approve" x-bind:disabled="approve">
                                                <label for="">อนุมัติ</label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12">
                                        <ul>
                                            <li>
                                                <input type="checkbox" wire:model="branch_head_not_approve"
                                                    x-model="approve" value="ไม่อนุมัติ"
                                                    x-bind:disabled="not_approve">
                                                <label for="">ไม่อนุมัติ</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div x-show="approve">
                                            <label for="">หมายเหตุ:</label>
                                            <textarea class="form-control" wire:model="branch_head_comment" id="message-text"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit">ยืนยัน</button>
                            </fieldset>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </section>
</div>
