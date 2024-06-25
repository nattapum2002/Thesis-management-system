<div>
    <h2>กำหนดคณะกรรมกรรมการ</h2>

    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <form wire:submit.prevent="assignDirector">
        <div>
            <label for="selectedTeacher">Select Teacher:</label>
            <select wire:model="selectedTeacher" id="selectedTeacher">
                <option value="">-- Select Teacher --</option>
                @foreach ($teachers as $teacher)
                <option value="{{ $teacher->id_teacher }}">{{ $teacher->name }} {{ $teacher->surname }}</option>
                @endforeach
            </select>
            @error('selectedTeacher') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="selectedProject">Select Project:</label>
            <select wire:model="selectedProject" id="selectedProject">
                <option value="">-- Select Project --</option>
                @foreach ($projects as $project)
                <option value="{{ $project->id_project }}">{{ $project->project_name_th }} {{ $project->project_status
                    }}</option>
                @endforeach
            </select>
            @error('selectedProject') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="selectedDocument">Select Document:</label>
            <select wire:model="selectedDocument" id="selectedDocument">
                <option value="">-- Select Document --</option>
                @foreach ($documents as $document)
                <option value="{{ $document->id_document }}">{{ $document->document }}</option>
                @endforeach
            </select>
            @error('selectedDocument') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="selectedPosition">Select Position:</label>
            <select wire:model="selectedPosition" id="selectedPosition">
                <option value="">-- Select Position --</option>
                @foreach ($positions as $position)
                <option value="{{ $position->id_position }}">{{ $position->position }}</option>
                @endforeach
            </select>
            @error('selectedPosition') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-2">
            <button type="reset" class="btn btn-danger">ยกเลิก</button>
            <button type="submit" class="btn btn-success">บันทึก</button>
        </div>
    </form>
</div>