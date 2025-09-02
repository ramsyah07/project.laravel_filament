<?php
namespace App\Filament\Widgets;

use App\Models\Schedule;
use Filament\Widgets\Widget;
use Carbon\Carbon;

class ScheduleCalendar extends Widget
{
    protected string $view = 'filament.widgets.schedule-calendar';

    protected function getViewData(): array
{
    try {
        $schedules = Schedule::with(['subject', 'teacher', 'classroom'])->get();

        $events = $schedules->map(function ($schedule) {
            // Validasi kolom lowercase sesuai model dan migrasi
            if (empty($schedule->day) || empty($schedule->time)) {
                return null;
            }

            $dayOfWeek = $schedule->day; // e.g. "Monday"
            $time = $schedule->time;     // e.g. "08:00-09:40"

            // Pisahkan rentang waktu "HH:MM-HH:MM"
            $timeParts = explode('-', (string) $time);
            $startTime = isset($timeParts[0]) ? trim($timeParts[0]) : '00:00';
            $endTime = isset($timeParts[1]) ? trim($timeParts[1]) : $startTime;

            // Ambil tanggal berikutnya untuk hari tersebut
            $carbonDay = Carbon::now()->next($dayOfWeek);

            // Gabungkan tanggal + waktu
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
                'className' => 'fc-event-custom',
                'extendedProps' => [
                    'subject_id' => $schedule->subject_id,
                    'teacher_id' => $schedule->teacher_id,
                    'classroom_id' => $schedule->classroom_id,
                    'day' => $schedule->day,
                    'time' => $schedule->time,
                ],
            ];
        })->filter()->toArray();

        return [
            'events' => $events,
        ];

    } catch (\Exception $e) {
        return [
            'events' => [],
        ];
    }
}
}