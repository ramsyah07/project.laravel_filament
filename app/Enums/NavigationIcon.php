<?php

namespace App\Enums;

enum NavigationIcon: string
{
    // Master Data Icons
    case TEACHER = 'heroicon-o-user-group';
    case STUDENT = 'heroicon-o-academic-cap';
    case SUBJECT = 'heroicon-o-book-open';
    case CLASSROOM = 'heroicon-o-building-office';

    // Academic Management Icons
    case SCHEDULE = 'heroicon-o-calendar-days';
    case ATTENDANCE = 'heroicon-o-clipboard-document-check';
    case CURRICULUM = 'heroicon-o-document-text';

    // Examination Icons
    case EXAM_BANK = 'heroicon-o-folder';
    case EXAM_RESULT = 'heroicon-o-chart-bar';

    case CALENDAR = 'heroicon-o-calendar-days';
    case DASHBOARD = 'heroicon-o-home';


    /**
     * Get all navigation icons as array
     */
    public static function toArray(): array
    {
        return [
            'teacher' => self::TEACHER->value,
            'student' => self::STUDENT->value,
            'subject' => self::SUBJECT->value,
            'classroom' => self::CLASSROOM->value,
            'schedule' => self::SCHEDULE->value,
            'attendance' => self::ATTENDANCE->value,
            'curriculum' => self::CURRICULUM->value,
            'exam_bank' => self::EXAM_BANK->value,
            'exam_result' => self::EXAM_RESULT->value,
            'calender' => self::CALENDAR->value,
        ];
    }

    /**
     * Get icon by model name
     */
    public static function getByModel(string $modelName): string
    {
        return match(strtolower($modelName)) {
            'teacher' => self::TEACHER->value,
            'student' => self::STUDENT->value,
            'subject' => self::SUBJECT->value,
            'classroom' => self::CLASSROOM->value,
            'schedule' => self::SCHEDULE->value,
            'attendance' => self::ATTENDANCE->value,
            'curriculum' => self::CURRICULUM->value,
            'exambank' => self::EXAM_BANK->value,
            'examresult' => self::EXAM_RESULT->value,
            'calender' => self::CALENDAR->value,
        };
    }

    /**
     * Get icon label/description
     */
    public function getLabel(): string
    {
        return match($this) {
            self::TEACHER => 'Teachers',
            self::STUDENT => 'Students',
            self::SUBJECT => 'Subjects',
            self::CLASSROOM => 'Classrooms',
            self::SCHEDULE => 'Schedules',
            self::ATTENDANCE => 'Attendance',
            self::CURRICULUM => 'Curriculum',
            self::EXAM_BANK => 'Exam Bank',
            self::EXAM_RESULT => 'Exam Results',
            self::CALENDAR =>'Calenders',
        };
    }
}