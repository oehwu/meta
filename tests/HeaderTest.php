<?php

declare(strict_types=1);

namespace OEHWUTest\Meta;

use OEHWU\Meta\Header;
use PHPUnit\Framework\TestCase;

class HeaderTest extends TestCase
{
    public function testGetHeader(): void
    {
        $header = Header::getHeader(true);

        self::assertNotNull($header);
        self::assertStringContainsString('oehwu-snippet-header', $header);
    }

    public function testGetCachedHeader(): void
    {
        Header::getHeader();

        $header = Header::getHeader();

        self::assertNotNull($header);
        self::assertStringContainsString('oehwu-snippet-header', $header);
    }
}
