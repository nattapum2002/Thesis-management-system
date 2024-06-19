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

    protected $fillable = [
        'project_name_th',
        'project_name_en',
        'project_status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];

    public function members()
    {
        return $this->belongsToMany(Member::class, 'student_projects', 'id_project', 'id_student');
    }

    public function advisers()
    {
        return $this->belongsToMany(Teacher::class, 'advisers', 'id_project', 'id_teacher')
            ->withPivot('adviser_status'); // assuming there is an adviser_status column
    }

    public function mainAdviser()
    {
        return $this->advisers()->wherePivot('adviser_status', 'หลัก')->first();
    }
}
