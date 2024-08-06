<div>
    <section id="manage-document-schedule">
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" wire:model.live.debounce.150ms="search">
                    <button class="btn btn-orange" type="submit"><i class='bx bx-search'></i></button>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-start">
                            <a href="/admin/add_document_schedule" class="btn btn-success">เพิ่มกำหนดการ</a>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table text-nowrap table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <a wire:click="sortBy('id_submission')">
                                            <span>ID</span>
                                            <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a wire:click="sortBy('id_document')">
                                            <span>ชื่อเอกสาร</span>
                                            <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a wire:click="sortBy('time_submission')">
                                            <span>กำหนดส่ง(เวลา)</span>
                                            <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a wire:click="sortBy('date_submission')">
                                            <span>กำหนดส่ง(วันที่)</span>
                                            <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a wire:click="sortBy('date_submission')">
                                            <span>ปีการศึกษา</span>
                                            <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                        </a>
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documents_schedule as $document_schedule)
                                    <tr>
                                        <td>{{ $document_schedule->id_submission }}</td>
                                        <td>
                                            <p>{{ 'เอกสาร คกท.-คง.-0' . $document_schedule->document->id_document }}</p>
                                            <small>{{ $document_schedule->document->document }}</small>
                                        </td>
                                        <td>{{ $document_schedule->time_submission }}</td>
                                        <td>{{ $document_schedule->date_submission }}</td>
                                        <td>{{ $document_schedule->year_submission }}</td>
                                        <td>
                                            <a class="btn btn-orange btn-sm"
                                                href="/admin/edit_and_detail_document_schedule/{{ $document_schedule->id_submission }}">
                                                <i class="bx bx-detail"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $documents_schedule->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
