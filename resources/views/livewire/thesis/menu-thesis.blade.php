{{-- <div>
    <div class="container mt-4">
        <h1>บทความปริญญานิพนธ์</h1>
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="ค้นหาบทความ..."
                    wire:model.live.debounce.150ms="search">
            </div>
            <div class="col-md-3">
                <select class="form-select" wire:model.live.debounce.300ms="filterDate">
                    <option value="latest">บทความล่าสุด</option>
                    <option value="oldest">บทความเก่าสุด</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" wire:model.live.debounce.300ms="filterType">
                    <option value="all">ทุกประเภท</option>
                    <option value="Hardware">Hardware</option>
                    <option value="Software">Software</option>
                </select>
            </div>
        </div>

        <div class="row">
            @foreach ($articles as $item)
            <div class="col-md-3 mb-4">
                <div class="card thesis-card">
                    <img src="{{ $item->thesis_image }}" alt="{{ $item->title }}" class="img-fluid">
                    <div class="ribbon">{{ $item->type }}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">โดย {{ $item->author }} วันที่ {{ $item->created_at->format('d/m/Y') }}</p>
                        <p class="card-text">{{ Str::limit($item->details, 100) }}</p>
                        <a href="/detail_thesis/{{ $item->id_dissertation_article }}"
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
</div> --}}

<div>
    <section id="menu-thesis">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>บทความปริญญานิพนธ์</h1>
                </div>
            </div>
            <div class="row gy-3 tools">
                <div class="col-lg-6">
                    <input type="text" class="form-control" placeholder="ค้นหาบทความ..."
                        wire:model.live.debounce.150ms="search">
                </div>
                <div class="col-lg-3">
                    <select class="form-select" wire:model.live.debounce.300ms="filterDate">
                        <option value="latest">บทความล่าสุด</option>
                        <option value="oldest">บทความเก่าสุด</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <select class="form-select" wire:model.live.debounce.300ms="filterType">
                        <option value="all">ทุกประเภท</option>
                        <option value="Hardware">Hardware</option>
                        <option value="Software">Software</option>
                    </select>
                </div>
            </div>
            <div class="row gy-3">
                @foreach ($articles as $item)
                    <div class="col-lg-3 lg-4">
                        <div class="thesis-post">
                            <a href="/detail_thesis/{{ $item->id_dissertation_article }}">
                                <p class="tag">{{ $item->type }}</p>
                                <img src="{{ $item->thesis_image }}" alt="{{ $item->title }}" class="img-fluid">
                                <div>
                                    <small class="card-text">โดย {{ $item->author }} วันที่
                                        {{ $item->created_at->format('d/m/Y') }}</small>
                                    <h4 class="card-title">{{ $item->title }}</h4>
                                    <p class="card-text">{{ Str::limit($item->details, 100) }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
