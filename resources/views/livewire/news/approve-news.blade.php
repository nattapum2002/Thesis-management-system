<div>
    @if (session('danger') || session('success'))
        <div class="alert alert-{{ session('danger') ? 'danger' : 'success' }}" role="alert">
            {{ session('danger') ?? session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="mb-2">
                <input type="text" class="form-control" placeholder="ค้นหาข่าว..."
                    wire:model.live.debounce.150ms="search">
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="mb-2">
                <select class="form-select" wire:model.live.debounce.100ms="filterType">
                    <option value="all">ทุกประเภท</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->type }}">{{ $type->type }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="mb-2">
                <select class="form-select" wire:model.live.debounce.100ms="filterApprove">
                    <option value="all">ทุกสถานะ</option>
                    <option value="0">ไม่อนุมัติ</option>
                    <option value="1">อนุมัติ</option>
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
                                @foreach (['id_news' => 'ID', 'title' => 'หัวข้อ', 'details' => 'รายละเอียด', 'type' => 'ประเภท', 'updated_at' => 'อัพเดทล่าสุด'] as $field => $label)
                                    <th>
                                        <a wire:click="sortBy('{{ $field }}')">
                                            <span>{{ $label }}</span>
                                            <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                        </a>
                                    </th>
                                @endforeach
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $news_detail)
                                <tr>
                                    <td>{{ $news_detail->id_news }}</td>
                                    <td>{{ $news_detail->title }}</td>
                                    <td>{{ $news_detail->teacher->name . ' ' . $news_detail->teacher->surname }}</td>
                                    <td>{{ $news_detail->type }}</td>
                                    <td>
                                        <p>{{ $news_detail->updated_at->thaidate('H:i น.') }}</p>
                                        <small>{{ $news_detail->updated_at->thaidate('j M Y') }}</small>
                                    </td>
                                    <td>
                                        <a wire:click="{{ $news_detail->status == '1' ? 'show(' . $news_detail->id_news . ')' : 'hide(' . $news_detail->id_news . ')' }}"
                                            class="btn {{ $news_detail->status == '1' ? 'btn-success' : 'btn-danger' }}">
                                            <i
                                                class='bx {{ $news_detail->status == '1' ? 'bxs-show' : 'bxs-hide' }}'></i>
                                        </a>
                                        <a href="{{ route('admin.detail.approve.news', $news_detail->id_news) }}"
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
                            แสดงข่าว <b>{{ $news->firstItem() }}</b>
                            ถึง <b>{{ $news->lastItem() }}</b>
                            จากทั้งหมด <b>{{ $news->total() }}</b> ข่าว
                        </p>
                        {{ $news->onEachSide(2)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
