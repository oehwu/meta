<?php

declare(strict_types=1);

namespace OEHWUTest\Meta;

use OEHWU\Meta\Header;
use PHPUnit\Framework\TestCase;

class HeaderTest extends TestCase
{
    public function testGetHeader()
    {
        $header = Header::getHeader(true);

        $this->assertContains('oehwu-snippet-header', $header);
    }

    public function testGetCachedHeader()
    {
        Header::getHeader();
        $header = Header::getHeader();

        $this->assertContains('oehwu-snippet-header', $header);
    }
}
