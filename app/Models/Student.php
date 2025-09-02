<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    // Di app/Models/Student.php
    protected $fillable = [
        'nisn',
        'name',
        'entry_year_start', 
        'entry_year_end',   
        'status',
        'classroom_id', 
    ];

    protected $casts = [
        'entry_year_start' => 'integer',
        'entry_year_end' => 'integer',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
