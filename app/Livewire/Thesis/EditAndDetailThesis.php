<?php

// namespace App\Livewire\Thesis;

// use App\Models\Dissertation_article;
// use App\Models\Project;
// use Livewire\Component;
// use Livewire\WithFileUploads;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Auth;

// class EditAnddetailThesis extends Component
// {
//     use WithFileUploads;

//     public $toggle = [
//         'title' => false,
//         'details' => false,
//         'thesis_image' => false,
//         'file_dissertation' => false,
//         'year_published' => false,
//         'type' => false,
//         'status' => false,
//         'project' => false
//     ];

//     public $thesis;
//     public $thesisId;
//     public $title;
//     public $details;
//     public $year_published;
//     public $thesis_image;
//     public $path_thesis_image;
//     public $file_dissertation;
//     public $path_thesis_file;
//     public $type, $other_type;
//     public $status;
//     public $users;
//     public function edit($index)
//     {
//         $this->toggle[$index] = !$this->toggle[$index];
//     }

//     public function rules()
//     {
//         return [
//             'thesis_image' => 'required',
//             'title' => 'required',
//             'details' => 'required',
//             'year_published' => 'required',
//             'type' => 'required',
//             'other_type' => 'required_if:type,อื่นๆ',
//             'status' => 'required',
//             'file_dissertation' => 'required|mimes:pdf',
//         ];
//     }

//     public function messages()
//     {
//         return [
//             'details.required' => 'กรุณากรอกบทคัดย่อ',
//             'title.required' => 'กรุณาเลือกโครงงาน',
//             'year_published.required' => 'กรุณาเลือกปีที่ต้องการ',
//             'type.required' => 'กรุณาเลือกประเภท',
//             'other_type.required_if' => 'กรุณากรอกประเภท',
//             'status.required' => 'กรุณาเลือกสถานะ',
//             'thesis_image.required' => 'กรุณาเลือกรูปภาพ',
//             'file_dissertation.required' => 'กรุณาเลือกไฟล์',
//             'file_dissertation.mimes' => 'กรุณาเลือกไฟล์ pdf',
//         ];
//     }

//     public function save($index)
//     {
//         // $this->validate();

//         if ($this->thesis_image) {
//             $this->path_thesis_image = $this->thesis_image->store('thesis_image', 'public');
//         }
//         if ($this->file_dissertation) {
//             $this->path_thesis_file = $this->file_dissertation->store('thesis_file', 'public');
//         }
//         if ($this->type == 'อื่นๆ') {
//             $this->type = $this->other_type;
//         }

//         if ($index == 'thesis_image') {
//             $this->path_thesis_image = $this->thesis_image->store('thesis_image', 'public');
//             Dissertation_article::where('id_dissertation_article', $this->thesisId)->update([$index => $this->path_thesis_image], ['updated_at' => now()]);
//         } else if ($index == 'file_dissertation') {
//             $this->path_thesis_file = $this->file_dissertation->store('thesis_file', 'public');
//             Dissertation_article::where('id_dissertation_article', $this->thesisId)->update([$index => $this->path_thesis_file], ['updated_at' => now()]);
//         } else if ($index == 'title') {
//             Dissertation_article::where('id_dissertation_article', $this->thesisId)->update([$index => Project::where('id_project', $this->$index)->value('project_name_th')], ['updated_at' => now()]);
//         } else {
//             Dissertation_article::where('id_dissertation_article', $this->thesisId)->update([$index => $this->$index], ['updated_at' => now()]);
//         }
//         session()->flash('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
//         $this->cancel($index);
//     }

//     public function cancel($index)
//     {
//         $this->reset('type', 'status');
//         $this->toggle[$index] = !$this->toggle[$index];
//         $this->mount($this->thesisId);
//     }

