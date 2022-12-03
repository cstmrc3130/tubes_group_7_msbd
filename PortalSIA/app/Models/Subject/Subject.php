<?php

namespace App\Models\Subject;

use App\Models\Completeness;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    // ========== SPECIFY TABLE TO USE (NOT MANDATORY => https://stackoverflow.com/a/51746287/19250775) ========== //
    protected $table = "subjects";

    // ========== DISABLING AUTO INCREMENT FOR PRIMARY KEY ========== //
    public $primaryKey = "id";
    public $incrementing = false;

    // ========== MASS ASSIGNABLE ATTRIBUTES ========== //
    protected $fillable = 
    [
        'id',
        'completeness_id',
        'name',
    ];

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN SUBJECT ITS TEACHER ========== //
    public function completeness()
    {
        return $this->belongsTo(Completeness::class, 'completeness_id', 'id');
    }

}
