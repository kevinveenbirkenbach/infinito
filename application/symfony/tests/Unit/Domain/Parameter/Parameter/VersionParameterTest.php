<?php

namespace tests\Unit\Domain\Parameter\Parameter;

use Infinito\Domain\Parameter\Parameter\VersionParameter;
use PHPUnit\Framework\TestCase;

/**
 * @author kevinfrantz
 */
class VersionParameterTest extends TestCase
{
    public function testKey(): void
    {
        $key = VersionParameter::getKey();
        $this->assertEquals('version', $key);
        $versionParameter = new VersionParameter();
        $this->assertEquals($key, $versionParameter::getKey());
    }
}
