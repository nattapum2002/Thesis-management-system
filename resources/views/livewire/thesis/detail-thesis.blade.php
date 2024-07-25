{{-- <div>
    <div class="container mt-4">
        <div class="thesis-detail">
            <img src="{{ $article->thesis_image }}" alt="{{ $article->title }}" class="img-fluid img-detail">
            <h1>{{ $article->title }}</h1>
            <p class="text-muted">โดย {{ $article->created_by }} วันที่ {{ $article->created_at->format('d/m/Y') }}</p>
            <div>
                {!! nl2br(e($article->details)) !!}
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-primary mt-4">ย้อนกลับ</a>
        </div>
    </div>
</div> --}}

<div>
    <section id="detail-thesis">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <img src="{{ $article->thesis_image }}" alt="{{ $article->title }}">
                </div>
                <div class="div-lg-6"></div>
            </div>
        </div>
    </section>
</div>
