<?php

namespace Tests\Unit\Attribut;

use PHPUnit\Framework\TestCase;
use App\Exception\NoValidChoiceException;
use App\Attribut\ActionTypeAttributInterface;
use App\Attribut\ActionTypeAttribut;
use App\DBAL\Types\ActionType;

/**
 * @author kevinfrantz
 */
class ActionTypeAttributTest extends TestCase
{
    /**
     * @var ActionTypeAttributInterface
     */
    protected $actionTypeAttribut;

    public function setUp(): void
    {
        $this->actionTypeAttribut = new class() implements ActionTypeAttributInterface {
            use ActionTypeAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->expectException(\TypeError::class);
        $this->actionTypeAttribut->getActionType();
    }

    public function testAccessors(): void
    {
        foreach (ActionType::getChoices() as $enum) {
            $this->assertNull($this->actionTypeAttribut->setActionType($enum));
            $this->assertEquals($enum, $this->actionTypeAttribut->getActionType());
        }
        $this->expectException(NoValidChoiceException::class);
        $this->actionTypeAttribut->setActionType('NoneValidType');
    }
}
