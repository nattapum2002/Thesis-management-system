<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Teacher;
use App\Models\Comment;
use App\Models\Confirm_teacher;
use App\Models\Director;
use App\Models\Exam_schedule;
use App\Models\Score;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

//ปัญหาไม่สามารถเลือกวันที่ได้

class pdfGenerateController extends Controller
{

    private function generatePDF($documentId, $data)
    {
        $html = view($documentId, $data)->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream();
    }

    public function pdf01Generate($projectID)
    {
        $documentId = 1;
        $admins = Teacher::where('user_type', 'Admin')->get();
        $branchHeads = Teacher::where('user_type', 'Branch head')->get();

        $comments = Comment::with([
            'project',
            'document',
            'commentList',
            'teacher',
            'position'
        ])->where('id_project', $projectID)->orderBy('created_at', 'asc')->get();

        $projects = Project::with([
            'members.course',
            'members.level',
            'teachers',
            'confirmStudents.student',
            'confirmStudents.documents',
            'confirmTeachers.teacher',
            'confirmTeachers.document'
        ])->find($projectID);

        if (!$projects) {
            abort(404, 'Project not found.');
        }

        return $this->generatePDF('pdf.document01', [
            'projects' => $projects,
            'admins' => $admins,
            'branchHeads' => $branchHeads,
            'comments' => $comments,
            'documentId' => $documentId
        ]);
    }

    public function pdf02Generate($projectID)
    {
        $documentId = 2;
        $admins = Teacher::where('user_type', 'Admin')->get();
        $branchHeads = Teacher::where('user_type', 'Branch head')->get();
        $examSchedules = Exam_schedule::with([
            'project',
            'teacher',
            'document'
        ])->where('id_project', $projectID)
            ->where('id_document', $documentId)
            ->orderBy('created_at', 'asc')->get();

        $directors = Director::with([
            'project',
            'document',
            'teacher',
            'position'
        ])->where('id_project', $projectID)
            ->where('id_document', $documentId)->get();

        $comments = Comment::with([
            'project',
            'document',
            'commentList',
            'teacher',
            'position'
        ])->where('id_project', $projectID)->orderBy('created_at', 'asc')->get();

        $projects = Project::with([
            'members.course',
            'members.level',
            'teachers',
            'confirmStudents.student',
            'confirmStudents.documents',
            'confirmTeachers.teacher',
            'confirmTeachers.document'
        ])->find($projectID);

        if (!$projects) {
            abort(404, 'Project not found.');
        }

        return $this->generatePDF('pdf.document02', [
            'projects' => $projects,
            'admins' => $admins,
            'branchHeads' => $branchHeads,
            'comments' => $comments,
            'examSchedules' => $examSchedules,
            'directors' => $directors,
            'documentId' => $documentId
        ]);
    }

    public function pdf03Generate($projectID)
    {
        $documentId = 3;
        $admins = Teacher::where('user_type', 'Admin')->get();
        $branchHeads = Teacher::where('user_type', 'Branch head')->get();
        $examSchedules = Exam_schedule::with([
            'project',
            'teacher',
            'document'
        ])->where('id_project', $projectID)
            ->where('id_document', $documentId)
            ->orderBy('created_at', 'asc')->get();

        $directors = Director::with([
            'project',
            'document',
            'teacher',
            'position'
        ])->where('id_project', $projectID)
            ->where('id_document', $documentId)->get();

        $comments = Comment::with([
            'project',
            'document',
            'commentList',
            'teacher',
            'position'
        ])->where('id_project', $projectID)->orderBy('created_at', 'asc')->get();

        $projects = Project::with([
            'members.course',
            'members.level',
            'teachers',
            'confirmStudents.student',
            'confirmStudents.documents',
            'confirmTeachers.teacher',
            'confirmTeachers.document'
        ])->find($projectID);

        if (!$projects) {
            abort(404, 'Project not found.');
        }

        return $this->generatePDF('pdf.document03', [
            'projects' => $projects,
            'admins' => $admins,
            'branchHeads' => $branchHeads,
            'comments' => $comments,
            'examSchedules' => $examSchedules,
            'directors' => $directors,
            'documentId' => $documentId
        ]);
    }

    public function pdf04Generate($projectID)
    {
        $documentId = 4;
        $admins = Teacher::where('user_type', 'Admin')->get();
        $branchHeads = Teacher::where('user_type', 'Branch head')->get();
        $examSchedules = Exam_schedule::with([
            'project',
            'teacher',
            'document'
        ])->where('id_project', $projectID)
            ->where('id_document', $documentId)
            ->orderBy('created_at', 'asc')->get();

        $directors = Director::with([
            'project',
            'document',
            'teacher',
            'position'
        ])->where('id_project', $projectID)
            ->where('id_document', $documentId)->get();

        $comments = Comment::with([
            'project',
            'document',
            'commentList',
            'teacher',
            'position'
        ])->where('id_project', $projectID)->orderBy('created_at', 'asc')->get();

        $projects = Project::with([
            'members.course',
            'members.level',
            'teachers',
            'confirmStudents.student',
            'confirmStudents.documents',
            'confirmTeachers.teacher',
            'confirmTeachers.document'
        ])->find($projectID);

        if (!$projects) {
            abort(404, 'Project not found.');
        }

        return $this->generatePDF('pdf.document04', [
            'projects' => $projects,
            'admins' => $admins,
            'branchHeads' => $branchHeads,
            'comments' => $comments,
            'examSchedules' => $examSchedules,
            'directors' => $directors,
            'documentId' => $documentId
        ]);
    }

