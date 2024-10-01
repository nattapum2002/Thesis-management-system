<div>
    <section id="detail-news">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="img">
                        <p class="tag">{{ $news->type }}</p>
                        @if ($news->news_image)
                            {{-- Thesis-management-system/storage/app/public/ --}}
                            <img wire:live src="{{ asset('storage/' . $news->news_image) }}" alt="{{ $news->title }}">
                        @else
                            <img src="{{ 'https://picsum.photos/id/' . rand(1, 1084) . '/1000/500' }}"
                                alt="{{ $news->title }}">
                        @endif
                    </div>
                </div>
            </div>
            <div class="row gy-2 justify-content-center">
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
            <div class="row gy-2">
                <div class="col-12">
                    <h3>ข่าวอื่นๆ</h3>
                </div>
            </div>
            <div class="row gy-2 justify-content-center">
                @foreach ($other_news as $item)
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
        </div>
    </section>
</div>
