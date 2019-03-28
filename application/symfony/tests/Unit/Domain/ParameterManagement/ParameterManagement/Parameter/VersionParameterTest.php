<?php

namespace tests\Unit\Domain\ParameterManagement\Parameter;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\ParameterManagement\Parameter\VersionParameter;

/**
 * @author kevinfrantz
 */
class VersionParameterTest extends TestCase
{
    public function testKey(): void
    {
        $key = VersionParameter::getKey();
        $this->assertEquals('version', $key);
    }
}
