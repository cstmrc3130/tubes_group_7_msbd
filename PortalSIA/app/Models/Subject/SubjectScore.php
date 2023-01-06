<?php

namespace App\Models\Subject;

use App\Models\ScoringSession;
use App\Models\Student\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectScore extends Model
{
    use HasFactory;

    // ========== SPECIFY TABLE TO USE (NOT MANDATORY => https://stackoverflow.com/a/51746287/19250775) ========== //
    protected $table = "subject_scores";

    // ========== DISABLING AUTO INCREMENT FOR PRIMARY KEY ========== //
    public $primaryKey = "id";
    public $incrementing = false;

    // ========== MASS ASSIGNABLE ATTRIBUTES ========== //
    protected $fillable = 
    [
        'id',
        'subject_id',
        'NISN',
        'scoring_session_id',
        'school_year_id',
        'score'
    ];

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN SUBJECT ITS STUDENT ========== //
    public function student()
    {
        return $this->belongsTo(Student::class, 'NISN', 'NISN');
    }

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN TAUGHT SUBJECT AND SUBJECT ========== //
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function scoringsession()
    {
        return $this->belongsTo(ScoringSession::class, 'scoring_session_id', 'id');
    }
}
