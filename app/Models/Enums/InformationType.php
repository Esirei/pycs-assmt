<?php

namespace App\Models\Enums;

enum InformationType: string
{
    case EMAIL = 'email';
    case PHONE = 'phone';
    case LOCATION = 'location';
}
