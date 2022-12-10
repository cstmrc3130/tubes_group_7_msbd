<?php

namespace App\Models\Classroom;

use App\Models\Student\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    // ========== SPECIFY TABLE TO USE (NOT MANDATORY => https://stackoverflow.com/a/51746287/19250775) ========== //
    protected $table = "classes";

    // ========== DISABLING AUTO INCREMENT FOR PRIMARY KEY ========== //
    public $primaryKey = "id";
    public $incrementing = false;

    // ========== MASS ASSIGNABLE ATTRIBUTES ========== //
    protected $fillable = 
    [ 
        'name',
        'semester',
    ];

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR PROFILE ========== //
    public function student()
    {
        return $this->belongsTo(Student::class, 'homeroom_class_id', 'id');
    }

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR PROFILE ========== //
    public function homeroomteacher()
    {
        return $this->hasOne(Teacher::class, 'homeroom_teacher_NIP', 'NIP');
    }
}