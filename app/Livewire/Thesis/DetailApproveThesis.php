<?php

namespace App\Livewire\Thesis;

use App\Models\Dissertation_article;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithFileUploads;

class DetailApproveThesis extends Component
{
    use WithFileUploads;

    public $toggle = [
        'title' => false,
        'details' => false,
        'thesis_image' => false,
        'file_dissertation' => false,
        'year_published' => false,
        'type' => false,
        'status' => false,
        'project' => false
    ];

    public $thesis;
    public $thesisId;
    public $title;
    public $other_title;
    public $details;
    public $year_published;
    public $thesis_image;
    public $path_thesis_image;
    public $file_dissertation;
    public $path_thesis_file;
    public $type;
    public $other_type;
    public $status;
    public $users;

    protected function rules()
    {
        $rules = [];

        if ($this->toggle['thesis_image']) {
            $rules['thesis_image'] = 'required|image|max:2048';
        }

        if ($this->toggle['title']) {
            $rules['title'] = 'required';
            $rules['other_title'] = 'required_if:title,อื่นๆ';
        }

        if ($this->toggle['details']) {
            $rules['details'] = 'required';
        }

        if ($this->toggle['year_published']) {
            $rules['year_published'] = 'required';
        }

        if ($this->toggle['type']) {
            $rules['type'] = 'required';
            $rules['other_type'] = 'required_if:type,อื่นๆ';
        }

        if ($this->toggle['status']) {
            $rules['status'] = 'required';
        }

        if ($this->toggle['file_dissertation']) {
            $rules['file_dissertation'] = 'required|mimes:pdf';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'thesis_image.required' => 'กรุณาเลือกรูปภาพ',
            'thesis_image.image' => 'กรุณาเลือกรูปภาพ',
            'thesis_image.max' => 'กรุณาเลือกรูปภาพไม่เกิน 2MB',
            'title.required' => 'กรุณาเลือกโครงงาน',
            'other_title.required_if' => 'กรุณากรอกโครงงาน',
            'details.required' => 'กรุณากรอกบทคัดย่อ',
            'year_published.required' => 'กรุณาเลือกปีที่ต้องการ',
            'type.required' => 'กรุณาเลือกประเภท',
            'other_type.required_if' => 'กรุณากรอกประเภท',
            'status.required' => 'กรุณาเลือกสถานะ',
            'file_dissertation.required' => 'กรุณาเลือกไฟล์',
            'file_dissertation.mimes' => 'กรุณาเลือกไฟล์ pdf',
        ];
    }

    public function edit($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
    }

    public function save($index)
    {
        $this->validate();

        if ($index == 'thesis_image') {
            $this->path_thesis_image = $this->thesis_image->store('thesis_image', 'public');
            Dissertation_article::where('id_dissertation_article', $this->thesisId)->update([$index => $this->path_thesis_image], ['updated_at' => now()]);
        } else if ($index == 'thesis_file') {
            $this->path_thesis_file = $this->file_dissertation->store('thesis_file', 'public');
            Dissertation_article::where('id_dissertation_article', $this->thesisId)->update([$index => $this->path_thesis_file], ['updated_at' => now()]);
        } else if ($index == 'title') {
            if ($this->title == 'อื่นๆ') {
                Dissertation_article::where('id_dissertation_article', $this->thesisId)->update([$index => $this->other_title], ['updated_at' => now()]);
            } else {
                Dissertation_article::where('id_dissertation_article', $this->thesisId)->update([$index => $this->title], ['updated_at' => now()]);
            }
        } else if ($index == 'type' && $this->type == 'อื่นๆ') {
            Dissertation_article::where('id_dissertation_article', $this->thesisId)->update([$index => $this->other_type], ['updated_at' => now()]);
        } else {
            Dissertation_article::where('id_dissertation_article', $this->thesisId)->update([$index => $this->$index], ['updated_at' => now()]);
        }
        session()->flash('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        $this->cancel($index);
    }

    public function cancel($index)
    {
        $this->reset('type', 'status', 'title', 'year_published');
        $this->toggle[$index] = !$this->toggle[$index];
        $this->mount($this->thesisId);
    }

    public function mount($id)
    {
        $this->thesis = Dissertation_article::find($id);
        $this->thesisId = $this->thesis->id_dissertation_article;
        $this->title = $this->thesis->title;
        $this->other_title = $this->thesis->title;
        $this->details = $this->thesis->details;
        $this->year_published = $this->thesis->year_published;
        $this->path_thesis_image = $this->thesis->thesis_image;
        $this->path_thesis_file = $this->thesis->file_dissertation;
        $this->type = $this->thesis->type;
        $this->other_type = $this->thesis->type;
        $this->status = $this->thesis->status;
    }
    public function render()
    {
        $projects = Project::get();
        $types = Dissertation_article::select('type')->distinct()->get();

        return view('livewire.thesis.detail-approve-thesis', [
            'thesis' => $this->thesis->refresh(),
            'projects' => $projects,
            'types' => $types
        ]);
    }
}