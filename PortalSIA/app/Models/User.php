<?php

namespace App\Models;

use App\Traits\UUID;
use App\Models\News\News;
use App\Models\Teacher\Teacher;
use App\Models\Student\Student;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UUID;

    // ========== SPECIFY TABLE TO USE (NOT MANDATORY => https://stackoverflow.com/a/51746287/19250775) ========== //
    protected $table = "users";

    // ========== DISABLING AUTO INCREMENT FOR PRIMARY KEY ========== //
    public $primaryKey = "id";
    public $incrementing = false;

    // ========== MASS ASSIGNABLE ATTRIBUTES ========== //
    protected $fillable = 
    [
        'id',
        'NISN',
        'NIP',
        'email',
        'role',
        'profile_picture',
        'password',
    ];

    // ========== HIDDEN ATTRIBUTES FOR SERIALIZATION (INVISIBLE WHEN CONVERTING TO ARRAY OR JSON) ========== //
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // ========== CASTED ATTRIBUTES (CHANGE DATA TYPE) ========== //
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR PROFILE ========== //
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'NIP', 'NIP');
    }

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR POST ========== //
    public function student()
    {
        return $this->belongsTo(Student::class, 'NISN', 'NISN');
    }

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR POST ========== //
    public function news()
    {
        return $this->hasMany(News::class, 'author_id', 'id');
    }
}
