<?php

declare(strict_types=1);

namespace OEHWU\Meta;

use function preg_match;
use function strlen;
use function strpos;
use function strstr;
use function substr;
use function trim;

final class StudentId
{
    public const CODE_LETTER_WU = 'h';

    /**
     * @param string $studentId
     * @return bool
     */
    public static function isValid($studentId)
    {
        $studentId = trim($studentId);

        return preg_match('/^' . self::CODE_LETTER_WU . '\d{7,8}$/', $studentId) === 1;
    }

    /**
     * @param string $studentId
     * @return string
     */
    public static function filter($studentId)
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

    /**
     * @param string $studentId
     * @return null|string
     */
    public static function check($studentId)
    {
        $studentId = self::extractFromEmail($studentId);

        if (!self::isValid($studentId)) {
            return null;
        }

        return self::filter($studentId);
    }

    /**
     * @param string $studentId
     * @return string
     */
    private static function extractFromEmail($studentId)
    {
        if (strpos($studentId, '@') === false) {
            return $studentId;
        }

        $part = strstr($studentId, '@', true);

        if ($part === false) {
            return $studentId;
        }

        return $part;
    }
}
