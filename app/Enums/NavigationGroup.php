<?php

namespace App\Enums;

enum NavigationGroup: string
{
    case Master_Data = 'Master Data';
    case Academic_Management = 'Academic Management';
    case Assesment = 'Assessment';

    case MANAGEMENT = 'Management';

    case ACADEMIC = 'Academic';

    /**
     * Get all navigation groups as array
     */
    public static function toArray(): array
    {
        return [
            self::Master_Data->value,
            self::Academic_Management->value,
            self::Assesment->value,
            self::MANAGEMENT->value,
            self::ACADEMIC->value,
        ];
    }

    /**
     * Get navigation group label
     */
    public function getLabel(): string
    {
        return $this->value;
    }

    /**
     * Get navigation group order/sort
     */
    public function getSort(): int
    {
        return match($this) {
            self::Master_Data => 1,
            self::Academic_Management => 2,
            self::Assesment => 3,
        };
    }
}