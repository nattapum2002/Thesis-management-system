<div>
    <section id="menu-thesis">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>บทความปริญญานิพนธ์</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <input type="text" class="form-control" placeholder="ค้นหาบทความ..."
                        wire:model.live.debounce.150ms="search">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <select class="form-select" wire:model.live.debounce.300ms="filterDate">
                        <option value="desc">บทความล่าสุด</option>
                        <option value="asc">บทความเก่าสุด</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <select class="form-select" wire:model.live.debounce.300ms="filterType">
                        <option value="all">ทุกประเภท</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->type }}">{{ $type->type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row gy-2">
                @foreach ($articles as $item)
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="post">
                            <a href="{{ route('welcome.thesis.detail', $item->id_dissertation_article) }}">
                                <p class="tag">{{ $item->type }}</p>
                                @if ($item->thesis_image)
                                    {{-- Thesis-management-system/storage/app/public/ --}}
                                    <img wire:live src="{{ asset('storage/' . $item->thesis_image) }}"
                                        alt="{{ $item->title }}">
                                @else
                                    <img src="{{ 'https://picsum.photos/id/' . rand(1, 1084) . '/1000/1000' }}"
                                        alt="{{ $item->title }}">
                                @endif
                                <div class="details">
                                    <small>{{ $item->created_at->thaidate('วันที่ j F พ.ศ.Y') }}</small>
                                    <h4>{{ $item->title }}</h4>
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
                        แสดงบทความ <b>{{ $articles->firstItem() }}</b>
                        ถึง <b>{{ $articles->lastItem() }}</b>
                        จากทั้งหมด <b>{{ $articles->total() }}</b> บทความ
                    </p>
                    {{ $articles->onEachSide(2)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </section>
</div>
