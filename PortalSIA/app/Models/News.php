<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    // ========== SPECIFY TABLE TO USE ========== //
    protected $table = "news";

    // ========== DISABLING AUTO INCREMENT FOR PRIMARY KEY ========== //
    public $primaryKey = "id";
    public $incrementing = false;

    // ========== NON MASS ASSIGNABLE ATTRIBUTES ========== // 
    protected $guarded = [];

    // ========== MASS ASSIGNABLE ATTRIBUTES ========== //
    protected $fillable = 
    [
        'id',
        'author_id',
        'title',
        'content',
    ];

    // ========== DEFINE CARDINALITY & RELATIONSHIP BETWEEN POST AND ITS USER ========== //
    public function user()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
