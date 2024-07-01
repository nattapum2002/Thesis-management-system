<div>
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
        </div>
    </div>
</div>
