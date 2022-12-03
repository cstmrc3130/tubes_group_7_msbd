<?php

namespace App\Models\Teacher;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    // ========== SPECIFY TABLE TO USE (NOT MANDATORY => https://stackoverflow.com/a/51746287/19250775) ========== //
    protected $table = "teachers";

    // ========== DISABLING AUTO INCREMENT FOR PRIMARY KEY ========== //
    public $primaryKey = "id";
    public $incrementing = false;

    // ========== MASS ASSIGNABLE ATTRIBUTES ========== //
    protected $fillable = 
    [
        'NIP',
        'KARPEG',
        'position',
        'name',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'address',
        'phone_number',
        'graduated_from',
        'graduated_at',
        'started_working_at'
    ];


    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR PROFILE ========== //
    public function user()
    {
        return $this->hasOne(User::class, 'NIP', 'NIP');
    }

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR POST ========== //
    public function student()
    {
        return $this->hasMany(Student::class, 'homeroom_teacher_NIP', 'NIP');
    }

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR POST ========== //
    public function homeroomclass()
    {
        return $this->hasOne(HomeroomClass::class, 'NIP', 'NIP');
    }

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR POST ========== //
    public function teachingsubject()
    {
        return $this->hasMany(TeachingSubject::class, 'NIP', 'NIP');
    }

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR POST ========== //
    public function teachingextracurricular()
    {
        return $this->hasMany(TeachingExtracurricular::class, 'NIP', 'NIP');
    }
}
