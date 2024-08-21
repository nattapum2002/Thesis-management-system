<div>
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
        <div class="col-lg-9 col-md-12">
            <div class="mb-2">
                <input type="text" class="form-control" placeholder="ค้นหาบทความ..."
                    wire:model.live.debounce.150ms="search">
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
                <div class="card-body table-responsive p-0">
                    <table class="table text-nowrap table-striped">
                        <thead>
                            <tr>
                                @foreach (['id_dissertation_article' => 'ID', 'title' => 'ชื่อบทความ', 'type' => 'ประเภท', 'year_published' => 'ปีการศึกษา', 'updated_at' => 'อัพเดทล่าสุด'] as $field => $label)
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
                                        <p>{{ $thesis_detail->updated_at->thaidate('H:i น.') }}</p>
                                        <small>{{ $thesis_detail->updated_at->thaidate('j M Y') }}</small>
                                    </td>
                                    <td>
                                        <a wire:click="{{ $thesis_detail->status == '1' ? 'show(' . $thesis_detail->id_dissertation_article . ')' : 'hide(' . $thesis_detail->id_dissertation_article . ')' }}"
                                            class="btn {{ $thesis_detail->status == '1' ? 'btn-success' : 'btn-danger' }}">
                                            <i
                                                class='bx {{ $thesis_detail->status == '1' ? 'bxs-show' : 'bxs-hide' }}'></i>
                                        </a>
                                        <a href="/admin/detail_approve_thesis/{{ $thesis_detail->id_dissertation_article }}"
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
                            จากทั้งหมด <b>{{ $thesis->total() }}</b> บทความ
                        </p>
                        {{ $thesis->onEachSide(2)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
