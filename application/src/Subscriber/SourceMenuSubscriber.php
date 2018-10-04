<?php

namespace App\Subscriber;

use App\Event\Menu\MenuEvent;
use App\DBAL\Types\MenuEventType;

class SourceMenuSubscriber extends AbstractEntityMenuSubscriber
{
    public function onSourceMenuConfigure(MenuEvent $event): void
    {
        $menu = $event->getItem();
        $menu->addChild($this->translator->trans('edit'), [
            'route' => 'app_source_edit',
            'routeParameters' => [
                'id' => $this->getRequestId($event),
            ],
            'attributes' => [
                'icon' => 'fas fa-edit',
            ],
        ]);
        $this->generateShowDropdown($menu, $event,'app_source_show');
        $menu->addChild($this->translator->trans('node'), [
            'route' => 'app_source_node',
            'routeParameters' => [
                'id' => $this->getRequestId($event),
            ],
            'attributes' => [
                'icon' => 'fas fa-globe',
            ],
        ]);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            MenuEventType::SOURCE => 'onSourceMenuConfigure',
        ];
    }
}
