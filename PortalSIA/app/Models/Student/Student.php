<?php

namespace App\Models\Student;

use App\Models\User;
use Laravel\Scout\Searchable;
use App\Models\Classroom\Classroom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'name',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'father_name',
        'mother_name',
        'guardian_name',
        'phone_number'
    ];

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR PROFILE ========== //
    public function user()
    {
        return $this->hasOne(User::class, 'NISN', 'NISN');
    }

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR PROFILE ========== //
    public function homeroomclass()
    {
        return $this->hasOne(Classroom::class, 'id', 'homeroom_class_id');
    }

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR PROFILE ========== //
    public function homeroomteacher()
    {
        return $this->hasOne(Teacher::class, 'homeroom_teacher_NIP', 'NIP');
    }

    // ========== TELL SCOUT WHICH COLUMN TO SEARCH ========== //
    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }
}
