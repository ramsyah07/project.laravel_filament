<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Subject extends Model
{
    protected $fillable = [
        'code',
        'name', 
        'start_time',
        'end_time'
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    // Accessor untuk format tampilan waktu
    public function getTimeRangeAttribute()
    {
        if ($this->start_time && $this->end_time) {
            return Carbon::parse($this->start_time)->format('H.i') . '-' . 
                   Carbon::parse($this->end_time)->format('H.i');
        }
        return $this->hours;
    }

    public function teachers()
{
    return $this->belongsToMany(Teacher::class, 'subject_teacher');
}



}

