{{-- <div>
    <div class="container mt-4">
        <div class="thesis-detail">
            @if ($thesis->thesis_image == null)
            <img src="{{ 'https://picsum.photos/id/' . rand(1, 1084) . '/1000/1000' }}" alt=""
                style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            @else
            <img wire:live src="{{ asset('storage/'.$thesis->thesis_image)}}" alt="{{ $thesis->title }}"
                style="width: 200px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            @endif
            <h1>{{ $thesis->title }}</h1>
            <p>ประเภท: {{ $thesis->type }}</p>
            <p class="text-muted">โดย:
                @foreach ($projects as $project)
                @foreach ($project->members as $member)
                {{ $member->prefix.$member->name .' '. $member->surname }}
                @endforeach
                @endforeach
            </p>
            <p class="text-muted">วันที่: {{ $thesis->created_at->format('d/m/Y') }}</p>
            <div>
                {!! nl2br(e($thesis->details)) !!}
            </div>
        </div>
    </div>
</div> --}}

<div>
    <section id="detail-thesis">
        <div class="container">
            <div class="row gy-2 justify-content-center">
                <div class="col-lg-3">
                    <div class="img">
                        <p class="tag">{{ $articles->type }}</p>
                        @if ($articles->thesis_image == null)
                            <img src="{{ 'https://picsum.photos/id/' . rand(1, 1084) . '/1000/1000' }}"
                                alt="{{ $articles->title }}">
                        @else
                            <img wire:live src="{{ asset('storage/' . $articles->thesis_image) }}"
                                alt="{{ $articles->title }}">
                        @endif
                    </div>
                    <h5>เผยแพร่เมื่อ</h5>
                    <p>{{ $articles->created_at->thaidate('วันที่ j F พ.ศ.Y เวลา H:i') }}</p>
                    <h5>เอกสาร</h5>
                    <a href="{{ url('storage/' . $articles->file_dissertation) }}" target="_blank">ดาวน์โหลด PDF</a>
                </div>
                <div class="col-lg-6">
                    <h3>{{ $projects->project_name_th }}</h3>
                    <h4>{{ $projects->project_name_en }}</h4>
                    <div>
                        {!! nl2br(e($articles->details)) !!}
                    </div>
                </div>
                <div class="col-lg-3">
                    <h5>สมาชิก</h5>
                    @foreach ($projects->members as $member)
                        <p>{{ $member->prefix . ' ' . $member->name . ' ' . $member->surname }}
                        </p>
                    @endforeach
                    <h5>ที่ปรึกษาหลัก</h5>
                    @foreach ($projects->advisers as $adviser)
                        @if ($adviser->id_position == 1)
                            <p>{{ $adviser->teacher->prefix . ' ' . $adviser->teacher->name . ' ' . $adviser->teacher->surname }}
                        @endif
                    @endforeach
                    <h5>ที่ปรึกษาร่วม</h5>
                    @foreach ($projects->advisers as $adviser)
                        @if ($adviser->id_position == 2)
                            <p>{{ $adviser->teacher->prefix . ' ' . $adviser->teacher->name . ' ' . $adviser->teacher->surname }}
                        @endif
                    @endforeach
                </div>
            </div>
            <hr>
            <div class="row gy-2">
                <div class="col-12">
                    <h3>บทความอื่นๆ</h3>
                </div>
            </div>
            <div class="row gy-2 justify-content-center">
                @foreach ($other_articles as $item)
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="post">
                            @if ($users->user_type == 'Admin')
                                <a href="{{ route('admin.detail.thesis', $item->id_dissertation_article) }}">
                                @elseif ($users->user_type == 'Branch head')
                                    <a href="{{ route('branch-head.detail.thesis', $item->id_dissertation_article) }}">
                                    @elseif ($users->user_type == 'Teacher')
                                        <a href="{{ route('teacher.detail.thesis', $item->id_dissertation_article) }}">
                                        @else
                                            <a
                                                href="{{ route('member.detail.thesis', $item->id_dissertation_article) }}">
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
        </div>
    </section>
</div>
