<?php

namespace tests\Unit\DBAL\Types;

use Infinito\DBAL\Types\ActionType;
use PHPUnit\Framework\TestCase;

/**
 * @author kevinfrantz
 */
class ActionTypeTest extends TestCase
{
    public function testAmountOfActions(): void
    {
        $this->assertEquals(5, count(ActionType::getValues()));
    }
}
