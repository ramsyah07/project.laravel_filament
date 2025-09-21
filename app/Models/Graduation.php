<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Graduation extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'student_id',
        'enrollment_id',
        'grade_level_id',
        'class_id',
        'academic_year',
        'graduation_date'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'graduation_date' => 'date',
        'academic_year' => 'string'
    ];

    /**
     * Relasi ke Student
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }



    /**
     * Relasi ke Class
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    /**
     * Scope untuk tahun akademik tertentu
     */
    public function scopeByAcademicYear($query, $year)
    {
        return $query->where('academic_year', $year);
    }

    /**
     * Scope untuk grade level tertentu
     */
    public function scopeByGradeLevel($query, $gradeLevelId)
    {
        return $query->where('grade_level_id', $gradeLevelId);
    }

    /**
     * Scope untuk range tanggal kelulusan
     */
    public function scopeByGraduationDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('graduation_date', [$startDate, $endDate]);
    }

    /**
     * Scope untuk tahun kelulusan tertentu
     */
    public function scopeByGraduationYear($query, $year)
    {
        return $query->whereYear('graduation_date', $year);
    }


    /**
     * Static method untuk mendapatkan total lulusan per tahun akademik
     */
    public static function countByAcademicYear(string $academicYear): int
    {
        return static::where('academic_year', $academicYear)->count();
    }

    /**
     * Static method untuk mendapatkan total lulusan per grade level
     */
    public static function countByGradeLevel(int $gradeLevelId): int
    {
        return static::where('grade_level_id', $gradeLevelId)->count();
    }
}