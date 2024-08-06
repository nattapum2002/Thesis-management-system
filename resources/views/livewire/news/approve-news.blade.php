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
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search" wire:model.live.debounce.150ms="search">
                <button class="btn btn-orange" type="submit"><i class='bx bx-search'></i></button>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="input-group mb-3">
                <select class="form-select" wire:model.live.debounce.100ms="filterDate">
                    <option value="ข่าวล่าสุด">ข่าวล่าสุด</option>
                    <option value="ข่าวเก่าสุด">ข่าวเก่าสุด</option>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="input-group mb-3">
                <select class="form-select" wire:model.live.debounce.100ms="filterType">
                    <option value="ทุกประเภท">ทุกประเภท</option>
                    <option value="ข่าวทั่วไป">ข่าวทั่วไป</option>
                    <option value="ชื่อหัวข้อ">ชื่อหัวข้อ</option>
                </select>
            </div>
        </div>
    </div>
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
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $news_detail->title }}</td>
                            <td>{{ $news_detail->teacher->name . ' ' . $news_detail->teacher->surname }}</td>
                            <td>{{ $news_detail->type }}</td>
                            <td>{{ $news_detail->updated_at }}</td>
                            <td>
                                @if ($news_detail->status == '1')
                                    <a wire:click='show({{ $news_detail->id_news }})' class="btn btn-success"><i
                                            class='bx bxs-show'></i></a>
                                @else
                                    <a wire:click='hide({{ $news_detail->id_news }})' class="btn btn-danger"><i
                                            class='bx bxs-hide'></i></a>
                                @endif
                                <a href="/admin/edit_and_detail_news/{{ $news_detail->id_news }}"
                                    class="btn btn-orange"><i class='bx bx-detail'></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row gy-3">
            <div class="col-12">
                <p class="page-number">
                    แสดงข่าว <b>{{ $news->firstItem() }}</b>
                    ถึง <b>{{ $news->lastItem() }}</b>
                    จากทั้งหมด <b>{{ $news->total() }}</b> ข่าว
                </p>
                {{ $news->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
