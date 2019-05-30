<?php

namespace tests\Unit\Domain\Twig;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\Twig\ActionIconClassMapInterface;
use Infinito\Domain\Twig\ActionIconClassMap;
use Infinito\DBAL\Types\ActionType;
use Infinito\Exception\Collection\NotSetElementException;

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
        $this->expectException(NotSetElementException::class);
        $this->actionIconClassMap->getIconClass('wejfhwhke12');
    }

    public function testAllActionsSet(): void
    {
        foreach (ActionType::getValues() as $action) {
            $this->assertIsString($this->actionIconClassMap->getIconClass($action));
        }
    }
}