//     public function mount($id)
//     {
//         $this->thesis = Dissertation_article::find($id);
//         $this->thesisId = $this->thesis->id_dissertation_article;
//         $this->title = $this->thesis->title;
//         $this->details = $this->thesis->details;
//         $this->year_published = $this->thesis->year_published;
//         $this->path_thesis_image = $this->thesis->thesis_image;
//         $this->path_thesis_file = $this->thesis->file_dissertation;
//         $this->type = $this->thesis->type;
//         $this->status = $this->thesis->status;
//     }
//     public function render()
//     {
//         $projects = Project::with('membersProject')
//             ->whereHas('membersProject', function ($query) {
//                 $query->where('id_student', Auth::guard('members')->user()->id_student);
//             })
//             ->get();
//         $types = Dissertation_article::select('type')->distinct()->get();
//         return view('livewire.thesis.edit-and-detail-thesis', [
//             'thesis' => $this->thesis->refresh(),
//             'projects' => $projects,
//             'types' => $types
//         ]);
//     }
// }

namespace App\Livewire\Thesis;

use App\Models\Dissertation_article;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class EditAnddetailThesis extends Component
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

    public $thesis, $thesisId, $title, $details, $year_published, $thesis_image, $path_thesis_image, $file_dissertation, $path_thesis_file, $type, $other_type, $status, $users;

    public function edit($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
    }

    protected function uploadFile($index, $path)
    {
        return $this->$index ? $this->$index->store($path, 'public') : null;
    }

    protected function updateThesis($index, $value)
    {
        Dissertation_article::where('id_dissertation_article', $this->thesisId)->update([$index => $value], ['updated_at' => now()]);
    }

    protected function rules()
    {
        return [
            // 'thesis_image' => 'required',
            'title' => 'required',
            'details' => 'required',
            'year_published' => 'required',
            'type' => 'required',
            'other_type' => 'required_if:type,อื่นๆ',
            'status' => 'required',
            // 'file_dissertation' => 'required|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'thesis_image.required' => 'กรุณาเลือกรูปภาพ',
            'title.required' => 'กรุณาเลือกโครงงาน',
            'details.required' => 'กรุณากรอกบทคัดย่อ',
            'year_published.required' => 'กรุณาเลือกปีที่ต้องการ',
            'type.required' => 'กรุณาเลือกประเภท',
            'other_type.required_if' => 'กรุณากรอกประเภท',
            'status.required' => 'กรุณาเลือกสถานะ',
            'file_dissertation.required' => 'กรุณาเลือกไฟล์',
            'file_dissertation.mimes' => 'กรุณาเลือกไฟล์ pdf',
        ];
    }

    public function save($index)
    {
        $this->validate();
        if ($index === 'thesis_image') {
            $this->path_thesis_image = $this->uploadFile('thesis_image', 'thesis_image');
        } elseif ($index === 'file_dissertation') {
            $this->path_thesis_file = $this->uploadFile('file_dissertation', 'thesis_file');
        } elseif ($index === 'title') {
            $value = Project::where('id_project', $this->title)->value('project_name_th');
            $this->updateThesis($index, $value);
            return;
        } else {
            if ($this->type == 'อื่นๆ') {
                $this->type = $this->other_type;
            }
            $this->updateThesis($index, $this->$index);
        }
        session()->flash('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        $this->cancel($index);
    }

    public function cancel($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
        $this->mount($this->thesisId);
    }

    public function mount($id)
    {
        $this->thesis = Dissertation_article::find($id);
        $this->thesisId = $this->thesis->id_dissertation_article;
        $this->title = $this->thesis->title;
        $this->details = $this->thesis->details;
        $this->year_published = $this->thesis->year_published;
        $this->path_thesis_image = $this->thesis->thesis_image;
        $this->path_thesis_file = $this->thesis->file_dissertation;
        $this->type = $this->thesis->type;
        $this->status = $this->thesis->status;
    }

    public function render()
    {
        $projects = Project::with('membersProject')
            ->whereHas('membersProject', fn($query) => $query->where('id_student', Auth::guard('members')->user()->id_student))
            ->get();
        $types = Dissertation_article::select('type')->distinct()->get();

        return view('livewire.thesis.edit-and-detail-thesis', [
            'thesis' => $this->thesis->refresh(),
            'projects' => $projects,
            'types' => $types
        ]);
    }
}