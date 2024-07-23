<?php

namespace App\Livewire\Admin;

use App\Models\Adviser;
use App\Models\Confirm_teacher;
use App\Models\Director;
use App\Models\Dissertation_article;
use App\Models\Member;
use App\Models\News;
use App\Models\Project;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $projects = Project::with(['members', 'teachers', 'advisers'])->get();
        $members = Member::with(['level', 'course', 'projects'])->get();
        $teachers = Teacher::with(['news', 'projects'])->get();
        $thesis = Dissertation_article::with(['project'])->get();
        $news = News::with(['teacher'])->get();
        $advisers = Adviser::with(['project', 'teacher', 'position'])->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)->get();
        $directors = Director::with(['project', 'teacher', 'position'])->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)->get();
        $confirms = Confirm_teacher::with(['project', 'teacher', 'position'])->where('id_teacher', Auth::guard('teachers')->user()->id_teacher)->get();
        return view('livewire.admin.dashboard', [
            'projects' => $projects,
            'members' => $members,
            'teachers' => $teachers,
            'advisers' => $advisers,
            'directors' => $directors,
            'confirms' => $confirms,
            'thesis' => $thesis,
            'news' => $news
        ]);
    }
}
