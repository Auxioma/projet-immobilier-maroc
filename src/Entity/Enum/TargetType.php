<?php

namespace App\Entity\Enum;

enum TargetType: string
{
    case PROPERTY = 'property';
    case AGENCY = 'agency';
    case USER = 'user';
}
