<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Document extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id_document';
    protected $fillable = ['document', 'created_by', 'updated_by'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'id_project');
    }
    public function member(){
        return $this->belongsToMany(Member::class,'confirm_documents','id_document','id_student');
    }
    // การเชื่อมโยงกับ ConfirmStudent
    public function confirmStudents()
    {
        return $this->hasMany(Confirm_student::class, 'id_document');
    }

    // การเชื่อมโยงกับ ConfirmTeacher
    public function confirmTeachers()
    {
        return $this->hasMany(Confirm_teacher::class, 'id_document');
    }
}