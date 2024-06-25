<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Model implements Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id_teacher';
    protected $fillable = [
        'prefix', 'name', 'surname', 'academic_position', 'educational_qualification',
        'branch', 'user_type', 'email', 'tel', 'id_line', 'teacher_image',
        'signature_image', 'username', 'password', 'account_status', 'created_by', 'updated_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function news()
    {
        return $this->hasMany(News::class, 'id_teacher');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'advisers', 'id_teacher', 'id_project');
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function getAuthIdentifierName()
    {
        return 'id_teacher';
    }
    public function getAuthIdentifier()
    {
        return $this->getKey();;
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