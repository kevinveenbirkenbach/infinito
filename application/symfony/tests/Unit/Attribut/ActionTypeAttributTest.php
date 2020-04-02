<?php

namespace Tests\Unit\Attribut;

use Infinito\Attribut\ActionTypeAttribut;
use Infinito\Attribut\ActionTypeAttributInterface;
use Infinito\DBAL\Types\ActionType;
use Infinito\Exception\Type\InvalidChoiceTypeException;
use PHPUnit\Framework\TestCase;

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
        foreach (ActionType::getValues() as $enum) {
            $this->assertNull($this->actionTypeAttribut->setActionType($enum));
            $this->assertEquals($enum, $this->actionTypeAttribut->getActionType());
        }
        $this->expectException(InvalidChoiceTypeException::class);
        $this->actionTypeAttribut->setActionType('NoneValidType');
    }
}
