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
                    <option value="บทความล่าสุด">บทความล่าสุด</option>
                    <option value="บทความเก่าสุด">บทความเก่าสุด</option>
                </select>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="input-group mb-3">
                <select class="form-select" wire:model.live.debounce.100ms="filterType">
                    <option value="ทุกประเภท">ทุกประเภท</option>
                    <option value="Software">Software</option>
                    <option value="Hardware">Hardware</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($thesis as $item)
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                <div class="card bg-light d-flex flex-fill">
                    <div class="ribbon-wrapper ribbon-lg">
                        @if ($item->type == 'Software')
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
                                    @foreach ($projects as $project)
                                        @if ($item->id_project == $project->id_project)
                                            @foreach ($project->members as $member)
                                                <li class="small">
                                                    <span class="fa-li"><i class='bx bx-user'></i></span>
                                                    <b>โดย: </b> {{ $member->name }} {{ $member->surname }}
                                                </li>
                                            @endforeach
                                        @endif
                                    @endforeach
                                    <li class="small">
                                        <span class="fa-li"><i class='bx bx-calendar-edit'></i></span>
                                        <b>วันที่: </b> {{ $item->created_at->format('d/m/Y') }}
                                    </li>
                                </ul>
                                <p class="text-muted text-sm">{{ Str::limit($item->details, 100) }}</p>
                            </div>
                            <div class="col-5 text-center">
                                @if ($item->thesis_image == null)
                                    <img src="{{ 'https://picsum.photos/id/' . rand(1, 1084) . '/1000/1000' }}"
                                        class="img-fluid" alt="{{ $item->title }}">
                                @else
                                    <img wire:live src="{{ asset('storage/' . $item->thesis_image) }}" class="img-fluid"
                                        alt="{{ $item->title }}">
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            @if ($users->user_type == 'Admin')
                                <a href="/admin/detail_thesis_login/{{ $item->id_dissertation_article }}"
                                    class="btn btn-sm btn-orange">อ่านเพิ่มเติม</a>
                            @elseif ($users->user_type == 'Branch head')
                                <a href="/branch-head/detail_thesis_login/{{ $item->id_dissertation_article }}"
                                    class="btn btn-sm btn-orange">อ่านเพิ่มเติม</a>
                            @elseif ($users->user_type == 'Teacher')
                                <a href="/teacher/detail_thesis_login/{{ $item->id_dissertation_article }}"
                                    class="btn btn-sm btn-orange">อ่านเพิ่มเติม</a>
                            @else
                                <a href="/member/detail_thesis_login/{{ $item->id_dissertation_article }}"
                                    class="btn btn-sm btn-orange">อ่านเพิ่มเติม</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $thesis->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
</div> --}}

<div>
    <section id="menu-thesis">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="mb-2">
                    <input type="text" class="form-control" placeholder="ค้นหาบทความ..."
                        wire:model.live.debounce.150ms="search">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="mb-2">
                    <select class="form-select" wire:model.live.debounce.300ms="filterDate">
                        <option value="latest">บทความล่าสุด</option>
                        <option value="oldest">บทความเก่าสุด</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="mb-2">
                    <select class="form-select" wire:model.live.debounce.300ms="filterType">
                        <option value="all">ทุกประเภท</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->type }}">{{ $type->type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row gy-2">
            @foreach ($articles as $item)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="post">
                        {{-- <a href="/detail_thesis/{{ $item->id_dissertation_article }}"> --}}
                        @if ($users->user_type == 'Admin')
                            <a href="/admin/detail_thesis_login/{{ $item->id_dissertation_article }}">
                            @elseif ($users->user_type == 'Branch head')
                                <a href="/branch-head/detail_thesis_login/{{ $item->id_dissertation_article }}">
                                @elseif ($users->user_type == 'Teacher')
                                    <a href="/teacher/detail_thesis_login/{{ $item->id_dissertation_article }}">
                                    @else
                                        <a href="/member/detail_thesis_login/{{ $item->id_dissertation_article }}">
                        @endif
                        <p class="tag">{{ $item->type }}</p>
                        @if ($item->thesis_image == null)
                            <img src="{{ 'https://picsum.photos/id/' . rand(1, 1084) . '/1000/1000' }}"
                                alt="{{ $item->title }}">
                        @else
                            <img wire:live src="{{ asset('storage/' . $item->thesis_image) }}"
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
    </section>
</div>
