<?php

namespace App\Entity\Enum;

enum ReasonType: string
{
    case FAKE = 'fake';
    case SPAM = 'spam';
    case INAPPROPRIATE = 'inappropriate';
    case WRONG_INFO = 'wrong_info';
    case DUPLICATE = 'duplicate';
    case OTHER = 'other';
}