    public function pdf05Generate($projectID)
    {
        $documentId = 5;
        $admins = Teacher::where('user_type', 'Admin')->get();
        $branchHeads = Teacher::where('user_type', 'Branch head')->get();
        $examSchedules = Exam_schedule::with([
            'project',
            'teacher',
            'document'
        ])->where('id_project', $projectID)
            ->where('id_document', $documentId)
            ->orderBy('created_at', 'asc')->get();

        $directors = Director::with([
            'project',
            'document',
            'teacher',
            'position'
        ])->where('id_project', $projectID)
            ->where('id_document', $documentId)->get();

        $comments = Comment::with([
            'project',
            'document',
            'commentList',
            'teacher',
            'position'
        ])->where('id_project', $projectID)->orderBy('created_at', 'asc')->get();
        $projects = Project::with([
            'members.course',
            'members.level',
            'teachers',
            'confirmStudents.student',
            'confirmStudents.documents',
            'confirmTeachers.teacher',
            'confirmTeachers.document'
        ])->find($projectID);

        if (!$projects) {
            abort(404, 'Project not found.');
        }

        return $this->generatePDF('pdf.document05', [
            'projects' => $projects,
            'admins' => $admins,
            'branchHeads' => $branchHeads,
            'comments' => $comments,
            'examSchedules' => $examSchedules,
            'directors' => $directors,
            'documentId' => $documentId
        ]);
    }

    public function pdf06Generate($projectID)
    {
        $documentId = 6;
        $admins = Teacher::where('user_type', 'Admin')->get();
        $branchHeads = Teacher::where('user_type', 'Branch head')->get();
        $examSchedules = Exam_schedule::with([
            'project',
            'teacher',
            'document'
        ])->where('id_project', $projectID)
            ->where('id_document', $documentId)
            ->orderBy('created_at', 'asc')->get();

        $directors = Director::with([
            'project',
            'document',
            'teacher',
            'position'
        ])->where('id_project', $projectID)
            ->where('id_document', $documentId)->get();

        $comments = Comment::with([
            'project',
            'document',
            'commentList',
            'teacher',
            'position'
        ])->where('id_project', $projectID)->orderBy('created_at', 'asc')->get();

        $scores = Score::with([
            'student',
            'document',
            'commentList',
            'teacher',
            'position'
        ])->where('id_document', $documentId)
            ->where('id_position', 3)->get();

        $projects = Project::with([
            'members.course',
            'members.level',
            'teachers',
            'confirmStudents.student',
            'confirmStudents.documents',
            'confirmTeachers.teacher',
            'confirmTeachers.document'
        ])->find($projectID);

        if (!$projects) {
            abort(404, 'Project not found.');
        }

        return $this->generatePDF('pdf.document06', [
            'projects' => $projects,
            'admins' => $admins,
            'branchHeads' => $branchHeads,
            'comments' => $comments,
            'examSchedules' => $examSchedules,
            'directors' => $directors,
            'scores' => $scores,
            'documentId' => $documentId
        ]);
    }

    public function pdf07Generate($projectID)
    {
        $documentId = 7;
        $admins = Teacher::where('user_type', 'Admin')->get();
        $branchHeads = Teacher::where('user_type', 'Branch head')->get();
        $examSchedules = Exam_schedule::with([
            'project',
            'teacher',
            'document'
        ])->where('id_project', $projectID)
            ->where('id_document', $documentId)
            ->orderBy('created_at', 'asc')->get();

        $directors = Director::with([
            'project',
            'document',
            'teacher',
            'position'
        ])->where('id_project', $projectID)
            ->where('id_document', $documentId)->get();
        $comments = Comment::with([
            'project',
            'document',
            'commentList',
            'teacher',
            'position'
        ])->where('id_project', $projectID)->orderBy('created_at', 'asc')->get();
        $projects = Project::with([
            'members.course',
            'members.level',
            'teachers',
            'confirmStudents.student',
            'confirmStudents.documents',
            'confirmTeachers.teacher',
            'confirmTeachers.document'
        ])->find($projectID);

        if (!$projects) {
            abort(404, 'Project not found.');
        }

        return $this->generatePDF('pdf.document07', [
            'projects' => $projects,
            'admins' => $admins,
            'branchHeads' => $branchHeads,
            'comments' => $comments,
            'examSchedules' => $examSchedules,
            'directors' => $directors,
            'documentId' => $documentId
        ]);
    }

    public function pdf03ScoreGenerate($projectID)
    {
        $documentId = 3;
        $project = Project::with([
            'confirmStudents' => function ($query) {
                $query->where('id_document', 3)
                    ->where('id_project', 11);
            },
            'confirmStudents.student',
            'confirmStudents.documents',
            'confirmTeachers' => function ($query) {
                $query->where('id_document', 3)
                    ->where('id_project', 11);
            },
            'confirmTeachers.teacher',
            'confirmTeachers.document'
        ]) ->whereHas('confirmTeachers', function($query) {
            $query->where('id_document', 3)->where('id_project', 11);
        })
            ->get();

        $scores = Score::with([
                'student',
                'document',
                'commentList',
                'teacher',
                'position'
            ])->where('id_document', $documentId)
                ->where('id_position', 3)->get();
        $comments = Comment::with([
                    'project',
                    'document',
                    'commentList',
                    'teacher',
                    'position'
        ])->where('id_project', $projectID)->where('id_document', $documentId)->orderBy('created_at', 'asc')->get();

        $projectscore = Project::with([
            'members.course',
            'members.level',
            'teachers',
            'confirmStudents.student',
            'confirmStudents.documents',
            'confirmTeachers.teacher',
            'confirmTeachers.document'
        ])->find($projectID);
        // dd($project);
        $pdf = Pdf::loadView('pdf.document03_score',['projects' => $project,'scores' => $scores,'comments' => $comments,'projectscore' => $projectscore]);
        return  $pdf->stream('test.pdf');
    }
}
