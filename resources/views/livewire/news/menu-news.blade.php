{{-- <div>
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
                    @if ($item->news_image == null)
                    <img src="{{ 'https://picsum.photos/id/' . rand(1, 1084) . '/1000/1000' }}" alt=""
                        style="width: auto; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    @else
                    <img wire:live src="{{ asset('storage/'.$item->news_image)}}" alt="{{ $item->title }}"
                        style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    @endif
                    <div class="ribbon">{{ $item->type }}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">โดย {{ $item->teacher->name }} วันที่ {{ $item->created_at->format('d/m/Y')
                            }}</p>
                        <p class="card-text">{{ Str::limit($item->details, 100) }}</p>
                        <a href="/detail_news/{{ $item->id_news }}" class="btn btn-primary">อ่านเพิ่มเติม</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $news->onEachSide(1)->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div> --}}

<div>
    <section id="menu-news">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>ข่าวประชาสัมพันธ์</h2>
                </div>
            </div>
            <div class="row gy-3 tools">
                <div class="col-lg-6">
                    <input type="text" class="form-control" placeholder="ค้นหาข่าว..."
                        wire:model.live.debounce.150ms="search">
                </div>
                <div class="col-lg-3">
                    <select class="form-select" wire:model.live.debounce.100ms="filterDate">
                        <option value="ข่าวล่าสุด">ข่าวล่าสุด</option>
                        <option value="ข่าวเก่าสุด">ข่าวเก่าสุด</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <select class="form-select" wire:model.live.debounce.100ms="filterType">
                        <option value="ทุกประเภท">ทุกประเภท</option>
                        <option value="ข่าวทั่วไป">ข่าวทั่วไป</option>
                        <option value="ชื่อหัวข้อ">ชื่อหัวข้อ</option>
                    </select>
                </div>
            </div>
            <div class="row gy-3">
                @foreach ($news as $item)
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="post">
                            <a href="/detail_news/{{ $item->id_news }}">
                                <p class="tag">{{ $item->type }}</p>
                                @if ($item->news_image == null)
                                    <img src="{{ 'https://picsum.photos/id/' . rand(1, 1084) . '/1000/1000' }}"
                                        alt="{{ $item->title }}">
                                @else
                                    <img wire:live src="{{ asset('storage/' . $item->news_image) }}"
                                        alt="{{ $item->title }}">
                                @endif
                                <div class="details">
                                    <small>{{ $item->created_at->thaidate('วันที่ j F พ.ศ.Y') }}</small>
                                    <h4>{{ $item->title }}</h4>
                                    <p>{{ $item->teacher->prefix . ' ' . $item->teacher->name . ' ' . $item->teacher->surname }}
                                    </p>
                                    <p>{{ Str::limit($item->details, 100) }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row gy-3">
                <div class="col-12">
                    <p class="page-number">
                        แสดงข่าว <b>{{ $news->firstItem() }}</b>
                        ถึง <b>{{ $news->lastItem() }}</b>
                        จากทั้งหมด <b>{{ $news->total() }}</b> ข่าว
                    </p>
                    {{ $news->onEachSide(2)->links('pagination::bootstrap-4') }}
                </div>
            </div>
    </section>
</div>
