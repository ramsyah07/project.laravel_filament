<?php
namespace App\Filament\Widgets;

use App\Models\Schedule;
use Filament\Widgets\Widget;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ScheduleCalendar extends Widget
{
    protected string $view = 'filament.widgets.schedule-calendar';

    protected int | string | array $columnSpan = 2;

    protected static ?int $sort = 1;

    protected static bool $isLazy = false;

    protected static ?string $pollingInterval = '30s';

    protected static ?string $maxHeight = '400px'; // Set height restriction for compact view

    public function getColumns(): int | string | array
    {
        return 1;
    }

    protected function getViewData(): array
    {
        try {
            $schedules = Schedule::with(['subject', 'teacher', 'classroom'])->get();

            $events = $schedules->map(function ($schedule) {
                // Validate required fields
                if (empty($schedule->day) || empty($schedule->time)) {
                    return null;
                }

                // Validate schedule relationships
                if (!$schedule->subject && !$schedule->teacher) {
                    return null; // Skip if no subject or teacher
                }

                $dayOfWeek = $schedule->day; // e.g. "Monday"
                $time = $schedule->time;     // e.g. "08:00-09:40"

                // Parse time range "HH:MM-HH:MM"
                $timeParts = explode('-', (string) $time);
                $startTime = isset($timeParts[0]) ? trim($timeParts[0]) : '00:00';
                $endTime = isset($timeParts[1]) ? trim($timeParts[1]) : $startTime;

                // Get next occurrence of this day
                try {
                    $carbonDay = Carbon::now()->next($dayOfWeek);
                } catch (\Exception $e) {
                    // If day parsing fails, use current date
                    $carbonDay = Carbon::now();
                }

                // Combine date + time
                $startDateTime = $carbonDay->format('Y-m-d') . ' ' . $startTime;
                $endDateTime = $carbonDay->format('Y-m-d') . ' ' . $endTime;

                $subjectName = optional($schedule->subject)->name ?? 'Unknown Subject';
                $teacherName = optional($schedule->teacher)->name ?? 'Unknown Teacher';
                $classroomName = optional($schedule->classroom)->name ?? null;

                $title = $subjectName . ' - ' . $teacherName;
                if (!empty($classroomName)) {
                    $title .= ' (' . $classroomName . ')';
                }

                return [
                    'id' => $schedule->id,
                    'title' => $title,
                    'start' => $startDateTime,
                    'end' => $endDateTime,
                    'allDay' => false,
                    'backgroundColor' => $this->getEventColor($schedule->subject_id ?? 0),
                    'borderColor' => $this->getEventColor($schedule->subject_id ?? 0),
                    'textColor' => '#ffffff',
                    'extendedProps' => [
                        'subject_id' => $schedule->subject_id,
                        'teacher_id' => $schedule->teacher_id,
                        'classroom_id' => $schedule->classroom_id,
                        'day' => $schedule->day,
                        'time' => $schedule->time,
                        'subject_name' => $subjectName,
                        'teacher_name' => $teacherName,
                        'classroom_name' => $classroomName,
                    ],
                ];
            })->filter()->values()->toArray();

            // Calendar data for mini calendar view
            $currentDate = Carbon::now();
            $calendarData = [
                'currentMonth' => $currentDate->format('F Y'),
                'currentDay' => $currentDate->format('d'),
                'currentDayName' => $currentDate->format('l'),
                'daysInMonth' => $currentDate->daysInMonth,
                'firstDayOfWeek' => $currentDate->startOfMonth()->dayOfWeek,
                'today' => $currentDate->format('Y-m-d'),
            ];

            return [
                'events' => $events,
                'calendarData' => $calendarData,
            ];

        } catch (\Exception $e) {
            Log::error('ScheduleCalendar Widget Error: ' . $e->getMessage());
            
            return [
                'events' => [],
                'calendarData' => [
                    'currentMonth' => Carbon::now()->format('F Y'),
                    'currentDay' => Carbon::now()->format('d'),
                    'currentDayName' => Carbon::now()->format('l'),
                    'daysInMonth' => Carbon::now()->daysInMonth,
                    'firstDayOfWeek' => Carbon::now()->startOfMonth()->dayOfWeek,
                    'today' => Carbon::now()->format('Y-m-d'),
                ],
            ];
        }
    }

    /**
     * Get color for events based on subject ID
     */
    private function getEventColor(?int $subjectId): string
    {
        if ($subjectId === null) {
            return '#6b7280'; // Gray for unknown subjects
        }
        
        $colors = [
            '#3b82f6', // Blue
            '#ef4444', // Red
            '#10b981', // Green
            '#f59e0b', // Yellow
            '#8b5cf6', // Purple
            '#06b6d4', // Cyan
            '#ec4899', // Pink
            '#84cc16', // Lime
        ];
        
        return $colors[($subjectId % count($colors))];
    }

    public static function canView(): bool
    {
        return true;
    }
}