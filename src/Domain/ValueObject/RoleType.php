<?php

namespace App\Domain\ValueObject;

enum RoleType: string
{
    case STUDENT = 'student';
    case TEACHER = 'teacher';
    case ADMIN = 'administrator';
}