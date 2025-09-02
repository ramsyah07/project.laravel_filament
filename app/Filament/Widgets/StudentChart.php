<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classroom;

class StudentChart extends Widget
{
    protected string $view = 'filament.widgets.student-chart-widget';

    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        return [
            'stats' => [
                'students' => Student::count(),
                'teachers' => Teacher::count(),
                'classrooms' => Classroom::count(),
            ]
        ];
    }
}

