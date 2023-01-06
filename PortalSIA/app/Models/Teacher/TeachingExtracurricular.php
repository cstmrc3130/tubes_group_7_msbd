<?php

namespace App\Models\Teacher;

use App\Models\Extracurricular\Extracurricular;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingExtracurricular extends Model
{
    use HasFactory;

    // ========== SPECIFY TABLE TO USE (NOT MANDATORY => https://stackoverflow.com/a/51746287/19250775) ========== //
    protected $table = "teaching_extracurriculars";

    // ========== DISABLING AUTO INCREMENT FOR PRIMARY KEY ========== //
    public $primaryKey = "id";
    public $incrementing = false;

    // ========== MASS ASSIGNABLE ATTRIBUTES ========== //
    protected $fillable = 
    [
        'id',
        'NIP',
        'extracurricular_id',
        'school_year_id',
    ];

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN SUBJECT ITS TEACHER ========== //
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'NIP', 'NIP');
    }

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN TAUGHT SUBJECT AND SUBJECT ========== //
    public function extracurricular()
    {
        return $this->belongsTo(Extracurricular::class, 'subject_id', 'id');
    }
}
