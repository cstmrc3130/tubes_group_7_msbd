<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoringSession extends Model
{
    use HasFactory;

    // ========== SPECIFY TABLE TO USE (NOT MANDATORY => https://stackoverflow.com/a/51746287/19250775) ========== //
    protected $table = "scoring_sessions";

    // ========== DISABLING AUTO INCREMENT FOR PRIMARY KEY ========== //
    public $primaryKey = "id";
    public $incrementing = false;

    // ========== NON MASS ASSIGNABLE ATTRIBUTES ========== // 
    protected $guarded = [];
    
    // ========== MASS ASSIGNABLE ATTRIBUTES ========== //
    protected $fillable = 
    [
        'id',
        'type',
        'start_date',
        'end_date',
        'school_year_id'
    ];

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN POST AND ITS USER ========== //
    public function schoolyear()
    {
        return $this->belongsTo(SchoolYear::class, 'school_year_id', 'id');
    }
}
