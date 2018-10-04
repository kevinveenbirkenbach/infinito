<?php

namespace App\Event\Menu\Subbar;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\RequestStack;

class SourceMenuEvent extends Event
{
    public const EVENT = 'app.menu.source.user';

    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var ItemInterface
     */
    private $item;

    /**
     * @var RequestStack
     */
    private $request;

    public function __construct(FactoryInterface $factory, ItemInterface $item, RequestStack $request)
    {
        $this->factory = $factory;
        $this->item = $item;
        $this->request = $request;
    }

    /**
     * @return FactoryInterface
     */
    public function getFactory(): FactoryInterface
    {
        return $this->factory;
    }

    /**
     * @return ItemInterface
     */
    public function getItem(): ItemInterface
    {
        return $this->item;
    }

    /**
     * @return RequestStack
     */
    public function getRequest(): RequestStack
    {
        return $this->request;
    }
}
