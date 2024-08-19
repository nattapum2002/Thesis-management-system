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
        <div class="col-lg-6 col-md-12">
            <div class="mb-2">
                <input type="text" class="form-control" placeholder="ค้นหาข่าว..."
                    wire:model.live.debounce.150ms="search">
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="mb-2">
                <select class="form-select" wire:model.live.debounce.100ms="filterDate">
                    <option value="ข่าวล่าสุด">ข่าวล่าสุด</option>
                    <option value="ข่าวเก่าสุด">ข่าวเก่าสุด</option>
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
                <div class="card-body table-responsive p-0">
                    <table class="table text-nowrap table-striped">
                        <thead>
                            <tr>
                                <th>
                                    <a wire:click="sortBy('id_news')">
                                        <span>ID</span>
                                        <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                    </a>
                                </th>
                                <th>
                                    <a wire:click="sortBy('title')">
                                        <span>หัวข้อ</span>
                                        <i class='bx bx-transfer-alt bx-rotate-90'></i>
                                    </a>
                                </th>
                                <th>
                                    <a wire:click="sortBy('details')">
                                        <span>รายละเอียด</span>
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
                                        @if ($news_detail->status == '1')
                                            <a wire:click='show({{ $news_detail->id_news }})'
                                                class="btn btn-success"><i class='bx bxs-show'></i></a>
                                        @else
                                            <a wire:click='hide({{ $news_detail->id_news }})' class="btn btn-danger"><i
                                                    class='bx bxs-hide'></i></a>
                                        @endif
                                        <a href="/admin/detail_approve_news/{{ $news_detail->id_news }}"
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
