<div>
    <section id="detail-approve-news">
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
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
                            <th>รูปภาพ</th>
                            <td>
                                @if ($news->news_image == null)
                                    <img src="{{ 'https://picsum.photos/id/' . rand(1, 1084) . '/1000/1000' }}"
                                        alt=""
                                        style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                @else
                                    <img wire:live src="{{ asset('storage/' . $news->news_image) }}"
                                        alt="{{ $news->title }}"
                                        style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                @endif
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>หัวข้อ</th>
                            <td>{{ $news->title }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>รายละเอียด</th>
                            <td>{{ $news->details }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>ประเภทข่าว</th>
                            <td>{{ $news->type }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>สถานะข่าว</th>
                            @if ($toggle['status'])
                                <td>
                                    <div class="input-field">
                                        <select class="form-select" wire:model.live="status">
                                            <option selected>สถานะข่าว</option>
                                            <option value="1">แสดง</option>
                                            <option value="0">ซ่อน</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </td>
                                <td>
                                    <div class="button-container">
                                        <button class="btn btn-success" wire:click="save('status')">บันทึก</button>
                                        <button class="btn btn-danger" wire:click="cancel('status')">ยกเลิก</button>
                                    </div>
                                </td>
                            @else
                                <td>
                                    @if ($news->status == 1)
                                        <p class="text-success">แสดง</p>
                                    @else
                                        <p class="text-danger">ซ่อน</p>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-orange" wire:click="edit('status')"><i
                                            class='bx bx-edit'></i></button>
                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
