<?php

namespace App\Enums;

enum VoucherLevel: int
{
    case LEVEL_1 = 1;
    case LEVEL_2 = 2;

    // Nominal setiap level
    public function nominal(): array
    {
        return match($this) {
            self::LEVEL_1 => [1000, 2000, 3000],
            self::LEVEL_2 => [4000, 5000],
        };
    }

    // Ambil semua nilai enum (misal untuk random)
    public static function all(): array
    {
        return [self::LEVEL_1, self::LEVEL_2];
    }
}
