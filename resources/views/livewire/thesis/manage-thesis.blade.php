{{-- <div>
    @if (session('danger'))
        <div class="alert alert-danger" role="alert">
            {{ session('danger') }}
        </div>
    @elseif (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="mb-2">
                <input type="text" class="form-control" placeholder="ค้นหาบทความ..."
                    wire:model.live.debounce.150ms="search">
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="mb-2">
                <select class="form-select" wire:model.live.debounce.100ms="filterDate">
                    <option value="บทความล่าสุด">บทความล่าสุด</option>
                    <option value="บทความเก่าสุด">บทความเก่าสุด</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="mb-2">
                <select class="form-select" wire:model.live.debounce.100ms="filterType">
                    <option value="ทุกประเภท">ทุกประเภท</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->type }}">{{ $type->type }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                        <a href="/member/add_thesis" class="btn btn-success">เพิ่มบทความ</a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table text-nowrap table-striped">
                        <thead>
                            <tr>
                                <th>
                                    <a wire:click="sortBy('id_dissertation_article')">
                                        <span>ID</span>
                                        <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                    </a>
                                </th>
                                <th>
                                    <a wire:click="sortBy('title')">
                                        <span>ชื่อบทความ</span>
                                        <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                    </a>
                                </th>
                                <th>
                                    <a wire:click="sortBy('type')">
                                        <span>ประเภท</span>
                                        <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                    </a>
                                </th>
                                <th>
                                    <a wire:click="sortBy('year_published')">
                                        <span>ปีการศึกษา</span>
                                        <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                    </a>
                                </th>
                                <th>
                                    <a wire:click="sortBy('updated_at')">
                                        <span>อัพเดทล่าสุด</span>
                                        <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                    </a>
                                </th>
                                <th>
                                    <a wire:click="sortBy('status')">
                                        <span>สถานะ</span>
                                        <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($thesis as $thesis_detail)
                                <tr>
                                    <td>{{ $thesis_detail->id_dissertation_article }}</td>
                                    <td>{{ $thesis_detail->title }}</td>
                                    <td>{{ $thesis_detail->type }}</td>
                                    <td>{{ thaidate('Y', $thesis_detail->year_published) }}</td>
                                    <td>
                                        <p>{{ $thesis_detail->created_at->thaidate('H:i น.') }}</p>
                                        <small>{{ $thesis_detail->created_at->thaidate('d M Y') }}</small>
                                    </td>
                                    <td>
                                        @if ($thesis_detail->status == '1')
                                            <a wire:click='show({{ $thesis_detail->id_dissertation_article }})'
                                                class="btn btn-success"><i class='bx bxs-show'></i></a>
                                        @else
                                            <a wire:click='hide({{ $thesis_detail->id_dissertation_article }})'
                                                class="btn btn-danger"><i class='bx bxs-hide'></i></a>
                                        @endif
                                        <a href="/member/edit_and_detail_thesis/{{ $thesis_detail->id_dissertation_article }}"
                                            class="btn btn-orange"><i class='bx bx-detail'></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row gy-2">
                    <div class="col-lg-12">
                        <p class="page-number">
                            แสดงบทความ <b>{{ $thesis->firstItem() }}</b>
                            ถึง <b>{{ $thesis->lastItem() }}</b>
                            จาก <b>{{ $thesis->total() }}</b> บทความ
                        </p>
                        {{ $thesis->onEachSide(2)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div>
    @if (session('danger') || session('success'))
        <div class="alert alert-{{ session('danger') ? 'danger' : 'success' }}" role="alert">
            {{ session('danger') ?? session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-6 col-md-12 mb-2">
            <input type="text" class="form-control" placeholder="ค้นหาบทความ..." wire:model.live.debounce.150ms="search">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
            <select class="form-select" wire:model.live.debounce.100ms="filterDate">
                <option value="บทความล่าสุด">บทความล่าสุด</option>
                <option value="บทความเก่าสุด">บทความเก่าสุด</option>
            </select>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
            <select class="form-select" wire:model.live.debounce.100ms="filterType">
                <option value="ทุกประเภท">ทุกประเภท</option>
                @foreach ($types as $type)
                    <option value="{{ $type->type }}">{{ $type->type }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <a href="/member/add_thesis" class="btn btn-success">เพิ่มบทความ</a>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table text-nowrap table-striped">
                <thead>
                    <tr>
                        @foreach (['id_dissertation_article' => 'ID', 'title' => 'ชื่อบทความ', 'type' => 'ประเภท', 'year_published' => 'ปีการศึกษา', 'updated_at' => 'อัพเดทล่าสุด', 'status' => 'สถานะ'] as $field => $label)
                            <th>
                                <a wire:click="sortBy('{{ $field }}')">
                                    <span>{{ $label }}</span>
                                    <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                </a>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($thesis as $thesis_detail)
                        <tr>
                            <td>{{ $thesis_detail->id_dissertation_article }}</td>
                            <td>{{ $thesis_detail->title }}</td>
                            <td>{{ $thesis_detail->type }}</td>
                            <td>{{ thaidate('Y', $thesis_detail->year_published) }}</td>
                            <td>
                                <p>{{ $thesis_detail->created_at->thaidate('H:i น.') }}</p>
                                <small>{{ $thesis_detail->created_at->thaidate('d M Y') }}</small>
                            </td>
                            <td>
                                <a wire:click='toggleVisibility({{ $thesis_detail->id_dissertation_article }}, {{ $thesis_detail->status == 1 ? 0 : 1 }})'
                                    class="btn btn-{{ $thesis_detail->status == 1 ? 'success' : 'danger' }}">
                                    <i class='bx bxs-{{ $thesis_detail->status == 1 ? 'show' : 'hide' }}'></i>
                                </a>
                                <a href="/member/edit_and_detail_thesis/{{ $thesis_detail->id_dissertation_article }}"
                                    class="btn btn-orange">
                                    <i class='bx bx-detail'></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row gy-2">
            <div class="col-lg-12">
                <p class="page-number">
                    แสดงบทความ <b>{{ $thesis->firstItem() }}</b>
                    ถึง <b>{{ $thesis->lastItem() }}</b>
                    จาก <b>{{ $thesis->total() }}</b> บทความ
                </p>
                {{ $thesis->onEachSide(2)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
