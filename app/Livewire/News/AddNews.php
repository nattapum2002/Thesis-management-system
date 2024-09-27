<?php

namespace App\Livewire\News;

use App\Models\News;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class AddNews extends Component
{
    use WithFileUploads;

    public $add_title, $add_detail, $add_news_image, $path_news_image, $add_type, $add_status;

    protected function rules()
    {
        return [
            'add_title' => 'required',
            'add_detail' => 'required',
            'add_type' => 'required',
            'add_status' => 'required',
            'add_news_image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    protected function messages()
    {
        return [
            'add_title.required' => 'กรุณากรอกข้อมูลให้ครบ',
            'add_detail.required' => 'กรุณากรอกข้อมูลให้ครบ',
            'add_type.required' => 'กรุณาเลือกประเภท',
            'add_status.required' => 'กรุณาเลือกสถานะ',
            'add_news_image.mimes' => 'กรุณาเลือกไฟล์รูปภาพ jpg, jpeg, png',
            'add_news_image.max' => 'ไฟล์รูปภาพต้องไม่เกิน 2 MB',
        ];
    }

    public function add()
    {
        $this->validate();

        $this->path_news_image = $this->add_news_image
            ? $this->add_news_image->storeAs('news_image', $this->add_news_image->getClientOriginalName(), 'public')
            : null;

        News::create([
            'title' => $this->add_title,
            'details' => $this->add_detail,
            'news_image' => $this->path_news_image,
            'type' => $this->add_type,
            'status' => $this->add_status,
            'id_teacher' => Auth::guard('teachers')->id(),
            'created_by' => Auth::guard('teachers')->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->flash('message', 'เพิ่มข่าวสารเรียบร้อยแล้ว');
        $this->cancel();
    }

    public function cancel()
    {
        $this->reset();
        $routes = [
            'Branch head' => 'branch-head.manage.news',
            'Admin' => 'admin.manage.news',
            'default' => 'teacher.manage.news',
        ];
        return redirect()->route($routes[Auth::guard('teachers')->user()->user_type] ?? $routes['default']);
    }

    public function render()
    {
        return view('livewire.news.add-news');
    }
}
