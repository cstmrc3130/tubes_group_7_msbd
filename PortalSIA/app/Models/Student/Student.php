<?php

namespace App\Models\Student;

use App\Models\User;
use App\Models\Classroom\Classroom;
use Laravel\Scout\Searchable;
use App\Models\Student\HomeroomClass;
use App\Models\Subject\SubjectScore;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory, Searchable;

    // ========== SPECIFY TABLE TO USE (NOT MANDATORY => https://stackoverflow.com/a/51746287/19250775) ========== //
    protected $table = "students";

    // ========== DISABLING AUTO INCREMENT FOR PRIMARY KEY ========== //
    public $primaryKey = "NISN";
    public $incrementing = false;

    // ========== MASS ASSIGNABLE ATTRIBUTES ========== //
    protected $fillable = 
    [
        'NISN',
        'homeroom_class_id',
        'homeroom_teacher_NIP',
        'name',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'father_name',
        'mother_name',
        'guardian_name',
        'address',
        'phone_numbers',
        'status',
        'description',
        'entry_year',
        'special_needs'
    ];

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR PROFILE ========== //
    public function user()
    {
        return $this->hasOne(User::class, 'NISN');
    }

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR PROFILE ========== //
    public function subjectscore()
    {
        return $this->hasOne(SubjectScore::class, 'NISN');
    }

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR PROFILE ========== //
    public function homeroomclass()
    {
        return $this->hasOne(HomeroomClass::class, 'NISN');
    }

    // ========== TELL SCOUT WHICH COLUMN TO SEARCH ========== //
    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }
}
