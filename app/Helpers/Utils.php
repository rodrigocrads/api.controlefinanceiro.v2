<?php

namespace FinancialControl\Helpers;

use DateTimeImmutable;

class Utils
{
    public static function convertISODateToBR(?string $date): ?string
    {
        return !empty($date)
            ? (new DateTimeImmutable($date))->format('d/m/Y')
            : $date;
    }
}