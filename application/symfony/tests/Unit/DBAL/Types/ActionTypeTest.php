<?php

namespace tests\Unit\DBAL\Types;

use PHPUnit\Framework\TestCase;
use App\DBAL\Types\ActionType;

/**
 * @author kevinfrantz
 */
class ActionTypeTest extends TestCase
{
    public function testAmountOfActions(): void
    {
        $this->assertEquals(5, count(ActionType::getChoices()));
    }
}
