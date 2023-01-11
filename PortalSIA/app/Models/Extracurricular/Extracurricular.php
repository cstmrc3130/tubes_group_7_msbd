<?php

namespace App\Models\Extracurricular;

use App\Models\SchoolYear;
use App\Models\Student\TakingExtracurricular;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    use HasFactory;

    // ========== SPECIFY TABLE TO USE (NOT MANDATORY => https://stackoverflow.com/a/51746287/19250775) ========== //
    protected $table = "extracurriculars";

    // ========== DISABLING AUTO INCREMENT FOR PRIMARY KEY ========== //
    public $primaryKey = "id";
    public $incrementing = false;

    // ========== MASS ASSIGNABLE ATTRIBUTES ========== //
    protected $fillable = 
    [
        'id',
        'school_year_id',
        'name',
        'description',
        'image',
    ];

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN SUBJECT ITS TEACHER ========== //
    public function schoolyear()
    {
        return $this->belongsTo(SchoolYear::class, 'school_year_id', 'id');
    }

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR PROFILE ========== //
    public function takingextracurricular()
    {
        return $this->hasMany(TakingExtracurricular::class, 'extracurricular_id', 'id');
    }
}
