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
    protected $fillable = [
        'id_exam_schedule',
        'exam_time',
        'exam_day',
        'exam_room',
        'exam_building',
        'exam_group',
        'year_published',
        'semester',
        'id_project',
        'id_document',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',

    ];
}
