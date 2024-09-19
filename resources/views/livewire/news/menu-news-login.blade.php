{{-- <div>
    <div class="row">
        <div class="col-md-6">
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
    <div class="row">
        @foreach ($news as $item)
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                <div class="card bg-light d-flex flex-fill">
                    <div class="ribbon-wrapper ribbon-lg">
                        @if ($item->type == 'ข่าวทั่วไป')
                            <div class="ribbon bg-danger">
                                {{ $item->type }}
                            </div>
                        @else
                            <div class="ribbon bg-success">
                                {{ $item->type }}
                            </div>
                        @endif

                    </div>
                    <div class="card-header text-muted border-bottom-0">
                        <div class="ribbon">{{ $item->type }}</div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-7">
                                <h2 class="lead"><b>{{ $item->title }}</b></h2>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small">
                                        <span class="fa-li"><i class='bx bx-user'></i></span>
                                        <b>โดย: </b> {{ $item->teacher->name }} {{ $item->teacher->surname }}
                                    </li>
                                    <li class="small">
                                        <span class="fa-li"><i class='bx bx-calendar-edit'></i></span>
                                        <b>วันที่: </b> {{ $item->created_at->format('d/m/Y') }}
                                    </li>
                                </ul>
                                <p class="text-muted text-sm">{{ Str::limit($item->details, 100) }}</p>
                            </div>
                            <div class="col-5 text-center">
                                @if ($item->news_image == null)
                                    <img src="{{ 'https://picsum.photos/id/' . rand(1, 1084) . '/1000/1000' }}"
                                        class="img-fluid" alt="{{ $item->title }}">
                                @else
                                    <img wire:live src="{{ asset('storage/' . $item->news_image) }}" class="img-fluid"
                                        alt="{{ $item->title }}">
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            @if ($users->user_type == 'Admin')
                                <a href="/admin/detail_news_login/{{ $item->id_news }}"
                                    class="btn btn-sm btn-orange">อ่านเพิ่มเติม</a>
                            @elseif ($users->user_type == 'Branch head')
                                <a href="/branch-head/detail_news_login/{{ $item->id_news }}"
                                    class="btn btn-sm btn-orange">อ่านเพิ่มเติม</a>
                            @elseif ($users->user_type == 'Teacher')
                                <a href="/teacher/detail_news_login/{{ $item->id_news }}"
                                    class="btn btn-sm btn-orange">อ่านเพิ่มเติม</a>
                            @else
                                <a href="/member/detail_news_login/{{ $item->id_news }}"
                                    class="btn btn-sm btn-orange">อ่านเพิ่มเติม</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $news->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
</div> --}}

<div>
    <section id="menu-news">
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
        <div class="row gy-2">
            @foreach ($news as $item)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="post">
                        @if ($users->user_type == 'Admin')
                            <a href="{{ route('admin.detail.news', $item->id_news) }}">
                            @elseif ($users->user_type == 'Branch head')
                                <a href="{{ route('branch-head.detail.news', $item->id_news) }}">
                                @elseif ($users->user_type == 'Teacher')
                                    <a href="{{ route('teacher.detail.news', $item->id_news) }}">
                                    @else
                                        <a href="{{ route('member.detail.news', $item->id_news) }}">
                        @endif
                        <p class="tag">{{ $item->type }}</p>
                        @if ($item->news_image)
                            {{-- Thesis-management-system/storage/app/public/ --}}
                            <img wire:live src="{{ asset('storage/' . $item->news_image) }}" alt="{{ $item->title }}">
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
                {{ $news->onEachSide(2)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </section>
</div>
