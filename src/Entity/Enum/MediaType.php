<?php

namespace App\Entity\Enum;

enum MediaType: string
{
    case IMAGE = 'image';
    case VIDEO = 'video';
    case VIRTUAL_TOUR = 'virtual_tour';
    case FLOOR_PLAN = 'floor_plan';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
    
    public function getLabel(): string
    {
        return match($this) {
            self::IMAGE => 'Image',
            self::VIDEO => 'Video',
            self::VIRTUAL_TOUR => 'Visite virtuelle',
            self::FLOOR_PLAN => 'Plan',
        };
    }
}