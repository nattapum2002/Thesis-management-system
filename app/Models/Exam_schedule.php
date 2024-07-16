<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Exam_schedule extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id_exam_schedule';
    protected $fillable = ['exam_time', 'exam_day', 'exam_room', 'exam_building', 'exam_group', 'year_published', 'semester', 'id_project', 'id_document', 'id_teacher', 'created_by', 'updated_by'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'id_project');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'id_teacher');
    }

    public function document()
    {
        return $this->belongsTo(Document::class, 'id_document');
    }
}