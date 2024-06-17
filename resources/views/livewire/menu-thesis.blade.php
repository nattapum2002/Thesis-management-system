<div>
    <!-- Content -->
    <div class="container mt-4">
        <h1>บทความปริญญานิพนธ์</h1>
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="ค้นหาบทความ..." wire:model.debounce.300ms="search">
            </div>
            <div class="col-md-3">
                <select class="form-select" wire:model="filterDate">
                    <option value="latest">บทความล่าสุด</option>
                    <option value="oldest">บทความเก่าสุด</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" wire:model="filterType">
                    <option value="all">ทุกประเภท</option>
                    <option value="general">ทั่วไป</option>
                    <option value="specific">เฉพาะทาง</option>
                </select>
            </div>
        </div>

        <div class="row">
            @foreach ($articles as $item)
            <div class="col-md-3 mb-4">
                <div class="card thesis-card">
                    <img src="{{ $item->thesis_image }}" alt="{{ $item->title }}" class="img-fluid">
                    <div class="ribbon">{{ $item->type == 'general' ? 'ทั่วไป' : 'เฉพาะทาง' }}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">โดย {{ $item->author }} วันที่ {{ $item->created_at->format('d/m/Y') }}</p>
                        <p class="card-text">{{ Str::limit($item->details, 100) }}</p>
                        <a href="/thesis_detail/{{ $item->id_dissertation_article }}"
                            class="btn btn-primary">อ่านเพิ่มเติม</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $articles->onEachSide(1)->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>