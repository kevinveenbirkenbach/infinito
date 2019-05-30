<?php

namespace tests\Unit\Domain\Parameter\Parameter;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\Parameter\Parameter\ViewParameter;
use Infinito\DBAL\Types\ActionType;

/**
 * @author kevinfrantz
 */
class ViewParameterTest extends TestCase
{
    public function testKey(): void
    {
        $key = ViewParameter::getKey();
        $this->assertEquals('view', $key);
        $viewParameter = new ViewParameter();
        $this->assertEquals($key, $viewParameter::getKey());
    }

    public function testAccessors(): void
    {
        $viewParameter = new ViewParameter();
        foreach (ActionType::getValues() as $value) {
            $this->assertNull($viewParameter->setValue($value));
            $this->assertEquals($value, $viewParameter->getValue());
        }
    }
}
