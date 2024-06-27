<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Confirm_student extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id_confirm_student';
    protected $fillable = ['id_student', 'id_project', 'id_document', 'confirm_status'];

    public function student()
    {
        return $this->belongsTo(Member::class, 'id_student');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'id_project');
    }

    public function documents()
    {
        return $this->belongsTo(Document::class, 'id_document');
    }
}