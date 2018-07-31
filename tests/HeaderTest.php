<?php

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
}
