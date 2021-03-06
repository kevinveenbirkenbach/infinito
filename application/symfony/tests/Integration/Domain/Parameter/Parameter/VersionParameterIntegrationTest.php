<?php

namespace tests\Integration\Domain\Parameter\Parameter;

use Infinito\Domain\Parameter\Parameter\VersionParameter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @author kevinfrantz
 */
class VersionParameterIntegrationTest extends KernelTestCase
{
    public function testValidation()
    {
        self::bootKernel();
        $validator = self::$container->get(ValidatorInterface::class);
        $versionParameter = new VersionParameter();
        $versionParameter->setValue(123);
        $errors = $validator->validate($versionParameter)->count();
        $this->assertEquals(0, $errors);
        $versionParameter->setValue(null);
        $errors = $validator->validate($versionParameter)->count();
        $this->assertEquals(0, $errors);
        $versionParameter->setValue('abc');
        $errors = $validator->validate($versionParameter)->count();
        $this->assertGreaterThan(0, $errors);
    }
}
