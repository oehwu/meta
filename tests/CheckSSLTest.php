<?php

declare(strict_types=1);

namespace OEHWUTest\Meta;

use OEHWU\Meta\CheckSSL;
use PHPUnit\Framework\TestCase;

final class CheckSSLTest extends TestCase
{
    public function testNoSsl(): void
    {
        $check = CheckSSL::isSSL();

        self::assertFalse($check);
    }

    public function testSslReturnsTrueIfServerSettingIsPresent(): void
    {
        $this->setServerVariable();
        $check = CheckSSL::isSSL();

        self::assertTrue($check);
    }

    /**
     * This test is just to add line coverage. We can't check HTTP headers in CLI SAPI without the Xdebug extension.
     */
    public function testDoesNotRedirectWithSsl(): void
    {
        $this->setServerVariable();

        CheckSSL::redirect();

        self::assertTrue(CheckSSL::isSSL());
    }

    /**
     * This test is just to add line coverage. We can't check HTTP headers in CLI SAPI without the Xdebug extension.
     */
    public function testRedirectsToHttps(): void
    {
        CheckSSL::redirect();

        $this->expectNotToPerformAssertions();
    }

    private function setServerVariable(): void
    {
        $_SERVER['HTTP_X_SSL_REQUEST'] = 1;
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($_SERVER['HTTP_X_SSL_REQUEST']);
    }
}
