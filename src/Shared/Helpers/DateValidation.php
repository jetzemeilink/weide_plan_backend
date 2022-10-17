<?php

namespace App\Shared\Helpers;

use DateTime;

class DateValidation
{
  public static function isValidDate(string $date, string $format = 'd-m-Y'): bool
  {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}
}