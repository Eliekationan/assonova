<?php

namespace App\Traits;
use Illuminate\Support\Str;
trait SanitizesInput
{
    //
    protected function cleanString($value)
    {
        if (!$value) return null;
        $val = trim(strip_tags($value));
        return preg_replace('/\s+/', ' ', $val);
    }

    protected function cleanPhone($value)
    {
        if (!$value) return null;

        $v = trim($value);

        if (Str::startsWith($v, '+')) {
            return '+' . preg_replace('/\D/', '', substr($v, 1));
        }

        return preg_replace('/\D/', '', $v);
    }

    protected function cleanEmail($value)
    {
        if (!$value) return null;
        return strtolower(
            filter_var(trim($value), FILTER_SANITIZE_EMAIL)
        );
    }

    protected function cleanDate($value)
    {
        try {
            return \Carbon\Carbon::parse($value)->toDateString();
        } catch (\Exception $e) {
            return null;
        }
    }
}
