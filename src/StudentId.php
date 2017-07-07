<?php

namespace OEHWU\Meta;

final class StudentId
{
    const CODE_LETTER_WU = 'h';

    /**
     * @param string $studentId
     * @return bool
     */
    public static function isValid($studentId)
    {
        $studentId = trim($studentId);

        if (!preg_match('/^' . self::CODE_LETTER_WU . '\d{7,8}$/', $studentId)) {
            return false;
        }

        $studentId = substr($studentId, 1);
        if (strlen($studentId) === 8 && !in_array($studentId[0], ['0', '1', '2', '3'], true)) {
            return false;
        }

        return true;
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

        if (preg_match('/^' . self::CODE_LETTER_WU . '\d{7,8}$/', $studentId)) {
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

        return strstr($studentId, '@', true);
    }
}
