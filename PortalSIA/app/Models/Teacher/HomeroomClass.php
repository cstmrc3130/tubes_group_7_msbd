<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeroomClass extends Model
{
    use HasFactory;

    // ========== SPECIFY TABLE TO USE (NOT MANDATORY => https://stackoverflow.com/a/51746287/19250775) ========== //
    protected $table = "homeroom_classes";

    // ========== DISABLING AUTO INCREMENT FOR PRIMARY KEY ========== //
    public $primaryKey = "id";
    public $incrementing = false;

    // ========== MASS ASSIGNABLE ATTRIBUTES ========== //
    protected $fillable = 
    [
        'id',
        'NIP',
        'class_id',
        'school_year',
    ];

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN SUBJECT ITS TEACHER ========== //
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'NIP', 'NIP');
    }

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN TAUGHT SUBJECT AND SUBJECT ========== //
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id', 'id');
    }
}
