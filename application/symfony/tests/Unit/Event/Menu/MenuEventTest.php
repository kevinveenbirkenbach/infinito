<?php

namespace Event;

use Infinito\Event\Menu\MenuEvent;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuEventTest extends TestCase
{
    /**
     * @var MenuEvent
     */
    protected $menuEvent;

    public function setUp(): void
    {
        $factory = $this->createMock(FactoryInterface::class);
        $item = $this->createMock(ItemInterface::class);
        $request = $this->createMock(RequestStack::class);
        $this->menuEvent = new MenuEvent($factory, $item, $request);
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(FactoryInterface::class, $this->menuEvent->getFactory());
        $this->assertInstanceOf(ItemInterface::class, $this->menuEvent->getItem());
        $this->assertInstanceOf(RequestStack::class, $this->menuEvent->getRequest());
    }
}
