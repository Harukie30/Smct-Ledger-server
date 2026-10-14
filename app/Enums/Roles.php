<?php

namespace App\Enums;

enum Roles: string
{
    case ADMIN = 'admin';
    case UPLOADER = 'uploader';
    case EMPLOYEE = 'employee';
}
