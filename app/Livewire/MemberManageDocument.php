<?php

namespace App\Livewire;

use App\Models\Confirm_student;
use App\Models\Confirm_teacher;
use App\Models\Document_submission_schedule;
use App\Models\Project;
use App\Models\Teacher;
use App\Services\LineMessageService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MemberManageDocument extends Component
{

    use WithPagination;
    public $search;
    public function confirmDocument($document_id, $project_id)
    {
        Confirm_student::where('id_document', $document_id)
            ->where('id_student', Auth::guard('members')->user()->id_student)
            ->where('id_project', $project_id)
            ->update([
                'confirm_status' => true
            ]);

        $teacherIds = Confirm_teacher::where('id_document', $document_id)
            ->where('id_project', $project_id)
            ->whereIn('id_position', [1, 2])
            ->pluck('id_teacher');

        $teachers = Teacher::whereIn('id_teacher', $teacherIds)->get();

        $allConfirmed = !Confirm_student::where('id_document', $document_id)
            ->where('id_project', $project_id)
            ->where('confirm_status', 0)
            ->exists();

        $message = 'นักศึกษาได้ส่งเอกสาร คกท.-คง.-0' . $document_id . ' เพื่อขอการอนุมัติ กรุณาตรวจสอบข้อมูลและดำเนินการในขั้นตอนต่อไป';

        if ($allConfirmed) {
            foreach ($teachers as $teacher) {
                if (!empty($teacher->id_line)) { // ตรวจสอบว่ามีค่า id_line
                    $userId = $teacher->id_line;

                    // ตรวจสอบรูปแบบของ userId ถ้าจำเป็น (อาจใช้ regular expression หรือวิธีอื่น)
                    if (preg_match('/^U[a-fA-F0-9]{32}$/', $userId)) {
                        LineMessageService::sendMessage($userId, $message);
                    }
                }
            }
        }
    }
    public function render()
    {
        $search = $this->search;
        $projects = Project::with([
            'confirmStudents.student',
            'confirmStudents.documents',
            'confirmTeachers.teacher',
            'confirmTeachers.document'
        ])
            ->whereHas('confirmStudents', function ($query) {
                $query->where('id_student', Auth::guard('members')->user()->id_student);
            })
            ->where(function ($query) use ($search) {
                $query->where('project_name_th', 'like', '%' . $search . '%')
                    ->orWhere('project_name_en', 'like', '%' . $search . '%');
            })
            ->paginate(1);

        $document_time = Document_submission_schedule::where('status', true)->get();
        // dd($projects);
        return view('livewire.member-manage-document', ['projects' => $projects, 'document_time' => $document_time]);
    }
}
