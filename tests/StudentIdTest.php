<?php

declare(strict_types=1);

namespace OEHWUTest\Meta;

use OEHWU\Meta\StudentId;
use PHPUnit\Framework\TestCase;

class StudentIdTest extends TestCase
{
    /**
     * @param string      $studentId
     * @param bool        $isValidResult
     * @param string      $filterResult
     * @param string|null $checkResult
     * @dataProvider studentIdsProvider
     */
    public function testStudentIds($studentId, $isValidResult, $filterResult, $checkResult)
    {
        $this->assertSame($isValidResult, StudentId::isValid($studentId));
        $this->assertSame($filterResult, StudentId::filter($studentId));
        $this->assertSame($checkResult, StudentId::check($studentId));
    }

    /**
     * @return array
     */
    public static function studentIdsProvider()
    {
        // [studentId, ::isValid result, ::filter result, ::check result]
        return [
            ['h1234567', true, 'h1234567', 'h1234567'],
            ['h8567890', true, 'h8567890', 'h8567890'],
            ['h02345678', true, 'h2345678', 'h2345678'],
            ['h12345678', true, 'h12345678', 'h12345678'],
            ['h22345678', true, 'h22345678', 'h22345678'],
            ['h32345678', true, 'h32345678', 'h32345678'],
            ['h42345678', true, 'h42345678', 'h42345678'],
            ['h1234567@wu.ac.at', false, 'h1234567', 'h1234567'],
            ['h32345678@wu.ac.at', false, 'h32345678', 'h32345678'],
            ['h42345678@wu.ac.at', false, 'h42345678', 'h42345678'],
            ['h32345678@example.com', false, 'h32345678', 'h32345678'],
            ['a1234567', false, 'a1234567', null],
            ['a02345678', false, 'a02345678', null],
            ['a12345678', false, 'a12345678', null],
            ['a22345678', false, 'a22345678', null],
            ['a32345678', false, 'a32345678', null],
            ['hh1234567', false, 'hh1234567', null],
            ['123456', false, '123456', null],
            ['1234567', false, '1234567', null],
            ['12345678', false, '12345678', null],
            ['foo', false, 'foo', null],
            ['foofoof', false, 'foofoof', null],
        ];
    }
}
