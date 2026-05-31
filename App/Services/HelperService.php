<?php

namespace App\Services;

class HelperService
{
    public static function e($value): string
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }

    public static function price($value): string
    {
        return number_format((float)$value, 2);
    }

    public static function limitText($text, $limit = 60): string
    {
        $text = $text ?? '';
        return mb_strlen($text) > $limit
            ? mb_substr($text, 0, $limit) . '...'
            : $text;
    }

    public static function asset($path): string
    {
        return BASE_URL . ltrim($path, '/');
    }
}