{{-- <div>
    <!-- Content -->
    <div class="container mt-4">
        <div class="news-detail">
            @if ($news->news_image == null)
            <img src="{{ 'https://picsum.photos/id/' . rand(1, 1084) . '/1000/1000' }}" alt=""
                style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            @else
            <img wire:live src="{{ asset('storage/'.$news->news_image)}}" alt="{{ $news->title }}"
                style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            @endif
            <h1>{{ $news->title }}</h1>
            <p>ประเภท: {{ $news->type }}</p>
            <p class="text-muted">โดย: {{ $news->teacher->name.' '.$news->teacher->surname }} วันที่: {{
                $news->created_at->format('d/m/Y') }}</p>
            <div>
                {!! nl2br(e($news->details)) !!}
            </div>
            <a href="/menu_news" class="btn btn-primary mt-4">ย้อนกลับ</a>
        </div>
    </div>
</div> --}}

<div>
    <section id="detail-news">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="img">
                        <p class="tag">{{ $news->type }}</p>
                        @if ($news->news_image == null)
                            <img src="{{ 'https://picsum.photos/id/' . rand(1, 1084) . '/1000/500' }}"
                                alt="{{ $news->title }}">
                        @else
                            <img wire:live src="{{ asset('storage/' . $news->news_image) }}" alt="{{ $news->title }}">
                        @endif
                    </div>
                </div>
            </div>
            <div class="row gy-3 justify-content-center">
                <div class="col-lg-9">
                    <h3>{{ $news->title }}</h3>
                    <div>
                        {!! nl2br(e($news->details)) !!}
                    </div>
                </div>
                <div class="col-lg-3">
                    <h5>เผยแพร่เมื่อ</h5>
                    <p>{{ $news->created_at->thaidate('วันที่ j F พ.ศ.Y เวลา H:i') }}</p>
                    <h5>ผู้เผยแพร่</h5>
                    <p>{{ $news->teacher->prefix . ' ' . $news->teacher->name . ' ' . $news->teacher->surname }}</ก>
                </div>
            </div>
            <hr>
            <div class="row gy-3">
                <div class="col-12">
                    <h3>ข่าวอื่นๆ</h3>
                </div>
            </div>
            <div class="row gy-3 justify-content-center">
                @foreach ($other_news as $item)
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
        </div>
    </section>
</div>
