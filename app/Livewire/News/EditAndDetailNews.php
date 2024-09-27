<?php

namespace App\Livewire\News;

use App\Models\{Member, News, Teacher};
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EditAndDetailNews extends Component
{
    use WithFileUploads;

    public $toggle = [
        'title' => false,
        'details' => false,
        'news_image' => false,
        'type' => false,
        'status' => false
    ];

    public $users, $news, $newsId, $title, $details, $news_image, $path_news_image, $type, $status;

    protected function rules()
    {
        $rules = [];

        if ($this->toggle['news_image']) {
            $rules['news_image'] = 'required|mimes:jpg,jpeg,png|max:2048';
        }

        if ($this->toggle['title']) {
            $rules['title'] = 'required';
        }

        if ($this->toggle['details']) {
            $rules['details'] = 'required';
        }

        if ($this->toggle['type']) {
            $rules['type'] = 'required';
        }

        if ($this->toggle['status']) {
            $rules['status'] = 'required';
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'title.required' => 'กรุณากรอกข้อมูลให้ครบ',
            'details.required' => 'กรุณากรอกข้อมูลให้ครบ',
            'news_image.required' => 'กรุณาเลือกไฟล์ภาพ',
            'news_image.mimes' => 'กรุณาเลือกไฟล์รูปภาพ jpg, jpeg, png',
            'news_image.max' => 'ไฟล์รูปภาพต้องไม่เกิน 2 MB',
            'type.required' => 'กรุณาเลือกประเภท',
            'status.required' => 'กรุณาเลือกสถานะ',
        ];
    }

    public function edit($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
    }

    public function save($index)
    {
        $this->validate();

        $this->path_news_image = $this->news_image->storeAs('news_image', $this->news_image->getClientOriginalName(), 'public');

        if ($index == 'news_image') {
            DB::table('news')->where('id_news', $this->newsId)->update([$index => $this->path_news_image], ['updated_by' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);
        } else {
            DB::table('news')->where('id_news', $this->newsId)->update([$index => $this->$index], ['updated_by' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);
        }
        session()->flash('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        $this->cancel($index);
    }

    public function cancel($index)
    {
        $this->reset('title', 'details', 'news_image', 'type', 'status');
        $this->toggle[$index] = !$this->toggle[$index];
        $this->mount($this->newsId);
    }

    public function mount($id)
    {
        $this->news = News::find($id);
        $this->newsId = $this->news->id_news;
        $this->title = $this->news->title;
        $this->details = $this->news->details;
        $this->news_image = $this->news->news_image;
        $this->type = $this->news->type;
        $this->status = $this->news->status;

        $this->users = Auth::guard('teachers')->check()
            ? Teacher::find(Auth::guard('teachers')->id())
            : Member::find(Auth::guard('members')->id());
    }

    public function render()
    {
        return view('livewire.news.edit-and-detail-news', [
            'news' => $this->news->refresh()
        ]);
    }
}
