<?php

namespace Infinito\Menu;

use Infinito\DBAL\Types\MenuEventType;
use Infinito\Event\Menu\MenuEvent;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class Menu
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @var FactoryInterface
     */
    private $factory;

    public function __construct(FactoryInterface $factory, EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        $this->factory = $factory;
    }

    public function userTopbar(RequestStack $request): ItemInterface
    {
        return $this->createMenu(MenuEventType::USER, $request);
    }

    private function createMenu(string $type, RequestStack $request): ItemInterface
    {
        $menu = $this->createBasicMenuItem();
        $this->dispatcher->dispatch($type, new MenuEvent($this->factory, $menu, $request));

        return $menu;
    }

    private function createBasicMenuItem(): ItemInterface
    {
        return $this->factory->createItem('root', [
            'childrenAttributes' => [
                'class' => 'navbar-nav mr-auto',
            ],
        ]);
    }
}
