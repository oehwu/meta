<?php

declare(strict_types=1);

namespace OEHWU\Meta;

use function file_get_contents;

class Cookie
{
    /**
     * @return string
     */
    public static function getSnippet()
    {
        $templatePath = __DIR__ . '/../templates/cookie/';

        return '<script>' . file_get_contents($templatePath . 'js.cookie.js') . '</script>'
            . '<script>' . file_get_contents($templatePath . 'cookie.js') . '</script>'
            . file_get_contents($templatePath . 'cookie.html');
    }
}
