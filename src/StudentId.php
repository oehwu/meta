<?php

declare(strict_types=1);

namespace OEHWU\Meta;

use function preg_match;
use function str_contains;
use function strlen;
use function strstr;
use function substr;
use function trim;

final class StudentId
{
    private const CODE_LETTER_WU = 'h';

    public static function isValid(string $studentId): bool
    {
        $studentId = trim($studentId);

        return preg_match('/^' . self::CODE_LETTER_WU . '\d{7,8}$/', $studentId) === 1;
    }

    public static function filter(string $studentId): string
    {
        $studentId = self::extractFromEmail($studentId);

        if (!self::isValid($studentId)) {
            return $studentId;
        }

        if (preg_match('/^' . self::CODE_LETTER_WU . '\d{7,8}$/', $studentId) !== false) {
            $studentId = substr($studentId, 1);
        }

        $length = strlen($studentId);
        if ($length === 8 && $studentId[0] === '0') {
            $studentId = substr($studentId, 1);
        }

        return self::CODE_LETTER_WU . $studentId;
    }

    public static function check(string $studentId): string|null
    {
        $studentId = self::extractFromEmail($studentId);

        if (!self::isValid($studentId)) {
            return null;
        }

        return self::filter($studentId);
    }

    private static function extractFromEmail(string $studentId): string
    {
        if (!str_contains($studentId, '@')) {
            return $studentId;
        }

        $part = strstr($studentId, '@', true);

        if ($part === false) {
            return $studentId;
        }

        return $part;
    }
}
