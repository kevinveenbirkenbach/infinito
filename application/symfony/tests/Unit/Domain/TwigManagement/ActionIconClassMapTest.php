<?php

namespace tests\Unit\Domain\TwigManagement;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\TwigManagement\ActionIconClassMapInterface;
use Infinito\Domain\TwigManagement\ActionIconClassMap;
use Infinito\Exception\Collection\NotSetException;
use Infinito\DBAL\Types\ActionType;

/**
 * @author kevinfrantz
 */
class ActionIconClassMapTest extends TestCase
{
    /**
     * @var ActionIconClassMapInterface
     */
    private $actionIconClassMap;

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $this->actionIconClassMap = new ActionIconClassMap();
    }

    public function testException(): void
    {
        $this->expectException(NotSetException::class);
        $this->actionIconClassMap->getIconClass('wejfhwhke12');
    }

    public function testAllActionsSet(): void
    {
        foreach (ActionType::getValues() as $action) {
            $this->assertIsString($this->actionIconClassMap->getIconClass($action));
        }
    }
}
