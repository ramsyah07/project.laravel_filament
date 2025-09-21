<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\Subject;
use App\Models\Schedule;
use App\Models\ExamResult;
use Carbon\Carbon;

class StudentChart extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        // Calculate real statistics
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $totalClassrooms = Classroom::count();
        $totalSubjects = Subject::count();

        return [
            Stat::make('Total Students', $totalStudents)
                ->description('Registered students')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:scale-105 transition-transform duration-200',
                ]),
                
            Stat::make('Total Teachers', $totalTeachers)
                ->description('Active teachers')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info')
                ->chart([3, 8, 5, 12, 9, 6, 14])
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:scale-105 transition-transform duration-200',
                ]),
                
            Stat::make('Classrooms', $totalClassrooms)
                ->description('Available classrooms')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('warning')
                ->chart([15, 4, 10, 2, 12, 4, 18])
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:scale-105 transition-transform duration-200',
                ]),
                
            Stat::make('Subjects', $totalSubjects)
                ->description('Total subjects')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('danger')
                ->chart([4, 9, 3, 6, 12, 8, 15])
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:scale-105 transition-transform duration-200',
                ]),
        ];
    }

    public static function canView(): bool
    {
        return false; // Hide this widget completely
    }
}

