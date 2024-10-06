<div>
    <section id="menu-news">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>ข่าวประชาสัมพันธ์</h2>
                </div>
            </div>
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
                            <option value="desc">ข่าวล่าสุด</option>
                            <option value="asc">ข่าวเก่าสุด</option>
                        </select>
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
            </div>
            <div class="row gy-2">
                @foreach ($news as $item)
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="post">
                            <a href="{{ route('welcome.news.detail', $item->id_news) }}">
                                <p class="tag">{{ $item->type }}</p>
                                @if ($item->news_image)
                                    {{-- Thesis-management-system/storage/app/public/ --}}
                                    <img wire:live src="{{ asset('storage/' . $item->news_image) }}"
                                        alt="{{ $item->title }}">
                                @else
                                    <img src="{{ 'https://picsum.photos/id/' . rand(1, 1084) . '/1000/1000' }}"
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
            <div class="row gy-2">
                <div class="col-lg-12">
                    <p class="page-number">
                        แสดงข่าว <b>{{ $news->firstItem() }}</b>
                        ถึง <b>{{ $news->lastItem() }}</b>
                        จากทั้งหมด <b>{{ $news->total() }}</b> ข่าว
                    </p>
                    {{ $news->appends(request()->query())->onEachSide(2)->links('pagination::bootstrap-4') }}
                    {{-- {{ $news->onEachSide(2)->links('pagination::bootstrap-4') }} --}}
                </div>
            </div>
    </section>
</div>
