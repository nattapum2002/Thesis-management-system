<?php

namespace App\Livewire\Thesis;

use App\Models\Dissertation_article;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class AddThesis extends Component
{
    use WithFileUploads;

    public $add_detail, $add_thesis_image, $path_thesis_image, $add_thesis_file, $path_thesis_file, $add_year, $add_type, $add_other_type, $add_status, $add_project, $add_project_th, $add_project_en;

    protected function rules()
    {
        $rules = [
            'add_detail' => 'required',
            'add_year' => 'required',
            'add_type' => 'required',
            'add_other_type' => 'required_if:add_type,อื่นๆ',
            'add_status' => 'required',
            'add_thesis_image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'add_thesis_file' => 'required|mimes:pdf|max:12288',
        ];

        if (Auth::guard('teachers')->check()) {
            $rules['add_project_th'] = 'required';
            $rules['add_project_en'] = 'required';
        } else {
            $rules['add_project'] = 'required';
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'add_project.required' => 'กรุณาเลือกโครงงาน',
            'add_project_th.required' => 'กรุณากรอกชื่อบทความภาษาไทย',
            'add_project_en.required' => 'กรุณากรอกชื่อบทความภาษาอังกฤษ',
            'add_detail.required' => 'กรุณากรอกข้อมูลให้ครบ',
            'add_year.required' => 'กรุณาเลือกปีที่ต้องการ',
            'add_type.required' => 'กรุณาเลือกประเภท',
            'add_other_type.required_if' => 'กรุณากรอกประเภท',
            'add_status.required' => 'กรุณาเลือกสถานะ',
            'add_thesis_image.mimes' => 'กรุณาเลือกไฟล์ภาพ jpg, jpeg, png',
            'add_thesis_image.max' => 'กรุณาเลือกไฟล์ภาพไม่เกิน 2MB',
            'add_thesis_file.required' => 'กรุณาเลือกไฟล์',
            'add_thesis_file.mimes' => 'กรุณาเลือกไฟล์ pdf',
            'add_thesis_file.max' => 'กรุณาเลือกไฟล์ไม่เกิน 12MB',
        ];
    }

    protected function uploadFile($field, $path)
    {
        return $this->$field ? $this->$field->storeAs($path, $this->$field->getClientOriginalName(), 'public') : null;
    }

    public function add()
    {
        $this->validate();

        $this->path_thesis_image = $this->uploadFile('add_thesis_image', 'thesis_image');
        $this->path_thesis_file = $this->uploadFile('add_thesis_file', 'thesis_file');

        if (Auth::guard('teachers')->check()) {
            Project::create([
                'project_name_th' => $this->add_project_th,
                'project_name_en' => $this->add_project_en,
                'project_status' => 'Import',
                'created_by' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $id_project = Project::where('project_name_th', $this->add_project_th)
                ->where('project_name_en', $this->add_project_en)
                ->where('project_status', 'Import')
                ->value('id_project');
            $title = $this->add_project;
        } else {
            $id_project = $this->add_project;
            $title = Project::where('id_project', $this->add_project)->value('project_name_th');
        }

        Dissertation_article::create([
            'title' => $title,
            'details' => $this->add_detail,
            'thesis_image' => $this->path_thesis_image,
            'file_dissertation' => $this->path_thesis_file,
            'year_published' => $this->add_year,
            'type' => $this->add_type === 'อื่นๆ' ? $this->add_other_type : $this->add_type,
            'status' => $this->add_status,
            'id_project' => $id_project,
            'created_by' => null, //Auth::guard('members')->user()->id_student,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        session()->flash('message', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
        $this->cancel();
    }

    public function cancel()
    {
        $this->reset();
        if (Auth::guard('teachers')->check()) {
            return redirect()->route('admin.approve.thesis');
        } else {
            return redirect()->route('member.manage.thesis');
        }
    }

    public function render()
    {
        if (Auth::guard('teachers')->check()) {
            $types = Dissertation_article::select('type')->where('status', '1')->distinct()->get();

            return view('livewire.thesis.add-thesis', ['types' => $types]);
        } else {
            $projects = Project::with('membersProject')
                ->whereHas('membersProject', fn($query) => $query->where('id_student', Auth::guard('members')->user()->id_student))
                ->get();
            $types = Dissertation_article::select('type')->where('status', '1')->distinct()->get();

            return view('livewire.thesis.add-thesis', ['projects' => $projects, 'types' => $types]);
        }
    }
}
