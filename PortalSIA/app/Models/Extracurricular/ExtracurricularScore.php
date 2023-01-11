<?php

namespace App\Models\Extracurricular;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExtracurricularScore extends Model
{
    use HasFactory;

    // ========== SPECIFY TABLE TO USE (NOT MANDATORY => https://stackoverflow.com/a/51746287/19250775) ========== //
    protected $table = "extracurricular_scores";

    // ========== DISABLING AUTO INCREMENT FOR PRIMARY KEY ========== //
    public $primaryKey = "id";
    public $incrementing = false;

    // ========== MASS ASSIGNABLE ATTRIBUTES ========== //
    protected $fillable = 
    [
        'id',
        'extracurricular_id',
        'NISN',
        'score'
    ];

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN SUBJECT ITS STUDENT ========== //
    public function student()
    {
        return $this->belongsTo(Student::class, 'NISN');
    }

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN TAUGHT SUBJECT AND SUBJECT ========== //
    public function extracurricular()
    {
        return $this->belongsTo(Extracurricular::class, 'subject_id', 'id');
    }
}
