<?php

namespace App\Models\Teacher;

use App\Models\User;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory, Searchable;

    // ========== SPECIFY TABLE TO USE (NOT MANDATORY => https://stackoverflow.com/a/51746287/19250775) ========== //
    protected $table = "teachers";

    // ========== DISABLING AUTO INCREMENT FOR PRIMARY KEY ========== //
    public $primaryKey = "NIP";
    public $incrementing = false;

    // ========== MASS ASSIGNABLE ATTRIBUTES ========== //
    protected $fillable = 
    [
        'NIP',
        'homeroom_class_id',
        'KARPEG',
        'position',
        'name',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'address',
        'phone_numbers',
        'graduated_from',
        'graduated_at',
        'started_working_at'
    ];


    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR PROFILE ========== //
    public function user()
    {
        return $this->hasOne(User::class, 'NIP');
    }

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR POST ========== //
    public function homeroomclass()
    {
        return $this->hasOne(HomeroomClass::class, 'NIP');
    }

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR POST ========== //
    public function teachingsubject()
    {
        return $this->hasMany(TeachingSubject::class, 'NIP', 'NIP');
    }

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN USER AND THEIR POST ========== //
    public function teachingextracurricular()
    {
        return $this->hasMany(TeachingExtracurricular::class, 'NIP', 'NIP');
    }

    // ========== TELL SCOUT WHICH COLUMN TO SEARCH ========== //
    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }
}
