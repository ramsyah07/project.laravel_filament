<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'grade_level',
        'major',
        'room_number',
        'building',
        'floor',
    ];

    /**
     * Get the classroom that the student belongs to.
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
