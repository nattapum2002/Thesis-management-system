<div>
    <!-- Content -->
    <div class="container mt-4">
        <div class="news-detail">
            <img src="{{ $news->news_image }}" alt="{{ $news->title }}" class="img-fluid img-detail">
            <h1>{{ $news->title }}</h1>
            <p>ประเภท: {{ $news->type == 'general' ? 'ข่าวทั่วไป' : 'ชื่อหัวข้อ' }}</p>
            <p class="text-muted">โดย: {{ $news->teacher->name }} วันที่: {{ $news->created_at->format('d/m/Y') }}</p>
            <div>
                {!! nl2br(e($news->details)) !!}
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-primary mt-4">ย้อนกลับ</a>
        </div>
    </div>
</div>