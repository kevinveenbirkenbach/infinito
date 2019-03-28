<?php
namespace tests\Unit\Domain\ParameterManagement;


use PHPUnit\Framework\TestCase;
use Infinito\Domain\ParameterManagement\ParameterFactory;
use Infinito\Domain\ParameterManagement\Parameter\VersionParameter;

/**
 * 
 * @author kevinfrantz
 *
 */
class ParameterFactoryTest extends TestCase
{
    public function testAllParameters():void{
        $parameterFactory = new ParameterFactory();
        $allParameters = $parameterFactory->getAllParameters();
        var_dump($allParameters);
        $versionParameter = $allParameters->get('version');
        $this->assertInstanceOf(VersionParameter::class, $versionParameter);
        $this->assertEquals($versionParameter, $parameterFactory->getParameter('version'));
    }
}

