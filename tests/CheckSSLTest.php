<?php

namespace OEHWUTest\Meta;

use OEHWU\Meta\CheckSSL;
use PHPUnit\Framework\TestCase;

class CheckSSLTest extends TestCase
{
    public function testNoSsl()
    {
        $check = CheckSSL::isSSL();

        $this->assertFalse($check);
    }

    public function testSslReturnsTrueIfServerSettingIsPresent()
    {
        $this->setServerVariable();
        $check = CheckSSL::isSSL();

        $this->assertTrue($check);
    }

    public function testDoesNotRedirectWithSsl()
    {
        $this->setServerVariable();
        $return = CheckSSL::redirect();

        $this->assertNull($return);
    }

    private function setServerVariable()
    {
        $_SERVER['HTTP_X_SSL_REQUEST'] = 1;
    }
}
