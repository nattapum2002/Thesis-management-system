<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class News extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'id_news';

    protected $fillable = [
        'title',
        'details',
        'news_image',
        'type',
        'id_teacher',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];

    // Assuming the foreign key is id_teacher in the news table
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'id_teacher');
    }
}
