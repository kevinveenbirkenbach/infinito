<?php

namespace Infinito\Subscriber;

use Infinito\DBAL\Types\MenuEventType;
use Infinito\Event\Menu\MenuEvent;

/**
 * @author kevinfrantz
 */
class NodeMenuSubscriber extends AbstractEntityMenuSubscriber
{
    public function onNodeMenuConfigure(MenuEvent $event): void
    {
        $menu = $event->getItem();
        $this->generateShowDropdown($menu, $event, 'app_source_show');
        $menu->addChild($this->trans('law'), [
            'route' => 'app_node_law',
            'routeParameters' => [
                'id' => $this->getRequestId($event),
            ],
            'attributes' => [
                'icon' => 'fa fa-gavel',
            ],
        ]);
        $menu->addChild($this->trans('parents'), [
            'route' => 'app_node_parents',
            'routeParameters' => [
                'id' => $this->getRequestId($event),
            ],
            'attributes' => [
                'icon' => 'fa fa-female',
            ],
        ]);
        $menu->addChild($this->trans('childs'), [
            'route' => 'app_node_childs',
            'routeParameters' => [
                'id' => $this->getRequestId($event),
            ],
            'attributes' => [
                'icon' => 'fa fa-child',
            ],
        ]);
    }

    public static function getSubscribedEvents()
    {
        return [
            MenuEventType::NODE => 'onNodeMenuConfigure',
        ];
    }
}
