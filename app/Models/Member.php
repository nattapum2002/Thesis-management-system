<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Member extends Model implements Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $primaryKey = 'id_student';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id_student', 'prefix', 'name', 'surname', 'email', 'tel', 'id_line', 'student_image',
        'id_level', 'id_course', 'username', 'password', 'account_status', 'created_by', 'updated_by'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'student_projects', 'id_student', 'id_project');
    }

    public function getAuthIdentifierName()
    {
        return 'id_student';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {
    }

    public function getRememberTokenName()
    {
    }
}
