<?php

namespace App\Livewire\News;

use App\Models\News;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DetailApproveNews extends Component
{
    use WithFileUploads;

    public $toggle = [
        'title' => false,
        'details' => false,
        'news_image' => false,
        'type' => false,
        'status' => false
    ];

    public $users;
    public $news;
    public $newsId;
    public $title;
    public $details;
    public $news_image;
    public $path_news_image;
    public $type;
    public $status;
    public function edit($index)
    {
        $this->toggle[$index] = !$this->toggle[$index];
    }

    public function save($index)
    {
        if ($index == 'news_image') {
            $this->path_news_image = $this->news_image->storeAs('news_image', $this->news_image->getClientOriginalName(), 'public');
            DB::table('news')->where('id_news', $this->newsId)->update([$index => $this->path_news_image], ['updated_by' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);
        } else {
            DB::table('news')->where('id_news', $this->newsId)->update([$index => $this->$index], ['updated_by' => Auth::guard('teachers')->user()->id_teacher], ['updated_at' => now()]);
        }
        session()->flash('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        $this->cancel($index);
    }

    public function cancel($index)
    {
        $this->reset('type', 'status');
        $this->toggle[$index] = !$this->toggle[$index];
        $this->mount($this->newsId);
    }

    public function mount($id)
    {
        $this->news = News::find($id);
        $this->newsId = $this->news->id_news;
        $this->title = $this->news->title;
        $this->details = $this->news->details;
        $this->path_news_image = $this->news->news_image;
        $this->type = $this->news->type;
        $this->status = $this->news->status;
    }

    public function render()
    {
        return view('livewire.news.detail-approve-news', [
            'news' => $this->news->refresh()
        ]);
    }
}
