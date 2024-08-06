<?php

namespace App\Livewire\News;

use Livewire\Component;
use App\Models\News;
use App\Models\Member;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class DetailNewsLogin extends Component
{
    public $users;
    public $news;

    public function mount($id)
    {
        $this->news = News::with('teacher')->find($id);

        if (Auth::guard('teachers')->check()) {
            $this->users = Teacher::find(Auth::guard('teachers')->user()->id_teacher);
        }
        if (Auth::guard('members')->check()) {
            $this->users = Member::find(Auth::guard('members')->user()->id_student);
        }
    }

    public function render()
    {
        $other_news = News::where('id_news', '!=', $this->news->id_news)->orderBy('created_at', 'desc')->paginate(4);
        return view('livewire.news.detail-news-login', ['other_news' => $other_news]);
    }
}
