<?php

namespace App\Enums;

enum TenantRole: string
{
    case OWNER = 'owner';
    case ADMIN = 'admin';
    case MANAGER = 'manager';
    case EMPLOYEE = 'employee';
    case CLIENT = 'client';
    case MEMBER = 'member';
}
