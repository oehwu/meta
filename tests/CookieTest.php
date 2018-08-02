<?php

namespace OEHWUTest\Meta;

use OEHWU\Meta\Cookie;
use PHPUnit\Framework\TestCase;

class CookieTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        chdir(dirname(__DIR__));
    }

    public function testGetSnippet()
    {
        $template = './templates/cookie/';

        $cookie = Cookie::getSnippet();

        $this->assertContains(file_get_contents($template . 'cookie.js'), $cookie);
        $this->assertContains(file_get_contents($template . 'js.cookie.js'), $cookie);
        $this->assertContains(file_get_contents($template . 'cookie.html'), $cookie);
    }
}
