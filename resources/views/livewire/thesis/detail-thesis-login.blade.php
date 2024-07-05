<div>
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
</div>