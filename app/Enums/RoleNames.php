<?php

namespace App\Enums;

enum RoleNames: string
{
    case ADMIN = 'admin';
    case UPLOADER = 'uploader';
    case EMPLOYEE = 'employee';
}
