<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Member extends Model implements Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id_student';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id_student',
        'prefix',
        'name',
        'surname',
        'email',
        'tel',
        'id_line',
        'student_image',
        'signature_image',
        'id_level',
        'id_course',
        'username',
        'password',
        'account_status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level', 'id_level');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course', 'id_course');
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
