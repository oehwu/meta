<?php

declare(strict_types=1);

namespace OEHWUTest\Meta;

use OEHWU\Meta\Cookie;
use PHPUnit\Framework\TestCase;

use function chdir;
use function dirname;
use function file_get_contents;

final class CookieTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        chdir(dirname(__DIR__));
    }

    public function testGetSnippet(): void
    {
        $template = './templates/cookie/';

        $cookie = Cookie::getSnippet();

        self::assertStringContainsString((string)file_get_contents($template . 'cookie.js'), $cookie);
        self::assertStringContainsString((string)file_get_contents($template . 'js.cookie.js'), $cookie);
        self::assertStringContainsString((string)file_get_contents($template . 'cookie.html'), $cookie);
    }
}
