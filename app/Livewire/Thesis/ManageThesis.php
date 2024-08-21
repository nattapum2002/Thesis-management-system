<?php

// namespace App\Livewire\Thesis;

// use Livewire\Component;
// use App\Models\Dissertation_article;
// use App\Models\Member;
// use App\Models\Project;
// use App\Models\Student_project;
// use Illuminate\Support\Facades\Auth;
// use Livewire\WithPagination;

// class ManageThesis extends Component
// {
//     use WithPagination;

//     public $users;
//     public $search = '';
//     public $filterDate = 'บทความล่าสุด';
//     public $filterType = 'ทุกประเภท';
//     public $sortField = 'id_dissertation_article';
//     public $sortDirection = 'asc';

//     public function sortBy($field)
//     {
//         if ($this->sortField == $field) {
//             $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
//         } else {
//             $this->sortField = $field;
//             $this->sortDirection = 'asc';
//         }
//     }

//     protected $queryString = [
//         'search' => ['except' => ''],
//         'filterDate' => ['except' => 'ข่าวล่าสุด'],
//         'filterType' => ['except' => 'ทุกประเภท']
//     ];

//     public function show($index)
//     {
//         Dissertation_article::where('id_dissertation_article', $index)->update([
//             'status' => '0'
//         ]);
//         session()->flash('danger', 'ซ่อนบทความ ' . Dissertation_article::find($index)->title .  ' เรียบร้อยแล้ว');
//     }
//     public function hide($index)
//     {
//         Dissertation_article::where('id_dissertation_article', $index)->update([
//             'status' => '1'
//         ]);
//         session()->flash('success', 'แสดงบทความ ' . Dissertation_article::find($index)->title .  ' เรียบร้อยแล้ว');
//     }

//     public function mount()
//     {
//         if (Auth::guard('members')->check()) {
//             $this->users = Member::find(Auth::guard('members')->user()->id_student);
//         }
//     }

//     public function render()
//     {
//         $thesis = Dissertation_article::whereIn(
//             'id_project',
//             Student_project::where(
//                 'id_student',
//                 Auth::guard('members')->user()->id_student
//             )->pluck('id_project')
//         )
//             ->when($this->search, function ($query) {
//                 $query->where('title', 'like', '%' . $this->search . '%');
//             })
//             ->when($this->filterType != 'ทุกประเภท', function ($query) {
//                 $query->where('type', $this->filterType);
//             })
//             ->when($this->filterDate == 'บทความเก่าสุด', function ($query) {
//                 $query->orderBy('created_at', 'asc');
//             })
//             ->when($this->filterDate == 'บทความล่าสุด', function ($query) {
//                 $query->orderBy('created_at', 'desc');
//             })->orderBy($this->sortField, $this->sortDirection)
//             ->paginate(10);
//         $types = Dissertation_article::select('type')->distinct()->get();

//         return view('livewire.thesis.manage-thesis', ['thesis' => $thesis, 'types' => $types]);
//     }
// }

namespace App\Livewire\Thesis;

use Livewire\Component;
use App\Models\Dissertation_article;
use App\Models\Member;
use App\Models\Student_project;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ManageThesis extends Component
{
    use WithPagination;

    public $users, $search = '', $filterDate = 'บทความล่าสุด', $filterType = 'ทุกประเภท', $sortField = 'id_dissertation_article', $sortDirection = 'asc';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterDate' => ['except' => 'ข่าวล่าสุด'],
        'filterType' => ['except' => 'ทุกประเภท']
    ];

    public function mount()
    {
        $this->users = Auth::guard('members')->user();
    }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField == $field
            ? ($this->sortDirection == 'asc' ? 'desc' : 'asc')
            : 'asc';
        $this->sortField = $field;
    }

    public function toggleVisibility($index, $status)
    {
        Dissertation_article::where('id_dissertation_article', $index)
            ->update(['status' => $status]);

        $message = $status ? 'แสดงบทความ' : 'ซ่อนบทความ';
        session()->flash($status ? 'success' : 'danger', "{$message} " . Dissertation_article::find($index)->title . ' เรียบร้อยแล้ว');
    }

    public function render()
    {
        $studentId = Auth::guard('members')->user()->id_student;
        $projectIds = Student_project::where('id_student', $studentId)->pluck('id_project');

        $thesis = Dissertation_article::whereIn('id_project', $projectIds)
            ->when($this->search, fn($query) => $query->where('title', 'like', "%{$this->search}%"))
            ->when($this->filterType != 'ทุกประเภท', fn($query) => $query->where('type', $this->filterType))
            ->when($this->filterDate, fn($query) => $query->orderBy('created_at', $this->filterDate == 'บทความเก่าสุด' ? 'asc' : 'desc'))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        $types = Dissertation_article::select('type')->distinct()->get();

        return view('livewire.thesis.manage-thesis', compact('thesis', 'types'));
    }
}