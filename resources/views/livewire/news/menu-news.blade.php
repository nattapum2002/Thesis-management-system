<div>
    <div class="container mt-4">
        <h1>ข่าวประชาสัมพันธ์</h1>
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="ค้นหาข่าว..."
                    wire:model.live.debounce.150ms="search">
            </div>
            <div class="col-md-3">
                <select class="form-select" wire:model.live.debounce.100ms="filterDate">
                    <option value="ข่าวล่าสุด">ข่าวล่าสุด</option>
                    <option value="ข่าวเก่าสุด">ข่าวเก่าสุด</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" wire:model.live.debounce.100ms="filterType">
                    <option value="ทุกประเภท">ทุกประเภท</option>
                    <option value="ข่าวทั่วไป">ข่าวทั่วไป</option>
                    <option value="ชื่อหัวข้อ">ชื่อหัวข้อ</option>
                </select>
            </div>
        </div>

        <div class="row">
            @foreach ($news as $item)
            <div class="col-md-3 mb-4">
                <div class="card news-card">
                    <img src="{{ $item->news_image }}" alt="{{ $item->title }}" class="img-fluid">
                    <div class="ribbon">{{ $item->type }}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">โดย {{ $item->teacher->name }} วันที่ {{ $item->created_at->format('d/m/Y')
                            }}</p>
                        <p class="card-text">{{ Str::limit($item->details, 100) }}</p>
                        <a href="/news_detail/{{ $item->id_news }}" class="btn btn-primary">อ่านเพิ่มเติม</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $news->onEachSide(1)->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
