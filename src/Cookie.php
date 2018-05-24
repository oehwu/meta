<?php

namespace OEHWU\Meta;

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
            . file_get_contents($templatePath . 'cookie.php');
    }
}
