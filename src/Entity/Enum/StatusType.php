<?php

namespace App\Entity\Enum;

enum StatusType: string
{
    case PENDING = 'pending';
    case REVIEWED = 'reviewed';
    case RESOLVED = 'resolved';
}
