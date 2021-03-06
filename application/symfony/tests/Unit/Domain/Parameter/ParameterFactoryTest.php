<?php

namespace tests\Unit\Domain\Parameter;

use Infinito\Domain\Parameter\Parameter\VersionParameter;
use Infinito\Domain\Parameter\ParameterFactory;
use Infinito\Exception\Core\NotImplementedCoreException;
use PHPUnit\Framework\TestCase;

/**
 * @author kevinfrantz
 */
class ParameterFactoryTest extends TestCase
{
    public function testAllParameters(): void
    {
        $parameterFactory = new ParameterFactory();
        $allParameters = $parameterFactory->getAllParameters();
        $versionParameter = $allParameters->get('version');
        $this->assertInstanceOf(VersionParameter::class, $versionParameter);
        $this->assertEquals($versionParameter, $parameterFactory->getParameter('version'));
    }

    public function testGetParameter(): void
    {
        $parameterFactory = new ParameterFactory();
        $versionParameter = $parameterFactory->getParameter('version');
        $this->assertInstanceOf(VersionParameter::class, $versionParameter);
        $this->assertEquals($versionParameter, $parameterFactory->getParameter('version'));
        $this->expectException(NotImplementedCoreException::class);
        $versionParameter = $parameterFactory->getParameter('blabalbal');
    }
}
