<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Comment extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id_comment';
    protected $fillable = ['comment', 'id_project', 'id_document', 'id_comment_list', 'id_teacher', 'id_position'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'id_project');
    }

    public function document()
    {
        return $this->belongsTo(Document::class, 'id_document');
    }

    public function commentList()
    {
        return $this->belongsTo(Comment_list::class, 'id_comment_list');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'id_teacher');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'id_position');
    }
}