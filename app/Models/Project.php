<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Project extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'id_project';
    protected $fillable = ['project_name_th', 'project_name_en', 'project_status', 'created_by', 'updated_by'];


    public function membersProject()
    {
        return $this->hasMany(Student_project::class, 'id_project');
    }
    public function members()
    {
        return $this->belongsToMany(Member::class, 'student_projects', 'id_project', 'id_student');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'advisers', 'id_project', 'id_teacher')->withPivot('id_position');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'id_project');
    }

    public function advisers()
    {
        return $this->hasMany(Adviser::class, 'id_project');
    }
    public function confirmStudents()
    {
        return $this->hasMany(Confirm_student::class, 'id_project');
    }

    public function confirmTeachers()
    {
        return $this->hasMany(Confirm_teacher::class, 'id_project');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'id_project');
    }
}
