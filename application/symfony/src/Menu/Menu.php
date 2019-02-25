<?php

namespace Infinito\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Infinito\Event\Menu\MenuEvent;
use Infinito\DBAL\Types\MenuEventType;

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

    /**
     * @param FactoryInterface         $factory
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(FactoryInterface $factory, EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        $this->factory = $factory;
    }

    /**
     * @param RequestStack $request
     *
     * @return ItemInterface
     */
    public function sourceNavbar(RequestStack $request): ItemInterface
    {
        return $this->createMenu(MenuEventType::SOURCE, $request);
    }

    /**
     * @param RequestStack $request
     *
     * @return ItemInterface
     */
    public function nodeSubbar(RequestStack $request): ItemInterface
    {
        return $this->createMenu(MenuEventType::NODE, $request);
    }

    /**
     * @param RequestStack $request
     *
     * @return ItemInterface
     */
    public function userTopbar(RequestStack $request): ItemInterface
    {
        return $this->createMenu(MenuEventType::USER, $request);
    }

    /**
     * @param string       $type
     * @param RequestStack $request
     *
     * @return ItemInterface
     */
    private function createMenu(string $type, RequestStack $request): ItemInterface
    {
        $menu = $this->createBasicMenuItem();
        $this->dispatcher->dispatch($type, new MenuEvent($this->factory, $menu, $request));

        return $menu;
    }

    /**
     * @return ItemInterface
     */
    private function createBasicMenuItem(): ItemInterface
    {
        return $this->factory->createItem('root', [
            'childrenAttributes' => [
                'class' => 'navbar-nav mr-auto',
            ],
        ]);
    }
}
