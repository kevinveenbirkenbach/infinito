<?php

namespace tests\Unit\Domain\Twig;

use Infinito\DBAL\Types\ActionType;
use Infinito\Domain\Twig\ActionIconClassMap;
use Infinito\Domain\Twig\ActionIconClassMapInterface;
use Infinito\Exception\Collection\NotSetElementException;
use PHPUnit\Framework\TestCase;

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
