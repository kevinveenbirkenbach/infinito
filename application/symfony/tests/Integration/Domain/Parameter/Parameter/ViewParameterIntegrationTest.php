<?php

namespace tests\Integration\Domain\Parameter\Parameter;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Infinito\Domain\Parameter\Parameter\ViewParameter;
use Infinito\DBAL\Types\ActionType;

/**
 * @author kevinfrantz
 */
class ViewParameterIntegrationTest extends KernelTestCase
{
    public function testValidation()
    {
        self::bootKernel();
        $validator = self::$container->get(ValidatorInterface::class);
        $viewParameter = new ViewParameter();
        foreach (ActionType::getValues() as $value) {
            $this->assertNull($viewParameter->setValue($value));
            $this->assertEquals($value, $viewParameter->getValue());
            $errors = $validator->validate($viewParameter)->count();
            $this->assertEquals(0, $errors);
        }
        $viewParameter->setValue('abc');
        $errors = $validator->validate($viewParameter)->count();
        $this->assertGreaterThan(0, $errors);
    }
}
