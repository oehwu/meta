<?php

namespace OEHWU\Meta;

class Cookie
{
    public static function getSnippet()
    {
        return file_get_contents(__DIR__ . '/../templates/cookie/cookie.php');
    }
}
