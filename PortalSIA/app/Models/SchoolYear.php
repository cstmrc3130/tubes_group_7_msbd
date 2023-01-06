<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;

    // ========== SPECIFY TABLE TO USE ========== //
    protected $table = "school_years";

    // ========== DISABLING AUTO INCREMENT FOR PRIMARY KEY ========== //
    public $primaryKey = "id";
    public $incrementing = false;

    // ========== MASS ASSIGNABLE ATTRIBUTES ========== //
    protected $fillable = 
    [
        'id',
        'year',
        'semester'
    ];

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN POST AND ITS USER ========== //
    public function scoringsession()
    {
        return $this->hasOne(ScoringSession::class, 'school_year_id', 'id');
    }
}
