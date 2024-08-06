<?php

namespace App\Livewire\News;

use App\Models\News;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class AddNews extends Component
{
    use WithFileUploads;

    public $add_title;
    public $add_detail;
    public $add_news_image;
    public $path_news_image;
    public $add_type;
    public $add_status;

    public function add()
    {
        if ($this->add_news_image == !null) {
            $this->path_news_image = $this->add_news_image->store('news_image', 'public');
        }

        News::create([
            'title' => $this->add_title,
            'details' => $this->add_detail,
            'news_image' => $this->path_news_image,
            'type' => $this->add_type,
            'status' => $this->add_status,
            'id_teacher' => Auth::guard('teachers')->user()->id_teacher,
            'created_by' => Auth::guard('teachers')->user()->id_teacher,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        session()->flash('message', 'เพิ่มข่าวสารเรียบร้อยแล้ว');
        return redirect()->route('manage_news');
    }

    public function cancel()
    {
        $this->reset();
        return redirect()->route('manage_news');
    }

    public function render()
    {
        return view('livewire.news.add-news');
    }
}
