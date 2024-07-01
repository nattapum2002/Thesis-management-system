<div>
    <div class="row">
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search" wire:model.live.debounce.150ms="search">
                <button class="btn btn-primary" type="submit"><i class='bx bx-search'></i></button>
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
                        <th>#</th>
                        <th>หัวข้อข่าว</th>
                        <th>ผู้เขียน</th>
                        <th>ประเภท</th>
                        <th>วันที่-เวลา</th>
                        <th>สถานะข่าว</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $news_detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $news_detail->title }}</td>
                        <td>{{ $news_detail->teacher->name.' '.$news_detail->teacher->surname }}</td>
                        <td>{{ $news_detail->type }}</td>
                        <td>{{ $news_detail->updated_at }}</td>
                        <td>
                            @if ($news_detail->status == '1')
                            <p class="text-success">แสดง</p>
                            @else
                            <p class="text-danger">ซ่อน</p>
                            @endif
                        </td>
                        <td>
                            @if ($news_detail->status == '0')
                            <a wire:click.live='show({{ $news_detail->id_news }})' class="btn btn-success"><i
                                    class='bx bxs-show'></i></a>
                            @else
                            <a wire:click.live='hide({{ $news_detail->id_news }})' class="btn btn-danger"><i
                                    class='bx bxs-hide'></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $news->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
