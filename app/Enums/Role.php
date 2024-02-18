<?php

namespace App\Enums;

enum Role: string
{
    case SUPER_ADMIN = "SUPER_ADMIN";
    case ADMIN = "ADMIN";

    case EMPLOYER = "EMPLOYER";

    case APPLICANT = "APPLICANT";

    /// Function for DB testing only
    public static function random()
    {
        return self::cases()[array_rand(self::cases())];
    }
}
